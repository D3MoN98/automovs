<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Mail\ServiceBooked;
use App\Mail\VehicleBooked;
use App\Mail\VehiclePurchased;
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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Instamojo\Instamojo;
use Msg91;
use PDF;

set_time_limit(300);

class PaymentController extends Controller
{
    private $purchase_percentage = 2;

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
        if (is_null(Auth::user()->address)) {
            return redirect()->back()->with('error', 'Please update your address first');
        }

        $api = new Instamojo(
            config('services.instamojo.api_key'),
            config('services.instamojo.auth_token'),
            config('services.instamojo.url')
        );

        try {
            $user = Auth::user();

            if ($for == 'vehicle' && $type == 'booking') {
                $vehicle = Vehicle::find($id);
                $purpose = 'Booked Vehicle ' . $vehicle->brand . ' ' . $vehicle->brand;
                $amount = 1000;
            } else if ($for == 'vehicle' && $type == 'purchase') {
                $vehicle = Vehicle::find($id);
                $purpose = 'Purchased ' . $vehicle->brand . ' ' . $vehicle->brand;
                $amount = ($vehicle->price * $this->purchase_percentage) / 100;
            } else if ($for == 'service' && $type == 'booking') {
                $service = Service::find($id);
                $purpose = 'Booked Service ' . $service->brand . ' ' . $service->brand;
                $amount = $request->amount;

                if ($request->coupon != 0) {
                    $coupon = Coupon::find($request->coupon);
                    if ($coupon->is_fixed === 1) {
                        $amount -= $coupon->discount_amount;
                    } else {
                        $amount -= $amount * $coupon->discount_amount / 100;
                    }
                }
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
        } catch (Exception $e) {
            return redirect($for . '/' . $id)->with(['error' => json_encode($e->getMessage())]);
        }
    }


    public function success(Request $request, $for, $type, $id)
    {
        try {

            $api = new Instamojo(
                config('services.instamojo.api_key'),
                config('services.instamojo.auth_token'),
                config('services.instamojo.url')
            );

            $response = $api->paymentRequestStatus(request('payment_request_id'));

            if (!isset($response['payments'][0]['status'])) {
                return redirect($for . '/' . $id)->with(['error' => 'Payment Failed']);
            } else if ($response['payments'][0]['status'] != 'Credit') {
                return redirect($for . '/' . $id)->with(['error' => 'Payment Failed']);
            }
        } catch (Exception $e) {
            return redirect($for . '/' . $id)->with(['error' => $e->getMessage()]);
        }


        $payment = array(
            'payment_id' => $response['payments'][0]['payment_id'],
            'payment_request_id' => $response['id'],
            'order_type' => $for . '_' . $type,
            'purpose' => $response['purpose'],
            'amount' => $response['payments'][0]['amount'],
            'quantity' => $response['payments'][0]['quantity'],
            'status' => $response['status'],
        );

        $payment_id = Payment::create($payment)->id;

        if ($for == 'vehicle' && $type == 'booking') {

            $this->vehicle_booking($payment_id, $id);

            return redirect($for . '/' . $id)->withSuccess('Car booked successfully');
        } else if ($for == 'vehicle' && $type == 'purchase') {

            $this->vehicle_purchase($payment_id, $id);

            return redirect($for . '/' . $id)->withSuccess('Car purchased successfully');
        } else if ($for == 'service' && $type == 'booking') {

            $this->service_booking($payment_id, $id);

            return redirect($for . '/' . $id)->withSuccess('Sevice booked successfully');
        }
    }


    private function vehicle_booking($payment_id, $id)
    {
        $vehicle_book = VehicleBook::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $id,
            'payment_id' => $payment_id,
            'is_verified' => 1,
            'verified_at' => date('Y-m-d H:i:s')
        ]);


        $file = 'storage/invoice/' . uniqid() . '.pdf';

        $pdf = PDF::loadView('invoice.vehicle_book', ['vehicle_book' => $vehicle_book]);
        Storage::put('public/' . $file, $pdf->output());

        Payment::find($payment_id)->update([
            'invoice' => $file
        ]);

        $this->send_sms_vehicle_booking($vehicle_book);

        $this->send_mail_vehicle_booking($vehicle_book->refresh());
    }

    private function vehicle_purchase($payment_id, $id)
    {
        $vehicle_purchase = VehiclePurchase::create([
            'user_id' => Auth::id(),
            'vehicle_id' => $id,
            'payment_id' => $payment_id,
        ]);


        $file = 'storage/invoice/' . uniqid() . '.pdf';

        $pdf = PDF::loadView('invoice.vehicle_purchase', ['vehicle_purchase' => $vehicle_purchase]);
        Storage::put('public/' . $file, $pdf->output());

        Payment::find($payment_id)->update([
            'invoice' => $file
        ]);


        $this->send_sms_vehicle_purchase($vehicle_purchase->refresh());

        $this->send_mail_vehicle_purchase($vehicle_purchase->refresh());
    }

    private function service_booking($payment_id, $id)
    {
        $service_book = ServiceBook::create([
            'user_id' => Auth::id(),
            'service_id' => $id,
            'payment_id' => $payment_id,
        ]);



        $file = 'storage/invoice/' . uniqid() . '.pdf';

        $pdf = PDF::loadView('invoice.service_book', ['service_book' => $service_book]);
        Storage::put('public/' . $file, $pdf->output());

        Payment::find($payment_id)->update([
            'invoice' => $file
        ]);


        $this->send_sms_service_booking($service_book->refresh());

        $this->send_mail_service_booking($service_book->refresh());
    }


    private function send_sms_vehicle_booking($vehicle_book)
    {
        try {
            $variables = [
                'contact_no' => $vehicle_book->user->contact_no,
                'name' => $vehicle_book->user->name,
                'email' => $vehicle_book->user->email,
                'address' => $vehicle_book->user->address,
                'seller_name' => $vehicle_book->vehicle->user->name,
                'seller_contact_no' => $vehicle_book->vehicle->user->contact_no,
                'vehicle_name' => $vehicle_book->vehicle->brand . ' - ' . $vehicle_book->vehicle->model,
                'vehicle_url' => route('vehicle.show', ['id' => $vehicle_book->vehicle->id])
            ];

            /**
             * For user
             */
            $result = Msg91::sms($vehicle_book->user->contact_no, '5efc5019d6fc0527d9149104', $variables);

            /**
             * For seller
             */
            $result = Msg91::sms($vehicle_book->vehicle->user->contact_no, '5efc4eb3d6fc056e45680304', $variables);

            /**
             * For admin
             */
            $result = Msg91::sms(User::find(1)->contact_no, '5efc5f10d6fc055b8c101e57', $variables);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    private function send_sms_vehicle_purchase($vehicle_purchase)
    {
        try {

            $variables = [
                'name' => $vehicle_purchase->user->name,
                'email' => $vehicle_purchase->user->email,
                'contact_no' => $vehicle_purchase->user->contact_no,
                'address' => $vehicle_purchase->user->address,
                'seller_name' => $vehicle_purchase->vehicle->user->name,
                'seller_contact_no' => $vehicle_purchase->vehicle->user->contact_no,
                'vehicle_name' => $vehicle_purchase->vehicle->brand . ' - ' . $vehicle_purchase->vehicle->model,
                'vehicle_url' => route('vehicle.show', ['id' => $vehicle_purchase->vehicle->id]),
                'price' => $vehicle_purchase->vehicle->price
            ];

            /**
             * For user
             */
            $result = Msg91::sms($vehicle_purchase->user->contact_no, '5efc62c9d6fc054a794159f3', $variables, 'AUTOMV');

            /**
             * For seller
             */
            $result = Msg91::sms($vehicle_purchase->vehicle->user->contact_no, '5efc631fd6fc050c2004b11f', $variables, 'AUTOMV');

            /**
             * For admin
             */
            $result = Msg91::sms(User::find(1)->contact_no, '5efc61e3d6fc052f96605502', $variables, 'AUTOMV');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    private function send_sms_service_booking($service_book)
    {
        try {

            $variables = [
                'contact_no' => $service_book->user->contact_no,
                'name' => $service_book->user->name,
                'email' => $service_book->user->email,
                'address' => $service_book->user->address,
                'service_id' => $service_book->service->id,
                'service_name' => $service_book->service->name,
                'service_url' => route('service.show', ['id' => $service_book->service->id])
            ];


            /**
             * For user
             */
            $result = Msg91::sms($service_book->user->contact_no, '5efc58a7d6fc056e6917f95e', $variables, 'AUTOMV');

            /**
             * For admin
             */
            $result = Msg91::sms(User::find(1)->contact_no, '5efc57aed6fc054ae2316796', $variables, 'AUTOMV');

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function send_mail_vehicle_booking($vehicle_book)
    {
        try {
            Mail::to($vehicle_book->user->email)->send(new VehicleBooked($vehicle_book));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function send_mail_vehicle_purchase($vehicle_purchase)
    {
        try {
            Mail::to($vehicle_purchase->user->email)->send(new VehiclePurchased($vehicle_purchase));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function send_mail_service_booking($service_book)
    {
        Mail::to($service_book->user->email)->send(new ServiceBooked($service_book));
        try {
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}