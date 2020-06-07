<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Service;
use App\ServiceBook;
use App\Vehicle;
use App\VehicleBook;
use App\VehiclePurchase;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Instamojo\Instamojo;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $for, $type, $id)
    {
        $api = new Instamojo(
            config('services.instamojo.api_key'),
            config('services.instamojo.auth_token'),
            config('services.instamojo.url')
        );

        try {
            $user = Auth::user();

            if($for == 'vehicle' && $type == 'booking'){
                $vehicle = Vehicle::find($id);
                $purpose = 'Booked Vehicle ' . $vehicle->brand . ' ' . $vehicle->brand;
                $amount = 1000;
            } else if($for == 'vehicle' && $type == 'purchase'){
                $vehicle = Vehicle::find($id);
                $purpose = 'Purchased ' . $vehicle->brand . ' ' . $vehicle->brand;
                $amount = $vehicle->price;
            } else if($for == 'service' && $type == 'booking'){
                $service = Service::find($id);
                $purpose = 'Booked Service ' . $service->brand . ' ' . $service->brand;
                $amount = $request->amount;
            }

            $response = $api->paymentRequestCreate(array(
                "purpose" => $purpose,
                "amount" => $amount,
                "buyer_name" => $user->name,
                "send_email" => true,
                "send_sms" => true,
                "email" => $user->email,
                "phone" => $user->contact_no,
                "redirect_url" => route('pay.success', ['for' => $for, 'type' => $type, 'id' => $id])
            ));

            header('Location: ' . $response['longurl']);
            exit();
        }catch (Exception $e) {
            return redirect($for.'/'.$id)->with(['error' => $e->getMessage()]);
        }

    }


    public function success(Request $request, $for, $type, $id){
        try {

            $api = new Instamojo(
                config('services.instamojo.api_key'),
                config('services.instamojo.auth_token'),
                config('services.instamojo.url')
            );

            $response = $api->paymentRequestStatus(request('payment_request_id'));

            if( !isset($response['payments'][0]['status']) ) {
                return redirect($for.'/'.$id)->with(['error' => 'Payment Failed']);
            } else if($response['payments'][0]['status'] != 'Credit') {
                return redirect($for.'/'.$id)->with(['error' => 'Payment Failed']);
            }
        } catch (Exception $e) {
            return redirect($for.'/'.$id)->with(['error' => $e->getMessage()]);
        }


        $payment = array(
            'payment_id' => $response['payments'][0]['payment_id'],
            'payment_request_id' => $response['id'],
            'order_type' => $for.'_'.$type,
            'purpose' => $response['purpose'],
            'amount' => $response['payments'][0]['amount'],
            'quantity' => $response['payments'][0]['quantity'],
            'status' => $response['status'],
        );

        // $result = Msg91::sms('916291839827', 'Hello there!');
        // dd($result);
        // $msg_link = 'http://api.msg91.com/api/sendhttp.php?route=4&sender=AUTMOV&mobiles='+phn+'&authkey=276339A6u0r8gEhQ5cd8e766&message='+msg+'&country=91';

        $payment_id = Payment::create($payment)->id;

        if($for == 'vehicle' && $type == 'booking'){
            $this->vehicle_booking($payment_id, $id);
            return redirect($for.'/'.$id)->withSuccess('Car booked successfully');
        } else if($for == 'vehicle' && $type == 'purchase'){
            $this->vehicle_purchase($payment_id, $id);
            return redirect($for.'/'.$id)->withSuccess('Car purchased successfully');
        } else if($for == 'service' && $type == 'booking'){
            $this->service_booking($payment_id, $id);
            return redirect($for.'/'.$id)->withSuccess('Sevice booked successfully');
        }


    }


    private function vehicle_booking($payment_id, $id){
        VehicleBook::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $id,
            'payment_id' => $payment_id,
            'is_verified' => 1,
            'verified_at' => date('Y-m-d H:i:s')
        ]);
    }

    private function vehicle_purchase($payment_id, $id){
        VehiclePurchase::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $id,
            'payment_id' => $payment_id,
        ]);
    }

    private function service_booking($payment_id, $id){
        ServiceBook::create([
            'user_id' => Auth::id(),
            'service_id' => $id,
            'payment_id' => $payment_id,
        ]);
    }

}
