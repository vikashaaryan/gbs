<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Handle the login request
     */
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
            'remember' => 'sometimes|boolean'
        ]);

        // Determine if the login input is email or phone
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // Attempt to log the user in
        $credentials = [
            $loginType => $request->login,
            'password' => $request->password
        ];

        $remember = $request->has('remember') ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            // Check if user is verified (if you have email verification)
            $user = Auth::user();
            
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();

            // Redirect to intended page or dashboard
            return redirect()->intended(route('home'))
                ->with('success', 'Welcome back, ' . $user->full_name . '!');
        }

        // If login fails
        throw ValidationException::withMessages([
            'login' => ['The provided credentials do not match our records.'],
        ]);
    }

    /**
     * Log the user out
     */
   
}