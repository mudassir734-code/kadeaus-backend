<?php

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Chat\ChatController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Doctor\DoctorController;
use App\Http\Controllers\Admin\Patient\PatientController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Hospital\HospitalController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Department\DepartmentController;
use App\Http\Controllers\Admin\Appointment\AppointmentController;
use App\Http\Controllers\Admin\Hospital\HospitalDetailController;
use App\Models\Hospital;

Route::get('/', function () {
    return redirect(route('login'));
});
// only Admins can manage users
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users',       [UserController::class, 'store'])->name('users.store');
        Route::get('/users/view', [UserController::class, 'view'])->name('users.view');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'admin','as' => 'admin.'], function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    Route::get('/appointment',[AppointmentController::class, 'index'])->name('appointment');
    Route::get('/appointment/view-detail',[AppointmentController::class, 'viewDetail'])->name('appointment.viewDetail');

    // chat routes 
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');


    //Hospital Routes
    Route::group(['prefix' => 'hospital'], function(){
        Route::get('/list', [HospitalController::class, 'index'])->name('hospital');
        Route::get('/add-hospital', [HospitalController::class, 'create'])->name('hospital.addHospital');
        Route::post('/store', [HospitalController::class, 'store'])->name('hospitals.store');
        Route::get('/edit/{id}', [HospitalController::class, 'edit'])->name('hospital.hospitalEdit');
        Route::post('/update/{id}', [HospitalController::class, 'update'])->name('hospital.hospitalUpdate');
        Route::get('/detail/{id}', [HospitalController::class, 'view'])->name('hospital.hospitalDetail');
        Route::delete('/delete/{id}', [HospitalController::class, 'destroy'])->name('hospital.destroy');
        Route::get('/invoice/billing/detail', [HospitalController::class, 'invoiceDetail'])->name('hospital.invoiceDetail');
    });

    Route::group(['prefix' => 'hospital/tab'], function() {
        Route::get('detail/{id}', [HospitalDetailController::class, 'detail'])->name('hospital.detail');
        Route::get('doctor/view/{id}', [HospitalDetailController::class, 'view'])->name('hospital.view');
        Route::get('nurse/list', [HospitalDetailController::class, 'nurse_list'])->name('hospital.nurse_list');
        Route::get('add/nurse', [HospitalDetailController::class, 'add_nurse'])->name('hospital.add_nurse');
        Route::post('store/nurse', [HospitalDetailController::class, 'store_nurse'])->name('hospital.store_nurse');
        Route::get('nurse/view/{id}', [HospitalDetailController::class, 'nurse_view'])->name('hospital.nurse_view');
        Route::get('receptionist/list', [HospitalDetailController::class, 'receptionist_list'])->name('hospital.receptionist_list');
        Route::get('create/receptionist', [HospitalDetailController::class, 'create_receptionist'])->name('hospital.create_receptionist');
        Route::post('store/receptionist', [HospitalDetailController::class, 'store_receptionist'])->name('hospital.store_receptionist');
        Route::get('receptionist/view/{id}', [HospitalDetailController::class, 'view_receptionist'])->name('hospital.view_receptionist');
        Route::get('pharmacist/list', [HospitalDetailController::class, 'pharmacist_list'])->name('hospital.pharmacist_list');
        Route::get('create/pharmacist', [HospitalDetailController::class, 'create_pharmacist'])->name('hospital.create_pharmacist');
        Route::post('store/pharmacist', [HospitalDetailController::class, 'store_pharmacist'])->name('hospital.store_pharmacist');
        Route::get('view/pharmacist/{id}', [HospitalDetailController::class, 'view_pharmacist'])->name('hospital.view_pharmacist');
        Route::get('patient/list', [HospitalDetailController::class, 'patient_list'])->name('hospital.patient_list');
        Route::get('department/list', [HospitalDetailController::class, 'department_list'])->name('hospital.department_list');
    });

    // Department Routes
    Route::post('department/create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('department/store', [DepartmentController::class, 'store'])->name('department.store');

    // Doctor Routes
    Route::group(['prefix' => 'doctor'], function() {
    Route::get('/', [DoctorController::class, 'index'])->name('doctor');
    Route::get('/add-doctor', [DoctorController::class, 'create'])->name('doctor.addDoctor');
    Route::post('/store', [DoctorController::class, 'store'])->name('doctors.store');
    Route::get('/view-doctor', [DoctorController::class, 'viewDoctor'])->name('doctor.viewDoctor');
    Route::get('/departments/{id}', [DoctorController::class, 'getDepartments'])->name('doctor.departments');
    });


    // Patient Routes
    Route::group(['prefix' => 'patient'], function() {
    Route::get('/', [PatientController::class, 'index'])->name('patient');
    Route::get('/patient/view-patient', [PatientController::class, 'viewPatient'])->name('patient.viewPatient');
    });

    // Setting Routes
    Route::get('/setting',       [SettingController::class, 'index'])->name('setting');          
    Route::post('/setting',       [SettingController::class, 'update'])->name('setting.update');  
    Route::post('/setting/avatar',[SettingController::class, 'updateAvatar'])->name('setting.avatar');
    Route::post('/setting/password', [SettingController::class, 'changePassword'])->name('setting.password');

});

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/custom-logout', function () {
    Auth::logout();                                
    request()->session()->invalidate();            
    request()->session()->regenerateToken();       

    return redirect('/');                     
})->name('custom.logout');

require __DIR__.'/auth.php';
