<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\VehicleBook;
use Illuminate\Http\Request;

class VehicleBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicle_books = VehicleBook::all();
        return view('admin.vehicle_book.vehicle_book_list')->with([
            'vehicle_books' => $vehicle_books
        ]);
    }
}
