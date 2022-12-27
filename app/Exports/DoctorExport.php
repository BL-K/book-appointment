<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DoctorExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($doctor) 
    {
        $this->doctor = $doctor;
    }

    public function view(): View
    {
        return view('export.doctor_export', [
            'doctor'=>$this->doctor
        ]);
    }
}
