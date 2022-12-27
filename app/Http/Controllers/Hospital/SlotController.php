<?php

namespace App\Http\Controllers\Hospital;

use App\Models\Slot;
use App\Models\Time;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\BaseController;

class SlotController extends BaseController
{
    public function slot()
    {
        $doctor = Doctor::select('doctor.*','doctor.doctor_id')
                            ->join('users','doctor.user_id','=','users.id')
                            ->where('doctor.user_id', $this->user->id)
                            ->search()->paginate(10);

        return view('hospital.slot')->with(compact('doctor'));
    }

    public function slot_add($doctor_id)
    {   
        $doctor = Doctor::find($doctor_id);

        return view('hospital.slot_add')->with(compact('doctor'));
    }


    public function insert_slot(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'doctor_id' => 'required',
            'time' => 'required',
        ]);

        $slot = Slot::create([
            'date' => $request->date,
            'doctor_id' => $request->doctor_id,
        ]);

        foreach($request->time as $time)    
        {
            Time::create([ 
                'slot_id' => $slot->slot_id,               
                'time' => $time,
                'status' => 0,
            ]);            
        }
        
        return redirect()->back()->with('success', 'Tuyệt !!! Tạo khung giờ thành công ngày ' . date('d-m-Y', strtotime($slot->date)));
    }

    public function slot_date($slot_id)
    {
        $doctor = Doctor::find($slot_id);
        $slot = Slot::orderBy('slot_id', 'DESC')->where('doctor_id', $slot_id)->search()->paginate(10);

        return view('hospital.slot_date')->with(compact('doctor', 'slot'));
    }

    public function slot_view_edit($slot_id)
    {
        $slot = Slot::find($slot_id);
        $time = Time::where('slot_id', $slot_id)->get();
        
        return view('hospital.slot_view_edit')->with(compact('slot', 'time'));
    }

    public function update_slot($slot_id, Request $request)
    {
        $slot = Slot::find($slot_id);
        $slot_id = $request->slot_id;
        $date = Slot::where('slot_id', $slot_id)->get('date')->first()->date;
        Time::where('slot_id', $slot_id)->delete();
        
        foreach ($request->time as $time) {
            Time::create([
                'slot_id' => $slot_id,
                'time' => $time,
                'status' => 0,
            ]);
        }
        return redirect()->back()->with('success', 'Tuyệt !!! Cập nhật lịch hẹn thành công ngày ' . date('d-m-Y', strtotime($slot->date)));
    }

    public function delete_slot($slot_id)
    {
        $slot = Slot::find($slot_id);
        $slot->delete();

        return redirect()->back()->with('success', 'Khung giờ làm việc đã được xóa thành công.');
    }

}
