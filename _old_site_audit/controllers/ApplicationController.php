<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function showApplyPage()
{
    // Hapa tutaonyesha ukurasa wa kwanza ambapo mwanafunzi anajaza Jina na Namba ya Simu
    return view('lms.apply_start');
}

public function processPayment(Request $request)
{
    // Hapa ndipo tutakapounganisha na BEEM API baadaye
    // Kwa sasa, tutatengeneza rekodi ya awali kwenye database
    $application = \App\Models\Application::create([
        'applicant_name' => $request->name,
        'phone_number' => $request->phone,
        'amount' => 10000, // Mfano: Ada ya fomu ni TSH 10,000
        'payment_status' => 'pending',
    ]);

    return "Maombi yamepokelewa. Hatua inayofuata: Malipo ya Beem.";
}

}
