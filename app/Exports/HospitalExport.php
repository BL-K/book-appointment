<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class HospitalExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($hospital) 
    {
        $this->hospital = $hospital;
    }

    public function view(): View
    {
        return view('export.hospital_export', [
            'hospital'=>$this->hospital
        ]);
    }
}
