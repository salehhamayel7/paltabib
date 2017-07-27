<?php

use Illuminate\Support\Facades\DB;
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

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/', function () {
    $sliders =  DB::table('sliders')
            ->orderBy('updated_at', 'desc')
            ->limit(3)
            ->get();
    $sections =  DB::table('sections')
            ->orderBy('updated_at', 'desc')
            ->limit(3)
            ->get();
             
        return view('welcome' , compact('user','sliders','sections'));
});


Route::get('/file/download/{name}','HomeController@downloadFile')->middleware('auth');

Route::post('/admin/registerClinic','ClinicController@register')->middleware(['auth','admin']);
Route::get('/dashboard/admin','HomeController@showAdmin')->middleware(['auth','admin']);
Route::get('/dashboard/admin/clinicRegistration','HomeController@AddClinicPage')->middleware(['auth','admin']);
Route::get('/dashboard/admin/allClinics','HomeController@allCinics')->middleware(['auth','admin']);
Route::get('/dashboard/admin/HomeConfig','HomeController@showHomeConfig')->middleware(['auth','admin']);
Route::get('/ajax/clinic/get/{id}','ClinicController@getClinic')->middleware(['auth','admin']);
Route::post('/clinic/update','ClinicController@updateClinic')->middleware('auth');
Route::get('/ajax/clinic/banorunban/{id}','ClinicController@banOrNotClinic')->middleware(['auth','admin']);


Route::get('/ajax/clinic/delete/{id}','ClinicController@deleteClinic')->middleware(['auth','admin']);
Route::post('/slider/add','HomeController@addSlider')->middleware(['auth','admin']);
Route::get('/slider/get/{id}','HomeController@getSlide')->middleware(['auth','admin']);
Route::get('/slider/show/{id}','HomeController@showSlide')->middleware(['auth','admin']);
Route::get('/slider/delete/{id}','HomeController@deleteSlide')->middleware(['auth','admin']);
Route::post('/slider/update','HomeController@updateSlide')->middleware(['auth','admin']);

Route::post('/section/add','HomeController@addSection')->middleware(['auth','admin']);
Route::get('/section/get/{id}','HomeController@getSection')->middleware(['auth','admin']);
Route::get('/section/show/{id}','HomeController@showSection')->middleware(['auth','admin']);
Route::post('/section/update','HomeController@updateSection')->middleware(['auth','admin']);
Route::get('/section/delete/{id}','HomeController@deleteSection')->middleware(['auth','admin']);


////////////////////////////////////
Route::get('/dashboard/manager','ManagerController@showManager')->middleware(['auth','manager','notBanned']);
Route::get('/dashboard/manager/doctors','ManagerController@showManagerDoctors')->middleware(['auth','manager','notBanned']);
Route::get('/dashboard/manager/secretaries','ManagerController@showAllSecretaries')->middleware(['auth','manager','notBanned']);
Route::get('/dashboard/manager/nurses','ManagerController@showAllNurses')->middleware(['auth','manager','notBanned']);
Route::get('/dashboard/manager/pacients','PacientController@showAllPacients')->middleware(['auth','manager','notBanned']);
Route::get('/dashboard/manager/inbox/{msg_id?}','MessageController@showInbox')->middleware(['auth','manager','notBanned']);
Route::get('/dashboard/manager/outbox','MessageController@showOutbox')->middleware(['auth','manager','notBanned']);
Route::get('/dashboard/manager/money','BillsController@showrMoneyAdmin')->middleware(['auth','manager','notBanned']);
Route::post('/dashboard/manager/changeProfilePic','ManagerController@changeProfilePic')->middleware(['auth','manager','notBanned']);
Route::get('/dashboard/manager/allBills','BillsController@showAllBills')->middleware(['auth','manager','notBanned']);
Route::get('/dashboard/manager/allExpenses','BillsController@showAllExpenses')->middleware(['auth','manager','notBanned']);

Route::post('/dashboard/manager/updateBill','BillsController@updateBill')->middleware(['auth','manager','notBanned']);
Route::post('/dashboard/manager/updateExpense','BillsController@updateExpense')->middleware(['auth','manager','notBanned']);

Route::post('/dashboard/manager/addDoctor','DoctorsController@create')->middleware(['auth','manager','notBanned']);
Route::post('/dashboard/manager/addSec','SecretariesController@create')->middleware(['auth','manager','notBanned']);
Route::post('/manager/edit','ManagerController@edit')->middleware(['auth','manager','notBanned']);
Route::get('/dashboard/manager/patientsRecords','PacientController@showAllRecords')->middleware(['auth','manager','notBanned']);
Route::get('/dashboard/manager/record/{user_name}','PacientController@showRecord')->middleware(['auth','manager','notBanned']);
Route::get('/dashboard/manager/search','DoctorsController@showSearch')->middleware(['auth','manager','notBanned']);
Route::get('/dashboard/manager/calendar','AppointmentController@showCalendarD')->middleware(['auth','manager','notBanned']);
Route::get('/dashboard/manager/myCalendar','AppointmentController@showCalendar')->middleware(['auth','manager','notBanned']);
Route::post('/ajax/clinic/update','ManagerController@updateClinic')->middleware('auth');
Route::get('/dashboard/manager/myClinic','ManagerController@showClinic')->middleware(['auth','manager','notBanned']);


//////////////////////////////////////////////////


Route::get('/dashboard/doctor','DoctorsController@showDoctor')->middleware(['auth','doctor','notBanned']);
Route::get('/dashboard/doctor/inbox/{msg_id?}','MessageController@showInbox')->middleware(['auth','doctor','notBanned']);
Route::get('/dashboard/doctor/outbox','MessageController@showOutbox')->middleware(['auth','doctor','notBanned']);
Route::get('/dashboard/doctor/money','DoctorsController@showDoctorMoney')->middleware(['auth','doctor','notBanned']);
Route::get('/dashboard/doctor/secretaries','SecretariesController@showAllSecretaries')->middleware(['auth','doctor','notBanned']);
Route::get('/dashboard/doctor/nurses','NursesController@showAllNurses')->middleware(['auth','doctor','notBanned']);
Route::get('/dashboard/doctor/pacients','PacientController@showAllPacients')->middleware(['auth','doctor','notBanned']);

Route::get('/ajax/edit/doctor/{username}','DoctorsController@edit')->middleware(['auth','doctor','notBanned']);
Route::post('/doctor/update/{username}','DoctorsController@update')->middleware(['auth','doctor','notBanned']);
Route::post('/doctor/changeProfilePic','DoctorsController@changePic')->middleware(['auth','doctor','notBanned']);
Route::get('/dashboard/doctor/patientsRecords','PacientController@showAllRecords')->middleware(['auth','doctor','notBanned']);
Route::get('/dashboard/doctor/record/{user_name}','PacientController@showRecord')->middleware(['auth','doctor','notBanned']);
Route::get('/dashboard/doctor/calendar','AppointmentController@showCalendar')->middleware(['auth','doctor','notBanned']);
Route::post('/dashboard/doctor/search','DoctorsController@search')->middleware(['auth','doctor','notBanned']);

/////////////////////////////////////////////////////

Route::post('/ajax/bill/create','BillsController@createBills')->middleware(['auth','stuff','notBanned']);
Route::post('/ajax/expense/create','BillsController@createExpenses')->middleware(['auth','stuff','notBanned']);
Route::get('/ajax/bill/show/{bill_id}','BillsController@getBill')->middleware(['auth','stuff','notBanned']);
Route::get('/ajax/expense/show/{expense_id}','BillsController@getExpense')->middleware(['auth','stuff','notBanned']);

Route::get('/ajax/appointment/delete/{id}' , 'AppointmentController@delete')->middleware('auth');


Route::get('/ajax/message/show/{msg_id}','MessageController@getMessage')->middleware('auth');
Route::post('/send/msg','MessageController@sendMessage')->middleware('auth');
Route::get('/message/delete/{deleter}/{msg_id}','MessageController@deleteMessage')->middleware('auth');
Route::get('/ajax/message/saw/{msg_id}','MessageController@sawMessage')->name('seen')->middleware('auth');

////////////////////////////////////////////////////////

Route::get('/dashboard/pacient','PacientController@showPacient')->middleware(['auth','patient']);
Route::get('/dashboard/pacient/calendar','AppointmentController@showCalendar')->middleware(['auth','patient']);
Route::post('/dashboard/pacient/changeProfilePic','PacientController@changePic')->middleware(['auth','patient']);
Route::post('/pacient/update/{username}','PacientController@update')->middleware(['auth','patient']);
Route::get('/dashboard/pacient/inbox/{msg_id?}','MessageController@showInbox')->middleware(['auth','patient']);
Route::get('/dashboard/pacient/outbox','MessageController@showOutbox')->middleware(['auth','patient']);
Route::get('/dashboard/pacient/my_record','PacientController@showMyRecord')->middleware(['auth','patient']);


////////////////////////////////////////////////////////

Route::get('/dashboard/secretary','SecretariesController@showSecretary')->middleware(['auth','secretary','notBanned']);
Route::get('/dashboard/secretary/inbox/{msg_id?}','MessageController@showInbox')->middleware(['auth','secretary','notBanned']);
Route::get('/dashboard/secretary/outbox','MessageController@showOutbox')->middleware(['auth','secretary','notBanned']);
Route::get('/dashboard/secretary/money','BillsController@showrMoneyAdmin')->middleware(['auth','secretary','notBanned']);
Route::get('/dashboard/secretary/allBills','BillsController@showAllBills')->middleware(['auth','secretary','notBanned']);
Route::get('/dashboard/secretary/allExpenses','BillsController@showAllExpenses')->middleware(['auth','secretary','notBanned']);
Route::get('/dashboard/secretary/secretaries','SecretariesController@showAllSecretaries')->middleware(['auth','secretary','notBanned']);
Route::get('/dashboard/secretary/nurses','NursesController@showAllNurses')->middleware(['auth','secretary','notBanned']);
Route::get('/dashboard/secretary/pacients','PacientController@showAllPacients')->middleware(['auth','secretary','notBanned']);

Route::post('/dashboard/secretary/updateBill','BillsController@updateBill')->middleware(['auth','secretary','notBanned']);
Route::post('/dashboard/secretary/updateExpense','BillsController@updateExpense')->middleware(['auth','secretary','notBanned']);
Route::get('/dashboard/secretary/calendar','AppointmentController@showCalendar')->middleware(['auth','secretary','notBanned']);
Route::get('/ajax/edit/secretary/{username}','SecretariesController@edit')->middleware(['auth','secretary','notBanned']);
Route::post('/secretary/update/{username}','SecretariesController@update')->middleware(['auth','secretary','notBanned']);

///////////////////////////////////////////////////////

Route::post('/event/add','EventsController@create')->middleware(['auth','stuff','notBanned']);
Route::get('/ajax/event/get/{id}','EventsController@get')->middleware(['auth','stuff','notBanned']);
Route::post('/event/update/{id}','EventsController@update')->middleware(['auth','stuff','notBanned']);
Route::get('/ajax/event/delete/{id}','EventsController@delete')->middleware(['auth','stuff','notBanned']);

////////////////////////////////////////////////////////

Route::post('/history/add','HistoryController@store')->middleware('auth');

Route::get('/ajax/appointment/get/{id?}','AppointmentController@getAppointments')->middleware('auth');
Route::get('/ajax/appointment/show/{id}','AppointmentController@showAppointments')->middleware('auth');
Route::post('/appointment/create','AppointmentController@createAppointment')->middleware('auth');
Route::post('/appointment/edit','AppointmentController@editAppointment')->middleware('auth');
Route::get('/ajax/appointment/changeDate/{date}/{id}','AppointmentController@changeAppointmentDate')->middleware('auth');
Route::get('/ajax/appointment/approve/{id}' , 'AppointmentController@approve')->middleware('auth');


Route::get('/{type}/delete/{user_name}',function($type,$user_name){
     DB::table('users')->where('user_name','=',$user_name)->delete();
     if($type == 'doctor')
     {
        DB::table('doctors')->where('user_name','=',$user_name)->delete();
        return redirect()->back();
     }
     else
     {
        DB::table('secretaries')->where('user_name','=',$user_name)->delete();
        return redirect()->back();
     }
})->middleware(['auth','stuff','notBanned']);


Route::get('/ajax/edit/nurse/{user_name}', ['uses' =>'NursesController@get'])->middleware(['auth','stuff','notBanned']);
Route::get('/ajax/delete/nurse/{user_name}', ['uses' =>'NursesController@delete'])->middleware(['auth','stuff','notBanned']);
Route::post('/nurse/update/{user_name}', ['uses' =>'NursesController@update'])->middleware(['auth','stuff','notBanned']);
Route::post('/nurses/create','NursesController@store')->middleware(['auth','stuff','notBanned']);

Route::get('/ajax/edit/pacient/{user_name}', ['uses' =>'PacientController@get'])->middleware('auth');
Route::get('/ajax/delete/pacient/{user_name}', ['uses' =>'PacientController@delete'])->middleware('auth');
Route::post('/pacient/update/{user_name}', ['uses' =>'PacientController@update'])->middleware('auth');
Route::post('/dashboard/pacient/book','PacientController@create')->middleware('auth');
Route::post('/pacient/create','PacientController@store')->middleware('auth');


