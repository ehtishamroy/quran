<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'leads_count' => \App\Models\Enquiry::count(),
            'packages_count' => \App\Models\Package::count(),
            'posts_count' => \App\Models\Post::count(),
            'team_count' => \App\Models\TeamMember::count(),
        ];

        $recent_enquiries = \App\Models\Enquiry::with('package')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_enquiries'));
    }
}
