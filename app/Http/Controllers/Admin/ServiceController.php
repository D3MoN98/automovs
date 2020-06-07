<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service;
use App\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.service.service_list')->with([
            'services' => $services
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $service_types = ServiceType::all()->sortBy('name');
        return view('admin.service.service_add')->with([
            'service_types' => $service_types
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service = $request->service;

        // dd($price);
        $service_files = [];
        if ($request->hasFile('service_file')) {
            foreach ($request->file('service_file') as $file) {
                $path = $file->store('storage/services','public');
                array_push($service_files, $path);
            }
        }

        $service['price'] = json_encode($request->price);
        $service['images'] = implode(',', $service_files);
        $service['user_id'] = Auth::id();

        Service::create($service);

        return redirect()->back()->withSuccess('Service Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        $service_types = ServiceType::all()->sortBy('name');


        return view('admin.service.service_edit')->with([
            'service' => $service,
            'service_types' => $service_types
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $service = $request->service;
        $service_files = explode(',', Service::find($id)->images);
        if ($request->hasFile('service_file')) {
            foreach ($request->file('service_file') as $file) {
                $path = $file->store('storage/services','public');
                array_push($service_files, $path);
            }
        }

        $service['price'] = json_encode($request->price);
        $service['images'] = implode(',', $service_files);

        Service::find($id)->update($service);
        return redirect()->back()->withSuccess('Service updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::destroy($id);
        return redirect()->back()->withSuccess('Service deleted');
    }

    /**
     * image delete function
     *
     * @param Request $request
     * @return json
     */

    public function image_delete(Request $request){
        $image = $request->image;
        $service = Service::find($request->id);
        $images = explode(',', $service->images);
        $pos = array_search($image, $images);
        unset($images[$pos]);
        unlink(public_path('storage/'.$image));

        $service->update(['images' => implode(',', $images)]);
        return response()->json(['success', 'image deleted']);
    }
}
