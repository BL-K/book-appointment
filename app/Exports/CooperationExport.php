<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CooperationExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($cooperation) 
    {
        $this->cooperation = $cooperation;
    }

    public function view(): View
    {
        return view('export.cooperation_export', [
            'cooperation'=>$this->cooperation
        ]);
    }
}
