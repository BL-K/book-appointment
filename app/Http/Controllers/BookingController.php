<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Slot;
use App\Models\Time;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Medical_Record;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function book_appointment($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);
        $now = Carbon::now();
        $slot = Slot::where('doctor_id', $doctor_id)->whereDate('date', '>', $now)->get();

        return view('book_appointment')->with(compact('doctor', 'slot'));
    }
    
    public function show_time(Request $request)
    {
        $slot = $request->slot_id;
        $time = Time::select('time_id','slot_id','time')->where('slot_id', $slot)->where('status', 0)->get();

        return response()->json($time);
    }

    public function booking(Request $request)
    {
        $this->validate($request,[
            'user_id' => 'required',
            'patient_name' => 'required',
            'patient_dob' => 'required',
            'patient_gender' => 'required',
            'patient_email' => ['required', 'string', 'email', 'max:255'],
            'patient_contact' => ['required', 'regex:/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})/'],
            'patient_address' => 'required',
            'patient_city' => 'required',
            'doctor_id' => 'required',
            'slot_id' => 'required',
            'time' => 'required',
            'reason' => 'required',
        ]);

        $patient = Patient::create([
            'user_id' => $request->user_id,
            'patient_name' => $request->patient_name,
            'patient_dob' => $request->patient_dob,
            'patient_gender' => $request->patient_gender,
            'patient_email' => $request->patient_email,
            'patient_contact' => $request->patient_contact,
            'patient_address' => $request->patient_address,
            'patient_city' => $request->patient_city,
        ]);

        $appointment = Appointment::create([
            'user_id' => $request->user_id,
            'patient_name' => $patient->patient_name,
            'patient_contact' => $patient->patient_contact,
            'patient_email' => $patient->patient_email,
            'doctor_id' => $request->doctor_id,
            'slot_id' => $request->slot_id,
            'time' => $request->time,
            'reason' => $request->reason,
            'token' => strtoupper(Str::random(20)),
            'confirm' => 0,
            'receive' => 0,
            'status' => 0,
        ]);

        if($request->has('medical_record')){
            foreach($request->file('medical_record') as $medical_record)
            {
                $medical_recordName = $request->patient_name.'-medical_record-'.time().rand(1,1000).'.'.$medical_record->extension();
                $medical_record->storeAs('medical_record', $medical_recordName);
                Medical_Record::create([
                    'appointment_id' => $appointment->appointment_id,
                    'medical_record' => $medical_recordName,
                ]);
            }
        }

        $time = $request->time;
        $slot_id = $request->slot_id;
        Time::where('slot_id', $slot_id)->where('time', $time)->update(['status' => 1]);

        Mail::send('mail.check_confirm', compact('patient', 'appointment'), function ($email) use ($patient){
            $email->subject('Medical Register - Xác nhận lịch hẹn');
            $email->to($patient->patient_email, $patient->patient_name);
        });

        return redirect()->back()->with('success', 'Đặt lịch hẹn thành công. Medical Register sẽ gửi thông báo để xác nhận.');     
    }

    public function appointment_confirm($appointment_id, $token, Request $request)
    {
        $appointment = Appointment::find($appointment_id);
        if ($appointment->token === $token)
        {
            Mail::send('mail.confirm', compact('appointment'), function ($email) use ($appointment){
                $email->subject('Medical Register - Xác nhận lịch hẹn thành công');
                $email->to($appointment->patient_email, $appointment->patient_name);
            });
            Appointment::where('appointment_id', $appointment_id)->update(['confirm' => 1]);
            return redirect('home');
        }
        else
        {
            return view('mail.404');
        }
    }
}
