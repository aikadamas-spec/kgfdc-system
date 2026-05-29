<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class BeemWebhookController extends Controller
{
    public function handleCallback(Request $request)
    {
        // 1. Beem watatutumia Transaction ID
        $transactionId = $request->transaction_id; 
        $status = $request->status; // Mfano: 'SUCCESS'

        if ($status === 'SUCCESS') {
            $app = Application::where('beem_reference', $transactionId)->first();

            if ($app && $app->payment_status !== 'paid') {
                // A. Badilisha hali ya maombi kuwa paid
                $app->update(['payment_status' => 'paid', 'form_unlocked' => true]);

                // B. Tengeneza Akaunti ya User kiotomatiki
                $password = strtolower(explode(' ', $app->applicant_name)[0]) . rand(100, 999);
                $user = User::create([
                    'name' => $app->applicant_name,
                    'email' => $app->phone_number . '@fdc.go.tz', // Email ya mfano
                    'password' => Hash::make($password),
                    'role' => 'student',
                ]);

                // C. Tuma SMS ya Beem papo hapo yenye login details
                $this->sendLoginSMS($app->phone_number, $password);
            }
        }

        return response()->json(['status' => 'received']);
    }

    private function sendLoginSMS($phone, $password)
    {
        // Kodi ya kutuma SMS (Beem API)
        Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(env('BEEM_API_KEY').':'.env('BEEM_SECRET_KEY')),
        ])->post('https://beem.africa', [
            'source_addr' => 'INFO',
            'message' => "Malipo yamepokelewa! Ingia hapa: https://fdc.go.tz. Username: $phone, Password: $password",
            'recipients' => [['recipient_id' => '1', 'dest_addr' => $phone]],
        ]);
    }
}
