<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Pass the authenticated user to the view
        return view('dashboard', ['user' => auth()->user()]);
    }
}
