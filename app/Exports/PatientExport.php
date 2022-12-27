<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PatientExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($patient) 
    {
        $this->patient = $patient;
    }

    public function view(): View
    {
        return view('export.patient_export', [
            'patient'=>$this->patient
        ]);
    }
}
