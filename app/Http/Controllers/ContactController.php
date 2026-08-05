<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    /**
     * TODO: once mail is configured, replace this with a real
     * Mail::send(...) call (same pattern as OrabyStore's ContactService).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:2000',
        ]);

        return back()->with('sent', true);
    }
}
