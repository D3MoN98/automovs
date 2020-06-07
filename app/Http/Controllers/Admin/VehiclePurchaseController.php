<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\VehiclePurchase;
use Illuminate\Http\Request;

class VehiclePurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicle_purchases = VehiclePurchase::all();
        return view('admin.vehicle_purchase.vehicle_purchase_list')->with([
            'vehicle_purchases' => $vehicle_purchases
        ]);
    }
}
