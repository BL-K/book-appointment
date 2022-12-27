<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Hospital\SlotController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Hospital\DoctorController;
use App\Http\Controllers\Hospital\ReportController;
use App\Http\Controllers\Admin\AdminDoctorController;
use App\Http\Controllers\Hospital\HospitalController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AdminHospitalController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Hospital\AppointmentController;
use App\Http\Controllers\Admin\AdminSpecialityController;
use App\Http\Controllers\Auth\HospitalRegisterController;
use App\Http\Controllers\Admin\AdminCooperationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes([
    'register' => true,
    'verify' => true
]);

Route::get('/', function() {
    return view('home');
});

Route::prefix('auth')->group(function () {
    Route::get('login', [CheckLoginController::class, 'checkUserType']);
});

// Admin
Route::prefix('admin')->group(function () {
    Route::get('admin_account', [AdminController::class, 'admin_account'])->name('admin.admin_account');
    Route::post('admin_change_profile', [AdminController::class, 'admin_change_profile'])->name('admin.admin_change_profile');
    Route::post('admin_change_password', [AdminController::class, 'admin_change_password'])->name('admin.admin_change_password');
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard.dashboard');
    Route::get('account_user', [AdminController::class, 'account_user'])->name('admin.account_user.account_user');
// Hospital
    Route::get('hospital_add', [HospitalRegisterController::class, 'hospital_add'])->name('hospital_add');
    Route::post('insert_hospital', [HospitalRegisterController::class, 'insert_hospital']);
    Route::get('hospital_list', [AdminHospitalController::class, 'hospital_list'])->name('admin.hospital_list');
    Route::get('hospital_view/{id}', [AdminHospitalController::class, 'hospital_view'])->name('admin.hospital_view');
    Route::get('hospital_edit/{id}', [AdminHospitalController::class, 'hospital_edit'])->name('admin.hospital_edit');
    Route::post('update_hospital/{id}', [AdminHospitalController::class, 'update_hospital']);
    Route::get('delete_user/{id}', [AdminHospitalController::class, 'delete_user']);
    Route::get('hospital_export', [AdminHospitalController::class, 'hospital_export'])->name('admin.hospital_export');
    Route::get('hospital_report', [AdminHospitalController::class, 'hospital_report'])->name('admin.hospital_report');
// Doctor
    Route::get('doctor_list', [AdminDoctorController::class, 'doctor_list'])->name('admin.doctor_list');
    Route::get('doctor_add', [AdminDoctorController::class, 'doctor_add'])->name('admin.doctor_add');
    Route::get('/show_speciality', [AdminDoctorController::class, 'show_speciality']);
    Route::post('insert_doctor', [AdminDoctorController::class, 'insert_doctor']);
    Route::get('doctor_view/{doctor_id}', [AdminDoctorController::class, 'doctor_view'])->name('admin.doctor_view');
    Route::get('doctor_edit/{doctor_id}', [AdminDoctorController::class, 'doctor_edit'])->name('admin.doctor_edit');
    Route::post('update_doctor/{doctor_id}', [AdminDoctorController::class, 'update_doctor']);
    Route::get('delete_doctor/{doctor_id}', [AdminDoctorController::class, 'delete_doctor']);
    Route::get('doctor_export', [AdminDoctorController::class, 'doctor_export'])->name('admin.doctor_export');
    Route::get('doctor_report', [AdminDoctorController::class, 'doctor_report'])->name('admin.doctor_report');
// Patient & Appointment
    Route::get('patient', [AdminController::class, 'patient'])->name('admin.patient');
    Route::get('delete_patient/{patient_id}', [AdminController::class, 'delete_patient']);
    // Route::get('patient_export', [AdminController::class, 'patient_export'])->name('admin.patient_export');
    // Route::get('patient_report', [AdminController::class, 'patient_report'])->name('admin.patient_report');
    Route::get('appointment', [AdminController::class, 'appointment'])->name('admin.appointment');
    Route::get('appointment_day', [AdminController::class, 'appointment_day'])->name('admin.appointment_day');
    Route::get('appointment_view/{appointment_id}', [AdminController::class, 'appointment_view'])->name('hospital.appointment_view');
    Route::get('delete_appointment/{appointment_id}', [AdminController::class, 'delete_appointment']);
    // Route::get('appointment_export', [AdminController::class, 'appointment_export'])->name('admin.appointment_export');
    // Route::get('appointment_report', [AdminController::class, 'appointment_report'])->name('admin.appointment_report');
    // Route::get('appointment_day_export', [AdminController::class, 'appointment_day_export'])->name('admin.appointment_day_export');
    // Route::get('appointment_day_report', [AdminController::class, 'appointment_day_report'])->name('admin.appointment_day_report');
// Speciality
    Route::get('speciality', [AdminSpecialityController::class, 'speciality'])->name('admin.speciality');
    Route::post('insert_speciality', [AdminSpecialityController::class, 'insert_speciality']);
    Route::get('speciality_edit/{speciality_id}', [AdminSpecialityController::class, 'speciality_edit'])->name('admin.speciality_edit');
    Route::post('update_speciality/{speciality_id}', [AdminSpecialityController::class, 'update_speciality']);
    Route::get('delete_speciality/{speciality_id}', [AdminSpecialityController::class, 'delete_speciality']);
// Cooperation
    Route::get('cooperation_list', [AdminCooperationController::class, 'cooperation_list'])->name('admin.cooperation_list');
    Route::get('cooperation_view/{cooperation_id}', [AdminCooperationController::class, 'cooperation_view'])->name('admin.cooperation_view');
    Route::get('delete_cooperation/{cooperation_id}', [AdminCooperationController::class, 'delete_cooperation']);
    Route::get('cooperation_export', [AdminCooperationController::class, 'cooperation_export'])->name('admin.cooperation_export');
    Route::get('cooperation_report', [AdminCooperationController::class, 'cooperation_report'])->name('admin.cooperation_report');
// Blog
    Route::get('blog_list', [AdminBlogController::class, 'blog_list'])->name('admin.blog_list');
    Route::get('blog_add', [AdminBlogController::class, 'blog_add'])->name('admin.blog_add');
    Route::post('insert_blog', [AdminBlogController::class, 'insert_blog']);
    Route::get('blog_view_edit/{blog_id}', [AdminBlogController::class, 'blog_view_edit'])->name('admin.blog_view_edit');    
    Route::post('update_blog/{blog_id}', [AdminBlogController::class, 'update_blog']);
    Route::get('delete_blog/{blog_id}', [AdminBlogController::class, 'delete_blog']);
});

// Hospital
Route::prefix('hospital')->group(function () {
    Route::get('hospital_profile', [HospitalController::class, 'hospital_profile'])->name('hospital.hospital_profile');
    Route::post('hospital_profile_edit/{id}', [HospitalController::class, 'hospital_profile_edit'])->name('hospital.hospital_profile_edit');
    Route::get('hospital_password', [HospitalController::class, 'hospital_password'])->name('hospital.hospital_password');
    Route::post('hospital_change_password', [HospitalController::class, 'hospital_change_password'])->name('hospital.hospital_change_password');
    Route::get('dashboard', [HospitalController ::class, 'dashboard'])->name('hospital.dashboard.dashboard');
// Doctor
    Route::get('doctor_list', [DoctorController::class, 'doctor_list'])->name('hospital.doctor_list');
    Route::get('doctor_add', [DoctorController::class, 'doctor_add'])->name('hospital.doctor_add');
    Route::post('insert_doctor', [DoctorController::class, 'insert_doctor']);
    Route::get('doctor_view/{doctor_id}', [DoctorController::class, 'doctor_view'])->name('hospital.doctor_view');
    Route::get('doctor_edit/{doctor_id}', [DoctorController::class, 'doctor_edit'])->name('hospital.doctor_edit');
    Route::post('update_doctor/{doctor_id}', [DoctorController::class, 'update_doctor']);
    Route::get('delete_doctor/{doctor_id}', [DoctorController::class, 'delete_doctor']);
    Route::get('doctor_export', [DoctorController::class, 'doctor_export'])->name('hospital.doctor_export');
    Route::get('doctor_report', [DoctorController::class, 'doctor_report'])->name('hospital.doctor_report');
// Slot  
    Route::get('slot', [SlotController::class, 'slot'])->name('hospital.slot');
    Route::get('slot_date/{slot_id}', [SlotController::class, 'slot_date'])->name('hospital.slot_date');
    Route::get('slot_add/{doctor_id}', [SlotController::class, 'slot_add'])->name('hospital.slot_add');
    Route::post('insert_slot', [SlotController::class, 'insert_slot']);
    Route::get('slot_view_edit/{slot_id}', [SlotController::class, 'slot_view_edit'])->name('hospital.slot_view_edit');
    Route::post('update_slot/{slot_id}', [SlotController::class, 'update_slot']);
    Route::get('delete_slot/{slot_id}', [SlotController::class, 'delete_slot']);
// Patient & Appointment
    Route::get('patient', [AppointmentController::class, 'patient'])->name('hospital.patient');
    Route::get('delete_patient/{patient_id}', [AppointmentController::class, 'delete_patient']);
    // Route::get('patient_export', [AppointmentController::class, 'patient_export'])->name('hospital.patient_export');
    // Route::get('patient_report', [AppointmentController::class, 'patient_report'])->name('hospital.patient_report');
    Route::get('appointment', [AppointmentController::class, 'appointment'])->name('hospital.appointment');
    Route::get('appointment_day', [AppointmentController::class, 'appointment_day'])->name('hospital.appointment_day');
    Route::get('appointment_receive/{appointment_id}', [AppointmentController::class, 'appointment_receive']);
    Route::get('appointment_status/{appointment_id}', [AppointmentController::class, 'appointment_status']);
    Route::get('appointment_view/{appointment_id}', [AppointmentController::class, 'appointment_view'])->name('hospital.appointment_view');
    // Route::get('delete_appointment/{appointment_id}', [AppointmentController::class, 'delete_appointment']);
    // Route::get('appointment_export', [AppointmentController::class, 'appointment_export'])->name('hospital.appointment_export');
    // Route::get('appointment_day_export', [AppointmentController::class, 'appointment_day_export'])->name('hospital.appointment_day_export');
    // Route::get('appointment_report', [AppointmentController::class, 'appointment_report'])->name('hospital.appointment_report');
    // Route::get('appointment_day_report', [AppointmentController::class, 'appointment_day_report'])->name('hospital.appointment_day_report');
// Review
    Route::get('review', [DoctorController::class, 'review'])->name('hospital.review');
    Route::get('review_list/{review_id}', [DoctorController::class, 'review_list'])->name('hospital.review_list');
    Route::get('delete_review/{review_id}', [DoctorController::class, 'delete_review']);
// Report
    Route::get('patient_export', [ReportController::class, 'patient_export'])->name('hospital.patient_export');
    Route::get('patient_report', [ReportController::class, 'patient_report'])->name('hospital.patient_report');
    Route::get('appointment_export', [ReportController::class, 'appointment_export'])->name('hospital.appointment_export');
    Route::get('appointment_day_export', [ReportController::class, 'appointment_day_export'])->name('hospital.appointment_day_export');
    Route::get('appointment_report', [ReportController::class, 'appointment_report'])->name('hospital.appointment_report');
    Route::get('appointment_day_report', [ReportController::class, 'appointment_day_report'])->name('hospital.appointment_day_report');
}); 

Route::prefix('/')->group(function () {
    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::get('hospital', [HomeController::class, 'hospital'])->name('hospital');
    Route::get('hospital_detail/{id}', [HomeController::class, 'hospital_detail'])->name('hospital_detail');
    Route::get('hospital_speciality/{id}', [HomeController::class, 'hospital_speciality'])->name('hospital_speciality');
    Route::get('hospital_speciality_doctor/{user_id}/{speciality_name}', [HomeController::class, 'hospital_speciality_doctor'])->name('hospital_speciality_doctor');
    Route::get('doctor', [HomeController::class, 'doctor'])->name('doctor');
    Route::get('doctor_detail/{doctor_id}', [HomeController::class, 'doctor_detail'])->name('doctor_detail');
    Route::post('load-review', [HomeController::class, 'load_review']);
    Route::post('send-review', [HomeController::class, 'send_review']);
    Route::get('speciality', [HomeController::class, 'speciality'])->name('speciality');
    Route::get('speciality_doctor/{doctor_id}', [HomeController::class, 'speciality_doctor'])->name('speciality_doctor');
    Route::get('support', [HomeController::class, 'support'])->name('support');
    Route::get('cooperation', [HomeController::class, 'cooperation'])->name('cooperation');
    Route::post('send_cooperation', [HomeController::class, 'send_cooperation']);
    Route::get('history', [HomeController::class, 'history'])->name('history');
    Route::get('history_appointment/{patient_email}', [HomeController::class, 'history_appointment'])->name('history_appointment');
    Route::get('blog', [HomeController::class, 'blog'])->name('blog');
    Route::get('blog_content/{blog_id}', [HomeController::class, 'blog_content'])->name('blog_content');
// Booking
    Route::get('book_appointment/{doctor_id}', [BookingController::class, 'book_appointment'])->name('book_appointment');
    Route::get('/show_time', [BookingController::class, 'show_time']);
    Route::post('/booking', [BookingController::class, 'booking']);
    Route::get('send_mail', [BookingController::class, 'send_mail']);
    Route::get('appointment_confirm/{appointment_id}/{token}', [BookingController::class, 'appointment_confirm']);
});






