<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Speciality;

class AdminSpecialityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function speciality()
    {
        $speciality = Speciality::orderBy('speciality_id', 'DESC')->search()->paginate(10);

        return view('admin.speciality')->with(compact('speciality'));
    }

    public function insert_speciality()
    {
        $data = request()->validate([
            'speciality_name' => 'required',
            'speciality_icon' => 'required|image'
        ]);
        
        $iconPath = request('speciality_icon')->store('admin_uploads/speciality', 'public');
        
        $speciality = new Speciality();

        $speciality->speciality_name = $data['speciality_name'];
        $speciality->speciality_icon = $iconPath;
        $speciality->save();
        
        return redirect()->back()->with('success', 'Tuyệt !!! Chuyên khoa đã được tạo thành công.');
    }

    public function speciality_edit($speciality_id)
    {
        $speciality = Speciality::find($speciality_id);

        return view('admin.speciality_edit')->with(compact('speciality'));
    }

    public function update_speciality($speciality_id)
    {
        $data = request()->validate([
            'speciality_name' => 'required'        
        ]);

        $speciality = Speciality::find($speciality_id);

        $icon = request('speciality_icon');

        if($icon)
        {
            $iconPath = request('speciality_icon')->store('admin_uploads/speciality', 'public');

            $speciality->speciality_name = $data['speciality_name'];
            $speciality->speciality_icon = $iconPath;
        }
        else
        {
            $speciality->speciality_name = $data['speciality_name'];
        }

        $speciality->save();
        
        return redirect()->back()->with('success', 'Tuyệt !!! Chuyên khoa đã được cập nhật thành công.');
    }

    public function delete_speciality($speciality_id)
    {
        $speciality = Speciality::find($speciality_id);

        $destinationPath = 'public/admin_uploads'.$speciality->speciality_icon;
        if(file_exists($destinationPath))
        {
            unlink($destinationPath);
        }
        
        $speciality->delete();
        
        return redirect()->back()->with('success', 'Chuyên khoa đã được xóa thành công.');
    }

}
