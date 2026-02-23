<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = \App\Models\Enquiry::with('package')->latest()->paginate(15);
        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function show(\App\Models\Enquiry $enquiry)
    {
        // Mark as read if status is new
        if ($enquiry->status === 'new') {
            $enquiry->update(['status' => 'read']);
        }

        return view('admin.enquiries.show', compact('enquiry'));
    }

    public function destroy(\App\Models\Enquiry $enquiry)
    {
        $enquiry->delete();
        return back()->with('success', 'Enquiry deleted successfully.');
    }
}
