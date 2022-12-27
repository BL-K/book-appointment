<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Exports\DoctorExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Hospital_Speciality;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class AdminDoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function doctor_list()
    {
        $doctor = Doctor::orderBy('doctor_id', 'DESC')->search()->paginate(10);

        return view('admin.doctor_list')->with(compact('doctor'));
    }

    public function doctor_add(Request $request)
    {
        $user = User::where('id', '>', 1)->get();
        $id = $request->id;
        $hospital_speciality = Hospital_Speciality::where('user_id', $id)->get();

        return view('admin.doctor_add')->with(compact('user', 'hospital_speciality'));
    }

    public function insert_doctor()
    {
        $data = request()->validate([
            'user_id' => 'required',
            'doctor_name' => 'required',
            'doctor_avatar' => 'required|image',
            'speciality_name' => 'required',
            'doctor_experience' => 'required',
            'doctor_dob' => 'required',
            'doctor_gender' => 'required',
            'doctor_contact' => ['required', 'regex:/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})/'],
            'doctor_email' => ['required', 'string', 'email', 'max:255'],
            'doctor_desc' => 'required',
            'doctor_address' => 'required',
            'doctor_city' => 'required',
        ]);

        $imagePath = request('doctor_avatar')->store('admin_uploads/doctor', 'public');

        $doctor = new Doctor();

        $doctor->user_id = $data['user_id'];
        $doctor->doctor_name = $data['doctor_name'];
        $doctor->doctor_avatar = $imagePath;
        $doctor->speciality_name = $data['speciality_name'];
        $doctor->doctor_experience = $data['doctor_experience'];
        $doctor->doctor_dob = $data['doctor_dob'];
        $doctor->doctor_gender = $data['doctor_gender'];
        $doctor->doctor_contact = $data['doctor_contact'];
        $doctor->doctor_email = $data['doctor_email'];
        $doctor->doctor_desc = $data['doctor_desc'];
        $doctor->doctor_address = $data['doctor_address'];
        $doctor->doctor_city = $data['doctor_city'];
        $doctor->save();

        return redirect()->back()->with('success', 'Tuyệt !!! Bác sĩ đã được tạo thành công.');
    }

    public function doctor_view($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);

        return view('admin.doctor_view')->with(compact('doctor'));
    }

    public function doctor_edit($doctor_id, Request $request)
    {
        $user = User::where('id', '>', 1)->get();
        $doctor = Doctor::find($doctor_id);
        $hospital_speciality = Hospital_Speciality::select('hospital_speciality.*', 'hospital_speciality.hospital_speciality_id')
            ->where('user_id', $user)
            ->get();

        return view('admin.doctor_edit')->with(compact('doctor', 'user', 'hospital_speciality'));
    }

    public function show_speciality(Request $request)
    {
        $user = $request->id;
        $hospital_speciality = Hospital_Speciality::select('hospital_speciality.*', 'hospital_speciality.hospital_speciality_id')
            ->where('user_id', $user)->get();

        return response()->json($hospital_speciality);
    }

    public function update_doctor($doctor_id)
    {
        $data = request()->validate([
            'user_id' => 'required',
            'doctor_name' => 'required',
            'speciality_name' => 'required',
            'doctor_experience' => 'required',
            'doctor_dob' => 'required',
            'doctor_gender' => 'required',
            'doctor_contact' => ['required', 'regex:/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})/'],
            'doctor_email' => ['required', 'string', 'email', 'max:255'],
            'doctor_desc' => 'required',
            'doctor_address' => 'required',
            'doctor_city' => 'required',
        ]);

        $doctor = Doctor::find($doctor_id);

        $avatar = request('doctor_avatar');

        if ($avatar) {
            $imagePath = request('doctor_avatar')->store('admin_uploads/doctor', 'public');

            $doctor->user_id = $data['user_id'];
            $doctor->doctor_name = $data['doctor_name'];
            $doctor->doctor_avatar = $imagePath;
            $doctor->speciality_name = $data['speciality_name'];
            $doctor->doctor_experience = $data['doctor_experience'];
            $doctor->doctor_dob = $data['doctor_dob'];
            $doctor->doctor_gender = $data['doctor_gender'];
            $doctor->doctor_contact = $data['doctor_contact'];
            $doctor->doctor_email = $data['doctor_email'];
            $doctor->doctor_desc = $data['doctor_desc'];
            $doctor->doctor_address = $data['doctor_address'];
            $doctor->doctor_city = $data['doctor_city'];
        } else {
            $doctor->user_id = $data['user_id'];
            $doctor->doctor_name = $data['doctor_name'];
            $doctor->speciality_name = $data['speciality_name'];
            $doctor->doctor_experience = $data['doctor_experience'];
            $doctor->doctor_dob = $data['doctor_dob'];
            $doctor->doctor_gender = $data['doctor_gender'];
            $doctor->doctor_contact = $data['doctor_contact'];
            $doctor->doctor_email = $data['doctor_email'];
            $doctor->doctor_desc = $data['doctor_desc'];
            $doctor->doctor_address = $data['doctor_address'];
            $doctor->doctor_city = $data['doctor_city'];
        }

        $doctor->save();

        return redirect()->back()->with('success', 'Tuyệt !!! Bác sĩ đã được cập nhật thành công.');
    }

    public function delete_doctor($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);

        $destinationPath = 'public/' . $doctor->doctor_avatar;
        if (file_exists($destinationPath)) {
            unlink($destinationPath);
        }

        $doctor->delete();

        return redirect()->back()->with('success', 'Bác sĩ đã được xóa thành công.');
    }

    public function doctor_export()
    {
        $doctor = Doctor::all();

        return Excel::download(new DoctorExport($doctor), 'doctor.xlsx');
    }

    public function doctor_report() 
    {
        $doctor = Doctor::all();

        $pdf = Pdf::loadView('report.doctor_admin_report', array('doctor' => $doctor))
                ->setPaper('a4', 'landscape');
        
        return $pdf->download('doctor.pdf');
    }
}
