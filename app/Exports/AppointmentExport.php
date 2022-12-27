<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AppointmentExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($appointment) 
    {
        $this->appointment = $appointment;
    }

    public function view(): View
    {
        return view('export.appointment_export', [
            'appointment'=>$this->appointment
        ]);
    }
}
