<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Review;
use App\Models\Patient;
use App\Models\Speciality;
use App\Models\Appointment;
use App\Models\Cooperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Hospital_Speciality;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Auth\BaseController;
use App\Models\Blog;
use App\Models\Hospital;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function home()
    {
        return view('home');
    }

    public function hospital()
    {
        $user = User::where('id', '>', '1')->search()->paginate(10);

        return view('hospital')->with(compact('user'));
    }

    public function hospital_detail($id)
    {
        $user = User::find($id);

        return view('hospital_detail')->with(compact('user'));
    }

    public function hospital_speciality($id, Request $request)
    {
        $user = User::find($id);
        $hospital_speciality = Hospital_Speciality::select('hospital_speciality.*', 'hospital_speciality.hospital_speciality_id')
            ->join('users', 'hospital_speciality.user_id', '=', 'users.id')
            ->where('hospital_speciality.user_id', $id)
            ->search()->paginate(10);

        return view('hospital_speciality')->with(compact('user', 'hospital_speciality'));
    }

    public function hospital_speciality_doctor($user_id, $speciality_name)
    {
        $user = User::find($user_id);
        $speciality = Speciality::find($speciality_name);
        $doctor = Doctor::select('doctor.*', 'doctor.doctor_id', 'doctor.speciality_name')
                            ->join('speciality', 'speciality.speciality_name', '=', 'doctor.speciality_name')
                            ->where('doctor.user_id', '=', $user_id)
                            ->where('doctor.speciality_name', $speciality_name)
                            ->search()->paginate(10);

        return view('hospital_speciality_doctor')->with(compact('user', 'speciality', 'doctor'));
    }

    public function doctor()
    {
        $doctor = Doctor::orderBy('doctor_id')->search()->paginate(10);

        return view('doctor')->with(compact('doctor'));
    }

    public function doctor_detail($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);

        return view('doctor_detail')->with(compact('doctor'));
    }

    public function send_review(Request $request)
    {
        $doctor_id = $request->doctor_id;
        $review_name = $request->review_name;
        $review_content = $request->review_content;
        $review = new Review();

        $review->review_name = $review_name;
        $review->review = $review_content;
        $review->doctor_id = $doctor_id;
        $review->save();
    }

    public function load_review(Request $request)
    {
        $doctor_id = $request->doctor_id;
        $review = Review::where('doctor_id', $doctor_id)->get();
        $output = '';
        foreach ($review as $rev_list) {
            $output .= '<div class="widget review-listing">
                            <ul class="comments-list">
                                <li>
                                    <div class="comment">
                                        <div class="comment-body">
                                            <div class="meta-data">
                                                <span class="comment-author">' . $rev_list->review_name . '</span>
                                                <span class="comment-date">' . date('d-m-Y', strtotime($rev_list->created_at)) . '</span>
                                            </div>  
                                            <p class="comment-content">' . $rev_list->review . '</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>';
        }
        echo $output;
    }

    public function speciality()
    {
        $speciality = Speciality::orderBy('speciality_id', 'DESC')->search()->paginate(10);

        return view('speciality')->with(compact('speciality'));
    }

    public function speciality_doctor($doctor_id)
    {
        $doctor = Doctor::where('speciality_name', $doctor_id)->search()->paginate(10);

        return view('speciality_doctor')->with(compact('doctor'));
    }

    public function support()
    {
        return view('support');
    }

    public function cooperation()
    {
        $cooperation = Cooperation::all();

        return view('cooperation')->with(compact('cooperation'));
    }

    public function send_cooperation()
    {
        $data = request()->validate([
            'person_name' => 'required',
            'person_contact' => ['required', 'regex:/(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})/'],
            'person_email' => ['required', 'string', 'email', 'max:255'],
            'hospital_name' => 'required',
            'hospital_address' => 'required',
            'cooperation_content' => 'required',
        ]);

        $cooperation = new Cooperation();

        $cooperation->person_name = $data['person_name'];
        $cooperation->person_contact = $data['person_contact'];
        $cooperation->person_email = $data['person_email'];
        $cooperation->hospital_name = $data['hospital_name'];
        $cooperation->hospital_address = $data['hospital_address'];
        $cooperation->cooperation_content = $data['cooperation_content'];
        $cooperation->save();

        $user = User::find(1)->toArray();
        Mail::send('mail.notification', compact('user', 'cooperation'), function ($email) use ($user) {
            $email->subject('Medical Register - Thông báo hợp tác');
            $email->to($user['email']);;
        });

        return redirect()->back()->with('success', 'Yêu cầu hợp tác đã được gửi thành công. Chúng tôi sẽ liên hệ với bạn sớm nhất.');
    }

    public function history(Request $request)
    {
        if (request('patient_email')) {
            $patient_email = $request->patient_email;
            $patient = Patient::where('patient_email', $patient_email)->get();
            return view('history', compact('patient', 'patient_email'));
        };
        $patient = Patient::where('patient_id')->search()->paginate(10);

        return view('history')->with(compact('patient'));
    }

    public function history_appointment($patient_email)
    {
        $patient = Patient::find($patient_email);
        $appointment = Appointment::orderBy('appointment_id', 'DESC')->where('patient_email', $patient_email)->get();

        return view('history_appointment')->with(compact('patient', 'appointment'));
    }

    public function blog()
    {
        $blog = Blog::orderBy('blog_id', 'DESC')->search()->paginate(10);

        return view('blog')->with(compact('blog'));
    }

    public function blog_content($blog_id)
    {
        $blog = Blog::find($blog_id);

        return view('blog_content')->with(compact('blog'));
    }
}
