<?php

use App\Models\Campaign;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

// Create a dummy campaign
$campaign = Campaign::create([
    'slug' => 'test-campaign-' . uniqid(),
    'name' => 'Test Campaign',
    'status' => 'open',
    'application_start_at' => now()->subDay(),
    'application_end_at' => now()->addDay(),
    'event_date' => now()->addWeek(), // Added missing field
    'base_fee' => 1000,
    'companion_adult_fee' => 500,
    'companion_child_fee' => 200,
    'additional_parking_fee' => 1000,
]);

echo "Campaign created: {$campaign->id}\n";

// 1. Create Provisional Reservation
$reservation = Reservation::create([
    'campaign_id' => $campaign->id,
    'email' => 'test@example.com',
    'registered_at' => null,
]);

echo "Reservation created. ID: {$reservation->id}\n";
echo "Status (Accessor): " . $reservation->status . "\n"; // Should be '仮登録'
echo "Registered At: " . ($reservation->registered_at ? $reservation->registered_at : 'NULL') . "\n";

if ($reservation->status !== '仮登録') {
    echo "FAIL: Expected '仮登録', got '{$reservation->status}'\n";
    exit(1);
}

// 2. Update to Official (Simulation of store method)
$reservation->update([
    'name' => 'Test User',
    'name_kana' => 'テストユーザー',
    'tel' => '090-0000-0000',
    'zip_code' => '100-0000',
    'address' => 'Tokyo',
    'car_model' => 'Toyota',
    'car_year' => '2020',
    'car_registration_no' => '12-34',
    'companion_adult_count' => 1,
    'companion_child_count' => 0,
    'additional_parking_count' => 0,
    'transfer_date' => now(),
    'total_amount' => 1500,
    'registered_at' => now(),
]);

$reservation->refresh();

echo "Reservation updated.\n";
echo "Status (Accessor): " . $reservation->status . "\n"; // Should be '本登録'
echo "Registered At: " . $reservation->registered_at . "\n";

if ($reservation->status !== '本登録') {
    echo "FAIL: Expected '本登録', got '{$reservation->status}'\n";
    exit(1);
}

echo "SUCCESS: Status logic verification passed.\n";
