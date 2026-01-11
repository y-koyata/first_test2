<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Reservation;
use App\Mail\VerificationEmail;
use App\Mail\RegistrationConfirmationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    public function index($slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();
        
        // Check functionality only, layout comes later
        return view('campaign.index', compact('campaign'));
    }

    public function verify(Request $request, $slug)
    {
        $request->validate([
            'email' => 'required|email',
            // 'g-recaptcha-response' => 'required|captcha', // Enable when keys are ready
        ]);

        $campaign = Campaign::where('slug', $slug)->firstOrFail();

        // 3rd party observation protection: Always say "sent" even if not registered, 
        // but logic is same: send verification link.
        // We do separate strictly if we wanted to prevent re-registration but spec says "overwrite".
        // So we just send the link.

        $url = URL::temporarySignedRoute(
            'campaign.form',
            now()->addMinutes(30),
            ['slug' => $slug, 'email' => $request->email]
        );

        Mail::to($request->email)->send(new VerificationEmail($url, $campaign));

        return back()->with('status', 'sent');
    }

    public function showForm(Request $request, $slug)
    {
        if (! $request->hasValidSignature()) {
            abort(403, 'Invalid or expired signature.');
        }

        $campaign = Campaign::where('slug', $slug)->firstOrFail();
        $email = $request->query('email');

        // Specification: "Do not pre-fill form even for existing users"
        // So we just pass the email (hidden) and campaign.

        return view('campaign.form', compact('campaign', 'email'));
    }

    public function store(Request $request, $slug)
    {
        $campaign = Campaign::where('slug', $slug)->firstOrFail();

        // Validation based on spec
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'name_kana' => 'required|string|max:255',
            'tel' => 'required|string|max:20',
            'zip_code' => 'required|string|max:8',
            'address' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'car_year' => 'required|string|max:255',
            'car_registration_no' => 'required|string|max:255',
            'companion_adult_count' => 'required|integer|min:0',
            'companion_child_count' => 'required|integer|min:0',
            'additional_parking_count' => 'required|integer|min:0',
            'transfer_date' => 'required|date',
            'survey_data' => 'nullable|array',
            // 'g-recaptcha-response' => 'required|captcha',
        ]);
        
        // Calculate Total Amount
        $total = $campaign->base_fee 
               + ($validated['companion_adult_count'] * $campaign->companion_adult_fee)
               + ($validated['companion_child_count'] * $campaign->companion_child_fee)
               + ($validated['additional_parking_count'] * $campaign->additional_parking_fee);

        DB::transaction(function () use ($campaign, $validated, $total) {
            $reservation = Reservation::updateOrCreate(
                [
                    'campaign_id' => $campaign->id,
                    'email' => $validated['email']
                ],
                [
                    'status' => 'temporary', // Set to temporary/pending as per flow
                    'name' => $validated['name'],
                    'name_kana' => $validated['name_kana'],
                    'tel' => $validated['tel'],
                    'zip_code' => $validated['zip_code'],
                    'address' => $validated['address'],
                    'car_model' => $validated['car_model'],
                    'car_year' => $validated['car_year'],
                    'car_registration_no' => $validated['car_registration_no'],
                    'companion_adult_count' => $validated['companion_adult_count'],
                    'companion_child_count' => $validated['companion_child_count'],
                    'additional_parking_count' => $validated['additional_parking_count'],
                    'transfer_date' => $validated['transfer_date'],
                    'total_amount' => $total,
                    'survey_data' => $validated['survey_data'] ?? [],
                    'email_verified_at' => now(), // They clicked the signed link, so it's verified
                ]
            );

            Mail::to($reservation->email)->send(new RegistrationConfirmationEmail($reservation, $campaign));
        });

        return redirect()->route('campaign.thanks', ['slug' => $slug]);
    }

    public function thanks($slug)
    {
        return view('campaign.thanks');
    }
}
