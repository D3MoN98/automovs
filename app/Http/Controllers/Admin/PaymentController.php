<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        return view('admin.payment.payment_list')->with([
            'payments' => $payments
        ]);
    }

    public function show($id){
        $payment = Payment::find($id);
        return view('admin.payment.payment_show')->with([
            'payment' => $payment
        ]);
    }

}
