<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Hospital;
use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Exports\HospitalExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Hospital_Speciality;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;


class AdminHospitalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function hospital_list()
    {
        $user = User::where('id', '>', 1)->search()->paginate(10);
        $hospital = Hospital::all();

        return view('admin.hospital_list')->with(compact('user', 'hospital'));
    }

    public function hospital_view($id)
    {
        $user = User::find($id);
        $hospital_speciality = Hospital_Speciality::select('hospital_speciality.*', 'hospital_speciality.hospital_speciality_id')
                                                    ->where('user_id', $id)->get();

        return view('admin.hospital_view')->with(compact('user', 'hospital_speciality'));
    }

    public function hospital_edit($id)
    {
        $user = User::find($id);
        $speciality = Speciality::all();
        $hospital_speciality = Hospital_Speciality::select('hospital_speciality.*', 'hospital_speciality.hospital_speciality_id')
                                                    ->where('user_id', $user->id)->get();

        return view('admin.hospital_edit')->with(compact('user', 'speciality', 'hospital_speciality'));
    }

    protected function update_hospital($id, Request $request)
    {
        $data = request()->validate([
            'hospital_contact' => ['required', 'regex:/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})/'],
            'hospital_url' => 'required',
            'hospital_desc' => 'required',
            'hospital_address' => 'required',
            'hospital_city' => 'required',
            'open_week' => 'required',
            'close_week' => 'required',
            'open_sat' => 'required',
            'close_sat' => 'required',
            'open_sun' => 'required',
            'close_sun' => 'required',
            'speciality_name' => 'required',
        ]);

        $user = User::find($id);
        
        $hospital = Hospital::where('user_id', $user->id)->first();
        $image = request('hospital_image');

        if ($image) {
            $imagePath = request('hospital_image')->store('admin_uploads/hospital', 'public');

            $hospital->hospital_image = $imagePath;
            $hospital->hospital_contact = $data['hospital_contact'];
            $hospital->hospital_url = $data['hospital_url'];
            $hospital->hospital_desc = $data['hospital_desc'];
            $hospital->hospital_address = $data['hospital_address'];
            $hospital->hospital_city = $data['hospital_city'];
            $hospital->open_week = $data['open_week'];
            $hospital->close_week = $data['close_week'];
            $hospital->open_sat = $data['open_sat'];
            $hospital->close_sat = $data['close_sat'];
            $hospital->open_sun = $data['open_sun'];
            $hospital->close_sun = $data['close_sun'];
        } else {
            $hospital->hospital_contact = $data['hospital_contact'];
            $hospital->hospital_url = $data['hospital_url'];
            $hospital->hospital_desc = $data['hospital_desc'];
            $hospital->hospital_address = $data['hospital_address'];
            $hospital->hospital_city = $data['hospital_city'];
            $hospital->open_week = $data['open_week'];
            $hospital->close_week = $data['close_week'];
            $hospital->open_sat = $data['open_sat'];
            $hospital->close_sat = $data['close_sat'];
            $hospital->open_sun = $data['open_sun'];
            $hospital->close_sun = $data['close_sun'];
        }
        $hospital->save();

        Hospital_Speciality::where('user_id', $user->id)->delete();
        foreach ($request->speciality_name as $speciality_name) {
            Hospital_Speciality::create([
                'user_id' => $user->id,
                'speciality_name' => $speciality_name,
            ]);
        }

        $user->save();

        return redirect()->back()->with('success', 'Tuyệt !!! Bệnh viện đã được cập nhật thành công.');
    }

    public function delete_user($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'Bệnh viện đã dược xóa thành công.');
    }

    public function hospital_export() 
    {
        $hospital = Hospital::all();

        return Excel::download(new HospitalExport($hospital), 'hospital.xlsx');
    }

    public function hospital_report() 
    {
        $hospital = Hospital::all();

        $pdf = Pdf::loadView('report.hospital_report', array('hospital' => $hospital))
                ->setPaper('a4', 'landscape');
        
        return $pdf->download('hospital.pdf');
    }
}
