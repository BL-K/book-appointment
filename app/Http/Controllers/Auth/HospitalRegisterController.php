<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Hospital;
use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Models\Hospital_Speciality;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class HospitalRegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    protected $redirectTo = '/admin/hospital_list';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function hospital_add()
    {
        $speciality = Speciality::all();

        return view('admin.hospital_add')->with(compact('speciality'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'email' =>  ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'hospital_image' => 'required|image',
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
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'userType' => 'USR',
            'password' => Hash::make($data['password']),
        ]);

        $imagePath = request('hospital_image')->store('admin_uploads/hospital', 'public');

        $hospital = Hospital::create([
            'user_id' => $user->id,
            'hospital_name' => $user->name,
            'hospital_image' => $imagePath,
            'hospital_contact' => $data['hospital_contact'],
            'hospital_email' => $user->email,
            'hospital_url' => $data['hospital_url'],
            'hospital_desc' => $data['hospital_desc'],
            'hospital_address' => $data['hospital_address'],
            'hospital_city' => $data['hospital_city'],
            'open_week' => $data['open_week'],
            'close_week' => $data['close_week'],
            'open_sat' => $data['open_sat'],
            'close_sat' => $data['close_sat'],
            'open_sun' => $data['open_sun'],
            'close_sun' => $data['close_sun'],
        ]);

        foreach($data['speciality_name'] as $speciality_name)    
        {
            Hospital_Speciality::create([ 
                'user_id' => $user->id,               
                'speciality_name' => $speciality_name,
            ]);            
        }
    }

    protected function insert_hospital(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        flash('Tuyệt !!! Bệnh viện đã được tạo thành công.')->success();

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                ?: redirect($this->redirectPath());
    }
}
