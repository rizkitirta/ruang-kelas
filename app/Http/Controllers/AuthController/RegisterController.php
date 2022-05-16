<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        if (auth()->check()) return back();

        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->first_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Profile::create(['user_id' => $user->id,'last_name' => $request->last_name]);
            Auth::login($user);

            return \Redirect::route('dashboard.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
