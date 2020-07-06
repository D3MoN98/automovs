<?php

namespace App\Http\Controllers;

use App\User;
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
use Msg91;

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

        $payment_id = Payment::create($payment)->id;

        if($for == 'vehicle' && $type == 'booking'){

            $this->vehicle_booking($payment_id, $id);
            $this->send_sms_vehicle_booking($id);

            return redirect($for.'/'.$id)->withSuccess('Car booked successfully');
        } else if($for == 'vehicle' && $type == 'purchase'){

            $this->vehicle_purchase($payment_id, $id);
            $this->send_sms_vehicle_purchase($id);

            return redirect($for.'/'.$id)->withSuccess('Car purchased successfully');
        } else if($for == 'service' && $type == 'booking'){

            $this->service_booking($payment_id, $id);
            $this->send_sms_service_booking($id);

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


    private function send_sms_vehicle_booking($id)
    {
        try {
            $user = Auth::user();
            $vehicle = Vehicle::find($id);

            $variables = [
                'contact_no' => $user->contact_no,
                'name' => $user->name,
                'email' => $user->email,
                'address' => '23/4b Banamali Nasker Road, Kolkata - 700060',
                'seller_name' => $vehicle->user->name,
                'seller_contact_no' => $vehicle->user->contact_no,
                'vehicle_name' => $vehicle->brand . ' - ' . $vehicle->model,
                'vehicle_url' => route('vehicle.show', ['id' => $id])
            ];

            /**
             * For user
             */
            $result = Msg91::sms($user->contact_no, '5efc5019d6fc0527d9149104', $variables);

            /**
             * For seller
             */
            $result = Msg91::sms($vehicle->user->contact_no, '5efc4eb3d6fc056e45680304', $variables);

            /**
             * For admin
             */
            $result = Msg91::sms(User::find(1)->contact_no, '5efc5f10d6fc055b8c101e57', $variables);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    private function send_sms_vehicle_purchase($id)
    {
        try {
            $user = Auth::user();
            $vehicle = Vehicle::find($id);

            $variables = [
                'name' => $user->name,
                'email' => $user->email,
                'contact_no' => $user->contact_no,
                'address' => '23/4b Banamali Nasker Road, Kolkata - 700060',
                'seller_name' => $vehicle->user->name,
                'seller_contact_no' => $vehicle->user->contact_no,
                'vehicle_name' => $vehicle->brand . ' - ' . $vehicle->model,
                'vehicle_url' => route('vehicle.show', ['id' => $id]),
                'price' => $vehicle->price
            ];

            /**
             * For user
             */
            $result = Msg91::sms($user->contact_no, '5efc62c9d6fc054a794159f3', $variables, 'AUTOMV');

            /**
             * For seller
             */
            $result = Msg91::sms($vehicle->user->contact_no, '5efc631fd6fc050c2004b11f', $variables, 'AUTOMV');

            /**
             * For admin
             */
            $result = Msg91::sms(User::find(1)->contact_no, '5efc61e3d6fc052f96605502', $variables, 'AUTOMV');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    private function send_sms_service_booking($id)
    {
        try {
            $user = Auth::user();
            $service = Service::find($id);

            $variables = [
                'contact_no' => $user->contact_no,
                'name' => $user->name,
                'email' => $user->email,
                'address' => '23/4b Banamali Nasker Road, Kolkata - 700060',
                'service_id' => $id,
                'service_name' => $service->name,
                'service_url' => route('service.show', ['id' => $id])
            ];


            /**
             * For user
             */
            $result = Msg91::sms($user->contact_no, '5efc58a7d6fc056e6917f95e', $variables, 'AUTOMV');

            /**
             * For admin
             */
            $result = Msg91::sms(User::find(1)->contact_no, '5efc57aed6fc054ae2316796', $variables, 'AUTOMV');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

}
