<?php

namespace App\Http\Controllers\Hospital;

use Carbon\Carbon;
use App\Models\Slot;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Exports\PatientExport;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AppointmentExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AppointmentDayExport;
use App\Http\Controllers\Auth\BaseController;
use App\Models\Medical_Record;

class AppointmentController extends BaseController
{
    public function patient() 
    {
        $patient = Patient::orderBy('patient_id', 'DESC')->select('patient.*', 'patient.patient_id')
                            ->join('users', 'patient.user_id', '=', 'users.id')
                            ->where('patient.user_id', $this->user->id)
                            ->search()->paginate(10);

        return view('hospital.patient')->with(compact('patient'));
    }

    public function delete_patient($patient_id)
    {
        $patient = Patient::find($patient_id);
        $patient->delete();

        return redirect()->back()->with('success', 'Bệnh nhân đã được xóa thành công.');
    }

    public function patient_export() 
    {
        $patient = Patient::orderBy('patient_id', 'DESC')->select('patient.*', 'patient.patient_id',)
                            ->join('users', 'patient.user_id', '=', 'users.id')
                            ->where('patient.user_id', $this->user->id)
                            ->get();
        return Excel::download(new PatientExport($patient), 'patient.xlsx');
    }

    public function patient_report() 
    {
        $user = User::where('id', Auth::user()->id)->first();
        $patient = Patient::orderBy('patient_id', 'DESC')->select('patient.*', 'patient.patient_id',)
                            ->join('users', 'patient.user_id', '=', 'users.id')
                            ->where('patient.user_id', $this->user->id)
                            ->get();

        $pdf = Pdf::loadView('report.patient_report', array('patient' => $patient, 'user' => $user))
                ->setPaper('a4', 'landscape');
        
        return $pdf->download('patient.pdf');
    }

    public function appointment_day(Request $request) 
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $appointment_day = Appointment::orderBy('appointment_id', 'DESC')
                                    ->select('appointment.*','appointment.appointment_id')
                                    ->join('users','appointment.user_id','=','users.id')
                                    ->join('slot','appointment.slot_id','=','slot.slot_id')
                                    ->where('appointment.user_id', $this->user->id)
                                    ->whereDate('slot.date', '=', $now)
                                    ->search()->paginate(10);

        return view('hospital.appointment_day')->with(compact('appointment_day', 'now'));
    }
    
    public function appointment() 
    {
        $appointment = Appointment::orderBy('appointment_id', 'DESC')
                                ->select('appointment.*','appointment.appointment_id')
                                ->join('users','appointment.user_id','=','users.id')
                                ->where('appointment.user_id', $this->user->id)
                                ->search()->paginate(10);

        return view('hospital.appointment')->with(compact('appointment'));
    }

    public function appointment_view($appointment_id)
    {
        $appointment = Appointment::find($appointment_id);
        $medical_record = Medical_Record::where('appointment_id', $appointment_id)->get();

        return view('hospital.appointment_view')->with(compact('appointment', 'medical_record'));
    }

    public function appointment_receive($appointment_id)
    {
        $appointment = Appointment::find($appointment_id);
        
        Mail::send('mail.receive', compact('appointment'), function ($email) use ($appointment){
            $email->subject('Medical Register - Tiếp nhận lịch hẹn');
            $email->to($appointment->patient_email, $appointment->patient_name);
        });
        Appointment::where('appointment_id', $appointment_id)->update(['receive' => 1]);

        return redirect()->back();
    }

    public function appointment_status($appointment_id)
    {
        Appointment::where('appointment_id', $appointment_id)->update(['status' => 1]);

        return redirect()->back();
    }

    // public function delete_appointment($appointment_id)
    // {
    //     $appointment = Appointment::find($appointment_id);
    //     $appointment->delete();

    //     return redirect()->back()->with('success', 'Lịch hẹn đã được xóa thành công.');
    // }
    
    public function appointment_export() 
    {
        $appointment = Appointment::orderBy('appointment_id', 'DESC')
                                ->select('appointment.*','appointment.appointment_id')
                                ->join('users','appointment.user_id','=','users.id')
                                ->where('appointment.user_id', $this->user->id)
                                ->get();

        return Excel::download(new AppointmentExport($appointment), 'appointment.xlsx');
    }

    public function appointment_day_export() 
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $appointment_day = Appointment::orderBy('appointment_id', 'DESC')
                                    ->select('appointment.*','appointment.appointment_id')
                                    ->join('users','appointment.user_id','=','users.id')
                                    ->join('slot','appointment.slot_id','=','slot.slot_id')
                                    ->where('appointment.user_id', $this->user->id)
                                    ->whereDate('slot.date', '=', $now)
                                    ->get();

        return Excel::download(new AppointmentDayExport($appointment_day), 'appointment_day.xlsx');
    }

    public function appointment_report() 
    {
        $user = User::where('id', Auth::user()->id)->first();
        $appointment = Appointment::orderBy('appointment_id', 'DESC')
                                ->select('appointment.*','appointment.appointment_id')
                                ->join('users','appointment.user_id','=','users.id')
                                ->where('appointment.user_id', $this->user->id)
                                ->get();

        $arrived = Appointment::orderBy('appointment_id', 'DESC')
                                ->select('appointment.*','appointment.appointment_id')
                                ->join('users','appointment.user_id','=','users.id')
                                ->where('appointment.user_id', $this->user->id)
                                ->where('appointment.status', '=', '1')
                                ->get();
                    
        $not_arrived = Appointment::orderBy('appointment_id', 'DESC')
                                ->select('appointment.*','appointment.appointment_id')
                                ->join('users','appointment.user_id','=','users.id')
                                ->where('appointment.user_id', $this->user->id)
                                ->where('appointment.status', '=', '0')
                                ->get();

        $pdf = Pdf::loadView('report.appointment_report', array('appointment' => $appointment, 'user' => $user, 'arrived' => $arrived, 'not_arrived' => $not_arrived))
                ->setPaper('a4', 'landscape');
        
        return $pdf->download('appointment.pdf');
    }

    public function appointment_day_report() 
    {
        $user = User::where('id', Auth::user()->id)->first();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $appointment_day = Appointment::orderBy('appointment_id', 'DESC')
                                    ->select('appointment.*','appointment.appointment_id')
                                    ->join('users','appointment.user_id','=','users.id')
                                    ->join('slot','appointment.slot_id','=','slot.slot_id')
                                    ->whereDate('slot.date', '=', $now)
                                    ->where('appointment.user_id', $this->user->id)
                                    ->get();

        $arrived = Appointment::orderBy('appointment_id', 'DESC')
                                ->select('appointment.*','appointment.appointment_id')
                                ->join('users','appointment.user_id','=','users.id')
                                ->join('slot','appointment.slot_id','=','slot.slot_id')
                                ->where('appointment.user_id', $this->user->id)
                                ->whereDate('slot.date', '=', $now)
                                ->where('appointment.status', '=', '1')
                                ->get();
                    
        $not_arrived = Appointment::orderBy('appointment_id', 'DESC')
                                ->select('appointment.*','appointment.appointment_id')
                                ->join('users','appointment.user_id','=','users.id')
                                ->join('slot','appointment.slot_id','=','slot.slot_id')
                                ->where('appointment.user_id', $this->user->id)
                                ->where('appointment.status', '=', '0')
                                ->whereDate('slot.date', '=', $now)
                                ->get();

        $pdf = Pdf::loadView('report.appointment_day_report', array('appointment_day' => $appointment_day, 'user' => $user, 'now' => $now, 'arrived' => $arrived, 'not_arrived' => $not_arrived))
                ->setPaper('a4', 'landscape');
        
        return $pdf->download('appointment_day.pdf');
    }

}
