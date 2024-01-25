<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Make sure only authenticated admin users can access the dashboard
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();

        // You can customize this query to fetch any data you need for the dashboard
        $data = [
            'totalUsers' => User::count(),
            'adminUsers' => User::role('admin')->count(),
            'muridUsers' => User::role('murid')->count(),
            'guruUsers' => User::role('guru')->count(),
            'gurupiketUsers' => User::role('gurupiket')->count(),
            'tuUsers' => User::role('tatausaha')->count(),
            'kepsekUsers' => User::role('kepsek')->count(),
            'kurikulumUsers' => User::role('kurikulum')->count(),
        ];

        // Return the view with the data
        return view('dashboard.index', compact('data'));
    }
}