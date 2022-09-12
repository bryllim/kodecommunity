<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    public function uploadprofile(Request $request)
    {
        if($request->hasfile('profile_path')){

            // deletes the existing profile in the server storage
            Storage::disk('public')->delete("images/".Auth::user()->profile_path);

            // generate random filename string
            $imageName = time().rand(1, 100).".".$request->file('profile_path')->extension();

            // store filename to user
            $user = User::find(Auth::user()->id);
            $user->profile_path = $imageName;
            $user->save();

            // store image to server
            $request->file('profile_path')->storeAs('images', $imageName, 'public');
            
            return redirect()->route('dashboard')->with('success', 'Profile updated.');
            
        }else{
            return redirect()->route('dashboard')->with('success', 'No image detected.');
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
