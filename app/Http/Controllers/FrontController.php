<?php

namespace App\Http\Controllers;

use App\City;
use App\Service;
use App\ServiceType;
use App\User;
use App\UserRole;
use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;

class FrontController extends Controller
{

    public function register_action(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required','email',Rule::unique('users','email')],
            'contact_no' => 'required',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6'
        ],[
            'name.required' => 'Name field is required.',
            'email.required' => 'Email field is required.',
            'email.email' => 'Please proide an valid email address.',
            'contact_no.required' => 'Contact No field is required.',
            'password.required' => 'Password field is required.',
            'password.same' => 'Confirm password should be match with password.'
        ]);

        if ($validator->fails()){
            return response()->json(['errors'=> $validator->errors()], 422);
        }

        $id = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'password' => Hash::make($request->password),
        ])->id;

        UserRole::create([
            'user_id' => $id,
            'role_id' => 2
        ]);

        return response()->json(['success'=> 'Register Successfull']);
    }

    public function login_action(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ],[
            'email.required' => 'Email field is required.',
            'email.email' => 'Email field is must be an email.',
            'password.required' => 'Password field is required.'
        ]);

        if ($validator->fails()){
            return response()->json(['errors'=> $validator->errors()], 422);
        }


        $user = User::whereEmail($request->email)->first();

        if($user && Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json(['success'=> 'Login Successfull']);
        } else {
            return response()->json(['login_error'=> 'Credentials not matched', 'email' => $request->email], 401);
        }

    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function home(){
        $vehicles = Vehicle::all();
        $service_types = ServiceType::all();

        return view('frontend.home')->with([
            'vehicles' => $vehicles,
            'service_types' => $service_types,
        ]);
    }


    public function vehicle_detail($id){
        $vehicle = Vehicle::find($id);
        // $vehicles = Vehicle::all();
        $vehicles = Vehicle::all()->except($id);
        return view('frontend.vehicle_detail')->with([
            'vehicle' => $vehicle,
            'vehicles' => $vehicles,
        ]);
    }

    public function vehicle_create(){
        $locations = City::all()->sortBy('city_name');
        return view('frontend.add_vehicle')->with([
            'locations' => $locations
        ]);
    }

    public function vehicle_store(Request $request){
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

    public function vehicles_sort_by($type = 'all'){
        if($type == 'all'){
            $vehicles = Vehicle::all();
        } else {
            $vehicles = Vehicle::where(['type' => $type])->get();
        }

        return response()->json([
            'html' => view('frontend.inc.car_card')->with([
                'vehicles' => $vehicles
            ])->render()
        ]);

    }

    public function services_sort_by_service_type($id){

        $services = ServiceType::find($id)->services()->get();

        return response()->json([
            'html' => view('frontend.inc.service_card')->with([
                'services' => $services
            ])->render()
        ]);

    }

    public function service_detail($id){
        $service = Service::find($id);
        $services = Service::all()->except($id);
        return view('frontend.service_detail')->with([
            'service' => $service,
            'services' => $services,
        ]);
    }

    public function about(){
        return view('frontend.about');
    }

    public function terms_and_condition(){
        return view('frontend.terms_and_condition');
    }

    public function privacy_policy(){
        return view('frontend.privacy_policy');
    }

}
