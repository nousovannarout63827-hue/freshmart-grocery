<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Mail\ContactAutoReplyMail;

class PageController extends Controller
{
    /**
     * Display the About page.
     */
    public function about()
    {
        return view('frontend.about');
    }

    /**
     * Display the Contact page.
     */
    public function contact()
    {
        return view('frontend.contact');
    }

    /**
     * Display the Privacy Policy page.
     */
    public function privacy()
    {
        return view('frontend.privacy');
    }

    /**
     * Display the Terms of Service page.
     */
    public function terms()
    {
        return view('frontend.terms');
    }

    /**
     * Display the Cookie Policy page.
     */
    public function cookies()
    {
        return view('frontend.cookies');
    }

    /**
     * Submit the contact form.
     */
    public function submitContact(Request $request)
    {
        // 1. Validate the form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|min:10|max:1000',
        ]);

        try {
            // 2. Send the notification to YOUR email (admin)
            Mail::to('nou.sovannarout63827@gmail.com')
                ->send(new ContactFormMail($validated));

            // 3. Send the "Thank You" Auto-Reply to the CUSTOMER'S email
            Mail::to($validated['email'])
                ->send(new ContactAutoReplyMail($validated['first_name']));

            // 4. Send the user back with a success message
            return back()->with('success', '✅ Message sent! Check your inbox for a confirmation email.');

        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Contact form email error: ' . $e->getMessage());
            
            // Show user-friendly error message
            return back()->with('error', '⚠️ Sorry, there was an issue sending your message. Please try again later or contact us directly at support@freshmart.com');
        }
    }
}
