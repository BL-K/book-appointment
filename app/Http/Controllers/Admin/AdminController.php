<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Hospital;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Exports\PatientExport;
use App\Rules\MatchOldPassword;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AppointmentExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AppointmentDayExport;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin_account()
    {
        return view('admin.admin_account');
    }

    public function admin_change_profile(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        User::find(auth()->user()->id)->update(['name'=> $request->name,
                                                'email'=> $request->email]);

        return redirect()->back()->with('success_1', 'Tuyệt !!! Thông tin đã được thay đổi thành công.');
    }

    public function admin_change_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->back()->with('success_2', 'Tuyệt !!! Thay đổi mật khẩu thành công.');
    }

    public function dashboard() 
    {
        $hospital = Hospital::all();
        $doctor = Doctor::all();
        $patient = Patient::all();
        $appointment = Appointment::all();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $appointment_day = Appointment::select('appointment.*','appointment.appointment_id')
                                    ->join('slot','appointment.slot_id','=','slot.slot_id')
                                    ->whereDate('slot.date', '=', $now)
                                    ->get();

        return view('admin.dashboard')->with(compact('hospital', 'doctor', 'patient', 'appointment', 'appointment_day'));
    }

    public function patient() 
    {
        $patient = Patient::orderBy('patient_id', 'DESC')->search()->paginate(10);

        return view('admin.patient')->with(compact('patient'));
    }

    public function delete_patient($patient_id)
    {
        $patient = Patient::find($patient_id);
        $patient->delete();

        return redirect()->back()->with('success', 'Bệnh nhân đã được xóa thành công.');
    }

    public function patient_export() 
    {
        $patient = Patient::orderBy('patient_id', 'DESC')->get();

        return Excel::download(new PatientExport($patient), 'patient.xlsx');
    }

    public function patient_report() 
    {
        $patient = Patient::orderBy('patient_id', 'DESC')->get();

        $pdf = Pdf::loadView('report.patient_admin_report', array('patient' => $patient))
                ->setPaper('a4', 'landscape');
        
        return $pdf->download('patient.pdf');
    }

    public function appointment_day() 
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $appointment_day = Appointment::select('appointment.*','appointment.appointment_id')
                                    ->join('slot','appointment.slot_id','=','slot.slot_id')
                                    ->whereDate('slot.date', '=', $now)
                                    ->search()->paginate(10);

        return view('admin.appointment_day')->with(compact('appointment_day'));
    }

    public function appointment() 
    {
        $appointment = Appointment::orderBy('appointment_id', 'DESC')->search()->paginate(10);

        return view('admin.appointment')->with(compact('appointment'));
    }

    public function appointment_view($appointment_id)
    {
        $appointment = Appointment::find($appointment_id);
        $speciality = Speciality::all();

        return view('admin.appointment_view')->with(compact('appointment', 'speciality'));
    }

    public function delete_appointment($appointment_id)
    {
        $appointment = Appointment::find($appointment_id);
        $appointment->delete();

        return redirect()->back()->with('success', 'Lịch hẹn đã được xóa thành công.');
    }

    public function appointment_export() 
    {
        $appointment = Appointment::orderBy('appointment_id', 'DESC')->get();

        return Excel::download(new AppointmentExport($appointment), 'appointment.xlsx');
    }

    public function appointment_report() 
    {
        $appointment = Appointment::orderBy('appointment_id', 'DESC')->get();

        $arrived = Appointment::orderBy('appointment_id', 'DESC')
                                ->where('appointment.status', '=', '1')
                                ->get();
                    
        $not_arrived = Appointment::orderBy('appointment_id', 'DESC')
                                ->where('appointment.status', '=', '0')
                                ->get();

        $pdf = Pdf::loadView('report.appointment_admin_report', array('appointment' => $appointment, 'arrived' => $arrived, 'not_arrived' => $not_arrived))
                ->setPaper('a4', 'landscape');
        
        return $pdf->download('appointment.pdf');
    }

    public function appointment_day_export() 
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $appointment_day = Appointment::orderBy('appointment_id', 'DESC')
                                    ->select('appointment.*','appointment.appointment_id')
                                    ->join('slot','appointment.slot_id','=','slot.slot_id')
                                    ->whereDate('slot.date', '=', $now)
                                    ->get();

        return Excel::download(new AppointmentDayExport($appointment_day), 'appointment_day.xlsx');
    }

    public function appointment_day_report() 
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $appointment_day = Appointment::orderBy('appointment_id', 'DESC')
                                    ->select('appointment.*','appointment.appointment_id')
                                    ->join('slot','appointment.slot_id','=','slot.slot_id')
                                    ->whereDate('slot.date', '=', $now)
                                    ->get();

        $arrived = Appointment::orderBy('appointment_id', 'DESC')
                                ->select('appointment.*','appointment.appointment_id')
                                ->join('slot','appointment.slot_id','=','slot.slot_id')
                                ->whereDate('slot.date', '=', $now)
                                ->where('appointment.status', '=', '1')
                                ->get();
                    
        $not_arrived = Appointment::orderBy('appointment_id', 'DESC')
                                ->select('appointment.*','appointment.appointment_id')
                                ->join('slot','appointment.slot_id','=','slot.slot_id')
                                ->whereDate('slot.date', '=', $now)
                                ->where('appointment.status', '=', '0')
                                ->get();

        $pdf = Pdf::loadView('report.appointment_day_admin_report', array('appointment_day' => $appointment_day, 'now' => $now, 'arrived' => $arrived, 'not_arrived' => $not_arrived))
                ->setPaper('a4', 'landscape');
        
        return $pdf->download('appointment_day.pdf');
    }
}
