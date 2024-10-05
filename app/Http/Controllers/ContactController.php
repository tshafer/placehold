<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Send email
        Mail::raw("New contact form submission:\n\nName: {$validatedData['name']}\nEmail: {$validatedData['email']}\nMessage: {$validatedData['message']}", function ($message) {
            $message->to('support@placehold.cloud')
                ->subject('New Contact Form Submission');
        });

        // Redirect back with success message
        return redirect()->back()->with('success', 'Thank you for your message. We will get back to you soon!');
    }
}
