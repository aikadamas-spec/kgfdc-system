<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\StudentProfile; // <--- Ongeza hii
use Illuminate\Http\Request;

class CoordinatorController extends Controller
{
    // Hii ni kwa ajili ya kuona nani amelipia fomu (15,000)
    public function index()
    {
        $applications = Application::where('payment_status', 'paid')->get();
        return view('coordinator.index', compact('applications'));
    }

    // Dashboard kuu ya coordinator — inaonyesha wanafunzi wote
    public function dashboard()
    {
        $students = StudentProfile::with('user')->latest()->get();
        return view('coordinator.students_index', compact('students'));
    }

    // HII NI MPYA: Kwa ajili ya kuona waliojaza fomu ndefu na picha zao
    public function students()
    {
        $students = StudentProfile::with('user')->latest()->get();
        return view('coordinator.students_index', compact('students'));
    }

    public function approve($id)
    {
        $application = Application::findOrFail($id);
        $application->update(['form_unlocked' => true]);

        return back()->with('success', 'Maombi yameidhinishwa! SMS imetumwa kwa mwanafunzi.');
    }
}
