<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AppointmentDayExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($appointment_day) 
    {
        $this->appointment_day = $appointment_day;
    }

    public function view(): View
    {
        return view('export.appointment_day_export', [
            'appointment_day'=>$this->appointment_day
        ]);
    }
}
