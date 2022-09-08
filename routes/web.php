<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Doctor;

use App\Http\Livewire\Site\Easy;
use App\Http\Livewire\Site\AddPatient;
use App\Http\Livewire\Site\FollowingUp;
use App\Http\Livewire\Site\Examination;
use App\Http\Livewire\Site\Patients;
use App\Http\Livewire\Site\Message;
use App\Http\Livewire\Site\Reports;
use App\Http\Livewire\Site\Setting;

use App\Http\Livewire\Dashboard\Doctors;
use App\Http\Livewire\Dashboard\Specialization;
use App\Http\Livewire\Dashboard\Cities;
use App\Http\Livewire\Dashboard\Message\MessageInfo;
use App\Http\Livewire\Dashboard\Message\MessagesList;
use App\Http\Livewire\Dashboard\Message\NewMessage;


Route::middleware(['auth:doctor'])->group(function(){
    Route::get(' ',[Doctor\homeController::class,'index'])->name('home');
    Route::view('coming-soon','site.coming_soon')->name('coming.soon');
});

Route::prefix('doctor')->name('doctor.')->group(function(){

    Route::middleware(['guest:web'])->group(function(){
        Route::view('/login','site.login')->name('login');
        Route::post('/check',[Doctor\authController::class,'check'])->name('check');
        Route::get('/forget-password',[Doctor\authController::class,'forgetPassword'])->name('forget.password');
        Route::post('/forget-password',[Doctor\authController::class,'forgetPassword'])->name('forget.password'); 
    });

    Route::middleware(['auth:doctor', 'doctor.activation'])->group(function(){
        Route::get('',[Doctor\homeController::class,'index'])->name('home');
        Route::get('/logout',[Doctor\authController::class,'logout'])->name('logout');
        Route::get('/change-password',Setting\ChangePassword::class)->name('change.password');

        Route::get('/setting',[Doctor\doctorController::class,'index'])->name('setting');
        Route::get('/prespiction-setting',[Doctor\doctorController::class,'prespiction_setting'])->name('prespiction_setting');
        Route::get('/easy/patients',Easy\Patient::class)->name('easy.patients');
        Route::get('/easy/add-patient',Easy\Add::class)->name('easy.patient.add');

        Route::get('/new-reservation',AddPatient\NewReservation::class)->name('new.reservation');
        Route::get('/old-reservation',AddPatient\OldReservation::class)->name('old.reservation');

        Route::get('/following-up',FollowingUp\FollowingUpList::class)->name('followingUp');

        Route::view('/Examination','site.examination')->name('Examination');
        Route::get('/Examination/{type}',Examination\ExaminationList::class)->name('Examination.list');
        Route::get('/Examination/Resumption/{id}',Examination\ResumptionExaminationDetails::class)->name('examination.resumption.details');
        Route::get('/Examination/New/{id}',Examination\NewExaminationDetails::class)->name('examination.new.details');

        Route::get('/patients',Patients\All::class)->name('patients.list');
        Route::get('/patient/{id}',Patients\Profile::class)->name('patients.profile');

        Route::get('/messages/{type}',Message\MessagesList::class)->name('messages.list');
        Route::get('/send-message',Message\SendMessage::class)->name('messages.send');
        Route::get('/message-info/{id}',Message\MessageInfo::class)->name('messages.info');

        Route::view('reports','site.reports')->name('reports');
        Route::get('data-table-report', Reports\DataTableReport::class)->name('reports.data.table');
        Route::get('numbers-report',Reports\NumbersReport::class)->name('reports.number');
        Route::get('percantage-report',Reports\PercantageReport::class)->name('reports.percantage');


    });

});


Route::prefix('ertyuio')->name('dashboard.')->group(function(){

    Route::middleware(['guest:web'])->group(function(){
        Route::view('/login','dashboard.login')->name('login');
        Route::post('/check',[Dashboard\authController::class,'check'])->name('check');
    });

    Route::middleware(['auth:admin'])->group(function(){
        Route::view('','dashboard.home')->name('home');
        Route::get('/logout',[Dashboard\authController::class,'logout'])->name('logout');
        Route::get('/doctors/{flag}',Doctors::class)->name('doctors');
        Route::get('/specializations',Specialization::class)->name('Specializations');
        Route::get('/cities',Cities::class)->name('Cities');

        Route::get('/messages/{type}', MessagesList::class)->name('messages.list');
        Route::get('/send-message', NewMessage::class)->name('messages.send');
        Route::get('/message-info/{id}', MessageInfo::class)->name('messages.info');

    });

});


Route::prefix('user')->name('user.')->group(function(){

    Route::middleware(['guest:web'])->group(function(){
          Route::view('/login','user.login')->name('login');
    });

    Route::middleware(['auth:web'])->group(function(){
          Route::view('/home','user.home')->name('home');
    });

});
