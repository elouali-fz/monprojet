<?php

// In LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Show admin login form
    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    // Admin login logic
    public function adminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Check if the user is an admin
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard'); // Redirect to the admin dashboard
            } else {
                Auth::logout(); // Log out if not admin
                return redirect()->route('admin.login.form')->withErrors(['email' => 'You are not authorized to access this page.']);
            }
        }

        return redirect()->route('admin.login.form')->withErrors(['email' => 'Invalid credentials']);
    }

    // Show user login form
    public function showUserLoginForm()
    {
        return view('auth.user-login');
    }

    // User login logic
    public function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('user.dashboard'); // Redirect to the user dashboard
        }

        return redirect()->route('user.login.form')->withErrors(['email' => 'Invalid credentials']);
    }
}
