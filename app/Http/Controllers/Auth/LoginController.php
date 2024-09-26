<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\ActivityLogTrait;

// Controller for handling user authentication (login/logout)
class LoginController extends Controller
{
    use ActivityLogTrait;

    // Display the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle user login
    public function login(Request $request)
    {
        // Validate login credentials
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Return validation errors if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ], 422);
        }

        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Log user activity on successful login
            $this->logActivity(
                Auth::id(),
                'login',
                'User logged in',
                $request->header('User-Agent'),
                $request->ip()
            );

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'Login successful',
            ]);
        }

        // Return error response if authentication fails
        return response()->json([
            'success' => false,
            'errors' => ['Invalid email or password']
        ], 401);
    }

    // Handle user logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.form');
    }
}
