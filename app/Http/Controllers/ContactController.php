<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiryMail;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // ── Public: store a new inquiry ──────────────────────────────────────────

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // Save to database
        $inquiry = ContactMessage::create($validated);

        // Send email notification (fails silently so the user always gets success)
        $collegeEmail = config('mail.college_email', env('COLLEGE_EMAIL', 'info@kigambonifdc.ac.tz'));

        try {
            Mail::to($collegeEmail)->send(new ContactInquiryMail($inquiry));
        } catch (\Exception $e) {
            Log::error('Contact form email failed', [
                'error'      => $e->getMessage(),
                'inquiry_id' => $inquiry->id,
            ]);
        }

        return redirect()
            ->route('frontend.wasiliana')
            ->with('contact_success', true);
    }

    // ── Dashboard: list all inquiries ────────────────────────────────────────

    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);

        // Mark all as read when the admin opens the inbox
        ContactMessage::where('is_read', false)->update(['is_read' => true]);

        return view('dashboard.messages.index', compact('messages'));
    }

    // ── Dashboard: delete a single inquiry ───────────────────────────────────

    public function destroy(Request $request)
    {
        $request->validate(['id' => 'required|integer|exists:contact_messages,id']);

        ContactMessage::destroy($request->id);

        return redirect()
            ->route('messages/list')
            ->with('success', __('messages.msg_deleted_success'));
    }
}
