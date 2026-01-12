<?php

namespace App\Exports;

use App\Models\Reservation;
use App\Models\Campaign;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class ReservationsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function query()
    {
        return Reservation::query()->where('campaign_id', $this->campaign->id);
    }

    public function headings(): array
    {
        $headers = [
            'ID',
            'Registered At',
            'Status',
            'Email',
            'Name',
            'Name Kana',
            'Tel',
            'Zip Code',
            'Address',
            'Car Model',
            'Car Year',
            'Car Reg No',
            'Adult Count',
            'Child Count',
            'Extra Parking',
            'Total Amount',
            'Transfer Date',
        ];

        if ($this->campaign->survey_definition) {
            foreach ($this->campaign->survey_definition as $q) {
                $headers[] = $q['label'] ?? 'Question';
            }
        }

        return $headers;
    }

    public function map($reservation): array
    {
        $status = $reservation->registered_at ? '登録完了' : '仮登録';

        $row = [
            $reservation->id,
            $reservation->registered_at,
            $status,
            $reservation->email,
            $reservation->name,
            $reservation->name_kana,
            $reservation->tel,
            $reservation->zip_code,
            $reservation->address,
            $reservation->car_model,
            $reservation->car_year,
            $reservation->car_registration_no,
            $reservation->companion_adult_count,
            $reservation->companion_child_count,
            $reservation->additional_parking_count,
            $reservation->total_amount,
            $reservation->transfer_date,
        ];

        // Add Survey Data
        $surveyData = $reservation->survey_data ?? [];
        if ($this->campaign->survey_definition) {
             foreach ($this->campaign->survey_definition as $q) {
                 $label = $q['label'] ?? '';
                 $answer = $surveyData[$label] ?? '';

                 if (is_array($answer)) {
                     $answer = implode(', ', $answer);
                 }
                 $row[] = $answer;
             }
        }

        return $row;
    }
}
