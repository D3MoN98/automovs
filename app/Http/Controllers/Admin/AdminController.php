<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function login(){
        if(Auth::check()){
            return redirect('admin/dashboard');
        }

        return view('admin.login')->with(['body_class' => 'login-body']);
    }

    public function login_action(Request $request){
        $validator = $request->validate([
            'user.email' => 'required|email',
            'user.password' => 'required'
        ],[
            'user.email.required' => 'Email field is required.',
            'user.email.email' => 'Email field is must be an email.',
            'user.password.required' => 'Password field is required.'
        ]);

        $remember_me = $request->has('remember') ? true : false;

        $user = User::whereEmail($request->user['email'])->first();

        if($user && $user->isAdmin() && Auth::attempt(['email' => $request->user['email'], 'password' => $request->user['password']], $remember_me)){
            return redirect('admin/dashboard');
        } else {
            return back()->withErrors(['error' => 'Credentials not matched', 'email' => $request->user['email']]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('admin/login');
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function profile(){
        $user = Auth::user();

        return view('admin.profile')->with([
            'user' => $user
        ]);
    }

    public function update_profile(Request $request){
        $id = Auth::id();

        $validator = $request->validate([
            'email' => ['required','email',Rule::unique('users','email')->ignore($id)],
        ],[
            'email.required' => 'Email field is required.',
            'email.unique' => 'This email is allready taken.'
        ]);

        User::find($id)->update([
            'email' => $request->email,
            'name' => $request->name,
        ]);
        return redirect()->back()->withSuccess('Profile updated');
    }


    public function update_password(Request $request){
        $user = Auth::user();
        $current_password = $request->current_password;
        $validator = $request->validate([
            'current_password' => ['required', function ($attribute, $current_password, $fail) use ($user) {
                if (!Hash::check($current_password, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'new_password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6'
        ],[
            'new_password.same' => 'Confirm Password should be same with new password'
        ]);

        User::find($user->id)->update([
            'password' => Hash::make($request->new_password),
        ]);
        return redirect()->back()->withSuccess('Password updated');
    }
}
