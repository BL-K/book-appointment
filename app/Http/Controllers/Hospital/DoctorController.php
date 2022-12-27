<?php

namespace App\Http\Controllers\Hospital;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Review;
use App\Exports\DoctorExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Hospital_Speciality;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Auth\BaseController;

class DoctorController extends BaseController
{
    public function doctor_list()
    {
        $doctor = Doctor::orderBy('doctor_id', 'DESC')
                            ->select('doctor.*','doctor.doctor_id')
                            ->join('users','doctor.user_id','=','users.id')
                            ->where('doctor.user_id', $this->user->id)
                            ->search()->paginate(10);

        return view('hospital.doctor_list')->with(compact('doctor'));
    }

    public function doctor_add()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $hospital_speciality = Hospital_Speciality::select('hospital_speciality.*', 'hospital_speciality.hospital_speciality_id')
                                                    ->join('users', 'hospital_speciality.user_id', '=', 'users.id')
                                                    ->where('hospital_speciality.user_id', $this->user->id)
                                                    ->get();

        return view('hospital.doctor_add')->with(compact('user', 'hospital_speciality'));
    }

    public function insert_doctor()
    {
        $data = request()->validate([
            'user_id' => 'required',
            'doctor_name' => 'required',
            'doctor_avatar' => 'required|image',
            'doctor_experience' => 'required',
            'doctor_dob' => 'required',
            'doctor_gender' => 'required',
            'doctor_contact' => ['required', 'regex:/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})/'],
            'doctor_email' => ['required', 'string', 'email', 'max:255'],
            'doctor_desc' => 'required',
            'doctor_address' => 'required',
            'doctor_city' => 'required',
            'speciality_name' => 'required',
        ]);

        $imagePath = request('doctor_avatar')->store('hospital_uploads/doctor', 'public');

        $doctor = new Doctor();

        $doctor->user_id = $data['user_id'];
        $doctor->doctor_name = $data['doctor_name'];
        $doctor->doctor_avatar = $imagePath;
        $doctor->doctor_experience = $data['doctor_experience'];
        $doctor->doctor_dob = $data['doctor_dob'];
        $doctor->doctor_gender = $data['doctor_gender'];
        $doctor->doctor_contact = $data['doctor_contact'];
        $doctor->doctor_email = $data['doctor_email'];
        $doctor->doctor_desc = $data['doctor_desc'];
        $doctor->doctor_address = $data['doctor_address'];
        $doctor->doctor_city = $data['doctor_city'];
        $doctor->speciality_name = $data['speciality_name'];
        $doctor->save();

        return redirect()->back()->with('success', 'Tuyệt !!! Bác sĩ đã được tạo thành công.');
    }

    public function doctor_view($doctor_id) 
    {
        $doctor = Doctor::find($doctor_id);

        return view('hospital.doctor_view')->with(compact('doctor'));
    }

    public function doctor_edit($doctor_id) 
    {
        $doctor = Doctor::find($doctor_id);
        $hospital_speciality = Hospital_Speciality::select('hospital_speciality.*', 'hospital_speciality.hospital_speciality_id')
                                                    ->join('users', 'hospital_speciality.user_id', '=', 'users.id')
                                                    ->where('hospital_speciality.user_id', $this->user->id)
                                                    ->get();

        return view('hospital.doctor_edit')->with(compact('doctor', 'hospital_speciality'));
    }

    public function update_doctor($doctor_id)
    {
        $data = request()->validate([
            'doctor_name' => 'required',
            'doctor_experience' => 'required',
            'doctor_dob' => 'required',
            'doctor_gender' => 'required',
            'doctor_contact' => ['required', 'regex:/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})/'],
            'doctor_email' => ['required', 'string', 'email', 'max:255'],
            'doctor_desc' => 'required',
            'doctor_address' => 'required',
            'doctor_city' => 'required',
            'speciality_name' => 'required',
        ]);

        $doctor = Doctor::find($doctor_id);

        $avatar = request('doctor_avatar');

        if($avatar)
        {
            $imagePath = request('doctor_avatar')->store('admin_uploads/doctor', 'public');
            
            $doctor->doctor_name = $data['doctor_name'];
            $doctor->doctor_avatar = $imagePath;
            $doctor->doctor_experience = $data['doctor_experience'];
            $doctor->doctor_dob = $data['doctor_dob'];
            $doctor->doctor_gender = $data['doctor_gender'];
            $doctor->doctor_contact = $data['doctor_contact'];
            $doctor->doctor_email = $data['doctor_email'];
            $doctor->doctor_desc = $data['doctor_desc'];
            $doctor->doctor_address = $data['doctor_address'];
            $doctor->doctor_city = $data['doctor_city'];
            $doctor->speciality_name = $data['speciality_name'];
        }
        else
        {
            $doctor->doctor_name = $data['doctor_name'];
            $doctor->doctor_experience = $data['doctor_experience'];
            $doctor->doctor_dob = $data['doctor_dob'];
            $doctor->doctor_gender = $data['doctor_gender'];
            $doctor->doctor_contact = $data['doctor_contact'];
            $doctor->doctor_email = $data['doctor_email'];
            $doctor->doctor_desc = $data['doctor_desc'];
            $doctor->doctor_address = $data['doctor_address'];
            $doctor->doctor_city = $data['doctor_city'];
            $doctor->speciality_name = $data['speciality_name'];
        }

        $doctor->save();
        
        return redirect()->back()->with('success', 'Tuyệt !!! Bác sĩ đã được cập nhật thành công.');
    }

    public function delete_doctor($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);

        $destinationPath = 'public/'.$doctor->doctor_avatar;
        if(file_exists($destinationPath))
        {
            unlink($destinationPath);
        }
        
        $doctor->delete();

        return redirect()->back()->with('success', 'Bác sĩ đã được xóa thành công.');
    }

    public function doctor_export() 
    {
        $doctor = Doctor::select('doctor.*','doctor.doctor_id')
                                ->join('users','doctor.user_id','=','users.id')
                                ->where('doctor.user_id', $this->user->id)
                                ->get();

        return Excel::download(new DoctorExport($doctor), 'doctor.xlsx');
    }

    public function doctor_report() 
    {
        $user = User::where('id', Auth::user()->id)->first();
        $doctor = Doctor::select('doctor.*','doctor.doctor_id')
                                ->join('users','doctor.user_id','=','users.id')
                                ->where('doctor.user_id', $this->user->id)
                                ->get();

        $pdf = Pdf::loadView('report.doctor_report', array('doctor' => $doctor, 'user' => $user))
                ->setPaper('a4', 'landscape');
        
        return $pdf->download('doctor.pdf');
    }

    public function review()
    {
        $doctor = Doctor::orderBy('doctor_id', 'DESC')
                        ->select('doctor.*','doctor.doctor_id')
                        ->join('users','doctor.user_id','=','users.id')
                        ->where('doctor.user_id', $this->user->id)
                        ->search()->paginate(10);

        return view('hospital/review')->with(compact('doctor'));
    }

    public function review_list($review_id)
    {
        $doctor = Doctor::find($review_id);
        $review = Review::orderBy('review_id', 'DESC')->where('doctor_id', $review_id)->search()->paginate(10);

        return view('hospital/review_list')->with(compact('review', 'doctor'));
    }

    public function delete_review($review_id)
    {
        $review = Review::find($review_id);
        $review->delete();

        return redirect()->back()->with('success', 'Tuyệt !!! Đánh giá đã được xóa thành công.');
    }

}
