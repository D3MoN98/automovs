<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ServiceBook;
use Illuminate\Http\Request;

class ServiceBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service_books = ServiceBook::all();
        return view('admin.service_book.service_book_list')->with([
            'service_books' => $service_books
        ]);
    }
}
