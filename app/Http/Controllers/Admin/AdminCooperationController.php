<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cooperation;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\CooperationExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AdminCooperationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cooperation_list()
    {
        $cooperation = Cooperation::orderBy('cooperation_id', 'DESC')->search()->paginate(10);

        return view('admin.cooperation_list')->with(compact('cooperation'));
    }

    public function cooperation_view($cooperation_id)
    {
        $doccooperationtor = Cooperation::all();
        $cooperation = Cooperation::find($cooperation_id);

        return view('admin.cooperation_view')->with(compact('cooperation'));
    }

    public function delete_cooperation($cooperation_id)
    {
        $cooperation = Cooperation::find($cooperation_id);
        $cooperation->delete();

        return redirect()->back()->with('success', 'Hợp tác đã được xóa thành công.');
    }

    public function cooperation_export() 
    {
        $cooperation = Cooperation::all();

        return Excel::download(new CooperationExport($cooperation), 'cooperation.xlsx');
    }

    public function cooperation_report() 
    {
        $cooperation = Cooperation::all();

        $pdf = Pdf::loadView('report.cooperation_report', array('cooperation' => $cooperation))
                ->setPaper('a4', 'landscape');
        
        return $pdf->download('cooperation.pdf');
    }

}
