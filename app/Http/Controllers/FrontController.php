<?php

namespace App\Http\Controllers;

use App\Blog;
use App\City;
use App\Coupon;
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
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class FrontController extends Controller
{

    public function register()
    {
        return view('frontend.register');
    }

    public function register_action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'contact_no' => 'required',
            'address' => 'required',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6'
        ], [
            'name.required' => 'Name field is required.',
            'email.required' => 'Email field is required.',
            'email.email' => 'Please proide an valid email address.',
            'contact_no.required' => 'Contact No field is required.',
            'address.required' => 'Address field is required.',
            'password.required' => 'Password field is required.',
            'password.same' => 'Confirm password should be match with password.'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact_no' => '91' . $request->contact_no,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);


        UserRole::create([
            'user_id' => $user->id,
            'role_id' => 2
        ]);

        $result = ['success' => 'Register Successfull'];

        try {
            $user->sendEmailVerificationNotification();
            Mail::to($user->email)->send(new UserRegistered($user));
        } catch (Exception $e) {
            array_push($result, ['error' => $e->getMessage()]);
        }


        return response()->json($result);
    }

    public function login_action(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email field is required.',
            'email.email' => 'Email field is must be an email.',
            'password.required' => 'Password field is required.'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $user = User::whereEmail($request->email)->first();

        if ($user && Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['success' => 'Login Successfull']);
        } else {
            return response()->json(['login_error' => 'Credentials not matched', 'email' => $request->email], 401);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function home()
    {
        $vehicles = Vehicle::all();
        $service_types = ServiceType::all();
        $services = Service::all();

        return view('frontend.home')->with([
            'vehicles' => $vehicles,
            'services' => $services,
            'service_types' => $service_types,
        ]);
    }

    public function cars()
    {
        $vehicles = Vehicle::where('type', '4-wheeler')->paginate(9);
        return view('frontend.cars')->with([
            'vehicles' => $vehicles,
        ]);
    }

    public function bikes()
    {
        $vehicles = Vehicle::where('type', '2-wheeler')->paginate(9);
        return view('frontend.bikes')->with([
            'vehicles' => $vehicles,
        ]);
    }


    public function services()
    {
        $services = Service::paginate(9);
        return view('frontend.services')->with([
            'services' => $services,
        ]);
    }

    public function services_by_service_type($id, $single)
    {

        if ($single == 'single') {
            $services = Service::whereIn('id', [$id])->paginate(9);
            $service_type = Service::find($id);
        } else {
            $service_type = ServiceType::findOrFail($id);
            $services = ServiceType::find($id)->services()->paginate(9);
        }

        return view('frontend.services_by_service_type')->with([
            'services' => $services,
            'service_type' => $service_type,
        ]);
    }


    public function vehicle_detail($id)
    {
        $vehicle = Vehicle::find($id);
        // $vehicles = Vehicle::all();
        $vehicles = Vehicle::all()->except($id);
        return view('frontend.vehicle_detail')->with([
            'vehicle' => $vehicle,
            'vehicles' => $vehicles,
        ]);
    }

    public function vehicle_create()
    {
        $locations = City::all()->sortBy('city_name');
        return view('frontend.add_vehicle')->with([
            'locations' => $locations
        ]);
    }

    public function vehicle_store(Request $request)
    {
        $vehicle = $request->vehicle;

        $vehicle_files = [];
        if ($request->hasFile('vehicle_file')) {
            foreach ($request->file('vehicle_file') as $file) {
                $path = $file->store('storage/vehicles', 'public');
                array_push($vehicle_files, $path);
            }
        }

        $vehicle['images'] = implode(',', $vehicle_files);
        $vehicle['user_id'] = Auth::id();

        Vehicle::create($vehicle);

        return redirect()->back()->withSuccess('Vehicle Added');
    }

    public function vehicles_sort_by($type = 'all')
    {
        if ($type == 'all') {
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

    public function services_sort_by_service_type($id)
    {

        $services = ServiceType::find($id)->services()->get();

        return response()->json([
            'html' => view('frontend.inc.service_card')->with([
                'services' => $services
            ])->render()
        ]);
    }

    public function service_detail($id)
    {
        $service = Service::find($id);
        $services = Service::where('service_type_id', $service->service_type_id)->where('id', '!=', $id)->get();
        return view('frontend.service_detail')->with([
            'service' => $service,
            'services' => $services,
        ]);
    }

    public function blogs()
    {
        $blogs = Blog::simplePaginate(9);

        return view('frontend.blogs')->with(['blogs' => $blogs]);
    }

    public function blog_detail($id)
    {
        $blog = Blog::find($id);

        return view('frontend.blog_detail')->with([
            'blog' => $blog
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        return view('frontend.profile')->with([
            'user' => $user
        ]);
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function terms_and_condition()
    {
        return view('frontend.terms_and_condition');
    }

    public function privacy_policy()
    {
        return view('frontend.privacy_policy');
    }

    public function profile_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id)],
            'contact_no' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'Name field is required.',
            'email.required' => 'Email field is required.',
            'email.email' => 'Please proide an valid email address.',
            'contact_no.required' => 'Contact No field is required.',
            'address.required' => 'Address field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        User::findOrFail($id)->update([
            'contact_no' => '91' . $request->contact_no,
            'address' => $request->address,
            'email' => $request->email,
            'name' => $request->name,
        ]);

        return response()->json(['success' => 'profile updated', 'das' => $request->all()]);
    }

    public function password_update(Request $request)
    {
        $user = Auth::user();
        $current_password = $request->current_password;
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', function ($attribute, $current_password, $fail) use ($user) {
                if (!Hash::check($current_password, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'new_password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6'
        ], [
            'new_password.same' => 'Confirm Password should be same with new password'
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        User::find($user->id)->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json(['success' => 'password updated']);
    }

    public function coupon_check(Request $request)
    {
        try {
            $coupon = Coupon::where('code', $request->coupon)->firstOrFail();
            return response()->json(['success' => 'Coupon exist', 'data' => $coupon]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'No coupon found']);
        }
    }
}