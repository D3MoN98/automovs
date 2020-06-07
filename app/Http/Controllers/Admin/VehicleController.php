<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Http\Controllers\Controller;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('admin.vehicle.vehicle_list')->with([
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = City::all()->sortBy('city_name');
        return view('admin.vehicle.vehicle_add')->with([
            'locations' => $locations
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
        $vehicle = $request->vehicle;

        $vehicle_files = [];
        if ($request->hasFile('vehicle_file')) {
            foreach ($request->file('vehicle_file') as $file) {
                $path = $file->store('storage/vehicles','public');
                array_push($vehicle_files, $path);
            }
        }

        $vehicle['images'] = implode(',', $vehicle_files);
        $vehicle['user_id'] = Auth::id();

        Vehicle::create($vehicle);

        return redirect()->back()->withSuccess('Vehicle Added');
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
        $vehicle = Vehicle::find($id);
        $locations = City::all()->sortBy('city_name');


        return view('admin.vehicle.vehicle_edit')->with([
            'vehicle' => $vehicle,
            'locations' => $locations
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
        $vehicle = $request->vehicle;
        $vehicle_files = explode(',', Vehicle::find($id)->images);
        if ($request->hasFile('vehicle_file')) {
            foreach ($request->file('vehicle_file') as $file) {
                $path = $file->store('storage/vehicles','public');
                array_push($vehicle_files, $path);
            }
        }

        $vehicle['images'] = implode(',', $vehicle_files);

        Vehicle::find($id)->update($vehicle);
        return redirect()->back()->withSuccess('Vehicle updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vehicle::destroy($id);
        return redirect()->back()->withSuccess('Vehicle deleted');
    }

    public function is_verified_update(Request $request){
        Vehicle::where('id', $request->id)->update([
            'is_verified' => $request->is_verified,
            'verified_at' => $request->is_verified == 1 ? date('Y-m-d H:i:s') : NULL
        ]);
        return response()->json(['success', 'is verified updated']);
    }

    public function image_delete(Request $request){
        $image = $request->image;
        $vehicle = Vehicle::find($request->id);
        $images = explode(',', $vehicle->images);
        $pos = array_search($image, $images);
        unset($images[$pos]);
        unlink(public_path('storage/'.$image));

        $vehicle->update(['images' => implode(',', $images)]);
        return response()->json(['success', 'image deleted']);
    }
}
