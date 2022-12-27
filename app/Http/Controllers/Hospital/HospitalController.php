<?php

namespace App\Http\Controllers\Hospital;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Hospital;
use App\Models\Speciality;
use App\Models\Hospital_Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\BaseController;
use Carbon\Carbon;

class HospitalController extends BaseController
{
    public function dashboard() 
    {
        $doctor = Doctor::select('doctor.*','doctor.doctor_id')
                        ->join('users','doctor.user_id','=','users.id')
                        ->where('doctor.user_id', $this->user->id)
                        ->get();

        $patient = Patient::select('patient.*', 'patient.patient_id')
                        ->join('users', 'patient.user_id', '=', 'users.id')
                        ->where('patient.user_id', $this->user->id)
                        ->get();

        $appointment = Appointment::select('appointment.*','appointment.appointment_id')
                        ->join('users','appointment.user_id','=','users.id')
                        ->where('appointment.user_id', $this->user->id)
                        ->get();

        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $appointment_day = Appointment::select('appointment.*','appointment.appointment_id')
                                    ->join('users','appointment.user_id','=','users.id')
                                    ->join('slot','appointment.slot_id','=','slot.slot_id')
                                    ->where('appointment.user_id', $this->user->id)
                                    ->whereDate('slot.date', '=', $now)
                                    ->get();
                        
        return view('hospital.dashboard')->with(compact('doctor', 'patient', 'appointment', 'appointment_day'));
    }
    
    public function hospital_profile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $speciality = Speciality::all();
        $hospital_speciality = Hospital_Speciality::select('hospital_speciality.*', 'hospital_speciality.hospital_speciality_id')
                                                    ->where('user_id', $user->id)->get();

        return view('hospital.hospital_profile')->with(compact('user', 'speciality', 'hospital_speciality'));
    }

    public function hospital_profile_edit($id)
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

        if($image)
        {
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
        }
        else
        {
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
        foreach ($data['speciality_name'] as $speciality_name) {
            Hospital_Speciality::create([
                'user_id' => $user->id,
                'speciality_name' => $speciality_name,
            ]);
        }

        $user->save();
        
        return redirect('hospital/hospital_profile')->with('success', 'Tuyệt !!! Thông tin đã được cập nhật thành công.');
    }

    public function hospital_password()
    {
        return view('hospital.hospital_password');
    }

    public function hospital_change_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect('hospital/hospital_password')->with('success', 'Tuyệt !!! Thay đổi mật khẩu thành công.');
    }
}
