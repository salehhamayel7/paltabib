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

Route::get('/home', 'HomeController@index')->middleware('https');
Route::get('/', 'HomeController@mainPage')->middleware('https');
Route::get('/contact', 'HomeController@showContact')->middleware('https');
Route::get('/pricing', 'HomeController@showPricing')->middleware('https');



Route::get('/file/download/{name}','HomeController@downloadFile')->middleware(['https','https','auth']);

Route::post('/admin/registerClinic','ClinicController@register')->middleware(['https','auth','admin']);
Route::get('/dashboard/admin','HomeController@showAdmin')->middleware(['https','auth','admin']);
Route::get('/dashboard/admin/clinicRegistration','HomeController@AddClinicPage')->middleware(['https','auth','admin']);
Route::get('/dashboard/admin/allClinics','HomeController@allCinics')->middleware(['https','auth','admin']);
Route::get('/dashboard/admin/HomeConfig','HomeController@showHomeConfig')->middleware(['https','auth','admin']);
Route::get('/ajax/clinic/get/{id}','ClinicController@getClinic')->middleware(['https','auth','admin']);
Route::post('/clinic/update','ClinicController@updateClinic')->middleware(['https','auth']);
Route::get('/ajax/clinic/banorunban/{id}','ClinicController@banOrNotClinic')->middleware(['https','auth','admin']);
Route::get('/dashboard/admin/payments','HomeController@showPayments')->middleware(['https','auth','admin']);

Route::get('/ajax/clinic/delete/{id}','ClinicController@deleteClinic')->middleware(['https','auth','admin']);
Route::post('/slider/add','HomeController@addSlider')->middleware(['https','auth','admin']);
Route::get('/slider/get/{id}','HomeController@getSlide')->middleware(['https','auth','admin']);
Route::get('/slider/show/{id}','HomeController@showSlide')->middleware(['https','auth','admin']);
Route::get('/slider/delete/{id}','HomeController@deleteSlide')->middleware(['https','auth','admin']);
Route::post('/slider/update','HomeController@updateSlide')->middleware(['https','auth','admin']);

Route::post('/section/add','HomeController@addSection')->middleware(['https','auth','admin']);
Route::get('/section/get/{id}','HomeController@getSection')->middleware(['https','auth','admin']);
Route::get('/section/show/{id}','HomeController@showSection')->middleware(['https','auth','admin']);
Route::post('/section/update','HomeController@updateSection')->middleware(['https','auth','admin']);
Route::get('/section/delete/{id}','HomeController@deleteSection')->middleware(['https','auth','admin']);

Route::get('/paymen_method/get/{id}','HomeController@getMethod')->middleware(['https','auth','admin']);
Route::post('/payment_method/edit','HomeController@updateMethod')->middleware(['https','auth','admin']);

Route::get('/menu/get/{id}','HomeController@getMenu')->middleware(['https','auth','admin']);
Route::post('/menu/update','HomeController@updateMenu')->middleware(['https','auth','admin']);


////////////////////////////////////
Route::get('/dashboard/manager','ManagerController@showManager')->middleware(['https','auth','manager','notBanned']);
Route::get('/dashboard/manager/doctors','ManagerController@showManagerDoctors')->middleware(['https','auth','manager','notBanned']);
Route::get('/dashboard/manager/secretaries','ManagerController@showAllSecretaries')->middleware(['https','auth','manager','notBanned']);
Route::get('/dashboard/manager/nurses','ManagerController@showAllNurses')->middleware(['https','auth','manager','notBanned']);
Route::get('/dashboard/manager/pacients','PacientController@showAllPacients')->middleware(['https','auth','manager','notBanned']);
Route::get('/dashboard/manager/inbox/{msg_id?}','MessageController@showInbox')->middleware(['https','auth','manager','notBanned']);
Route::get('/dashboard/manager/outbox','MessageController@showOutbox')->middleware(['https','auth','manager','notBanned']);
Route::get('/dashboard/manager/money','BillsController@showrMoneyAdmin')->middleware(['https','auth','manager','notBanned']);
Route::post('/dashboard/manager/changeProfilePic','ManagerController@changeProfilePic')->middleware(['https','auth','manager','notBanned']);
Route::get('/dashboard/manager/allBills','BillsController@showAllBills')->middleware(['https','auth','manager','notBanned']);
Route::get('/dashboard/manager/allExpenses','BillsController@showAllExpenses')->middleware(['https','auth','manager','notBanned']);

Route::post('/dashboard/manager/updateBill','BillsController@updateBill')->middleware(['https','auth','manager','notBanned']);
Route::post('/dashboard/manager/updateExpense','BillsController@updateExpense')->middleware(['https','auth','manager','notBanned']);

Route::post('/dashboard/manager/addDoctor','DoctorsController@create')->middleware(['https','auth','manager','notBanned']);
Route::post('/dashboard/manager/addSec','SecretariesController@create')->middleware(['https','auth','manager','notBanned']);
Route::post('/manager/edit','ManagerController@edit')->middleware(['https','auth','manager','notBanned']);
Route::get('/dashboard/manager/patientsRecords','PacientController@showAllRecords')->middleware(['https','auth','manager','notBanned']);
Route::get('/dashboard/manager/record/{user_name}','PacientController@showRecord')->middleware(['https','auth','manager','notBanned']);
Route::get('/dashboard/manager/calendar','AppointmentController@showCalendarD')->middleware(['https','auth','manager','notBanned']);
Route::get('/dashboard/manager/myCalendar','AppointmentController@showCalendar')->middleware(['https','auth','manager','notBanned']);
Route::post('/ajax/clinic/update','ManagerController@updateClinic')->middleware(['https','auth']);
Route::get('/dashboard/manager/myClinic','ManagerController@showClinic')->middleware(['https','auth','manager','notBanned']);


//////////////////////////////////////////////////


Route::get('/dashboard/doctor','DoctorsController@showDoctor')->middleware(['https','auth','doctor','notBanned']);
Route::get('/dashboard/doctor/inbox/{msg_id?}','MessageController@showInbox')->middleware(['https','auth','doctor','notBanned']);
Route::get('/dashboard/doctor/outbox','MessageController@showOutbox')->middleware(['https','auth','doctor','notBanned']);
Route::get('/dashboard/doctor/money','BillsController@showrMoneyAdmin')->middleware(['https','auth','doctor','notBanned']);
Route::get('/dashboard/doctor/secretaries','SecretariesController@showAllSecretaries')->middleware(['https','auth','doctor','notBanned']);
Route::get('/dashboard/doctor/nurses','NursesController@showAllNurses')->middleware(['https','auth','doctor','notBanned']);
Route::get('/dashboard/doctor/pacients','PacientController@showAllPacients')->middleware(['https','auth','doctor','notBanned']);
Route::get('/dashboard/doctor/allBills','BillsController@showAllBills')->middleware(['https','auth','doctor','notBanned']);

Route::get('/ajax/edit/doctor/{username}','DoctorsController@edit')->middleware(['https','auth','stuff','notBanned']);
Route::post('/doctor/update/{username}','DoctorsController@update')->middleware(['https','auth','stuff','notBanned']);
Route::post('/doctor/changeProfilePic','DoctorsController@changePic')->middleware(['https','auth','doctor','notBanned']);
Route::get('/dashboard/doctor/patientsRecords','PacientController@showAllRecords')->middleware(['https','auth','doctor','notBanned']);
Route::get('/dashboard/doctor/record/{user_name}','PacientController@showRecord')->middleware(['https','auth','doctor','notBanned']);
Route::get('/dashboard/doctor/calendar','AppointmentController@showCalendar')->middleware(['https','auth','doctor','notBanned']);

/////////////////////////////////////////////////////

Route::post('/ajax/bill/create','BillsController@createBills')->middleware(['https','auth','stuff','notBanned']);
Route::post('/ajax/expense/create','BillsController@createExpenses')->middleware(['https','auth','stuff','notBanned']);
Route::get('/ajax/bill/show/{bill_id}','BillsController@getBill')->middleware(['https','auth','stuff','notBanned']);
Route::get('/ajax/expense/show/{expense_id}','BillsController@getExpense')->middleware(['https','auth','stuff','notBanned']);

Route::get('/ajax/appointment/delete/{id}' , 'AppointmentController@delete')->middleware(['https','auth']);


Route::get('/ajax/message/show/{msg_id}','MessageController@getMessage')->middleware(['https','auth']);
Route::post('/send/msg','MessageController@sendMessage')->middleware(['https','auth']);
Route::get('/message/delete/{deleter}/{msg_id}','MessageController@deleteMessage')->middleware(['https','auth']);
Route::get('/ajax/message/saw/{msg_id}','MessageController@sawMessage')->name('seen')->middleware(['https','auth']);

////////////////////////////////////////////////////////

Route::get('/dashboard/pacient','PacientController@showPacient')->middleware(['https','auth','patient']);
Route::get('/dashboard/pacient/calendar','AppointmentController@showCalendar')->middleware(['https','auth','patient']);
Route::post('/dashboard/pacient/changeProfilePic','PacientController@changePic')->middleware(['https','auth','patient']);
Route::get('/dashboard/pacient/inbox/{msg_id?}','MessageController@showInbox')->middleware(['https','auth','patient']);
Route::get('/dashboard/pacient/outbox','MessageController@showOutbox')->middleware(['https','auth','patient']);
Route::get('/dashboard/pacient/my_record','PacientController@showMyRecord')->middleware(['https','auth','patient']);
Route::get('/dashboard/pacient/myCalendar','AppointmentController@showPatientCalendar')->middleware(['https','auth','patient']);
Route::get('/ajax/patient/getAppointments','AppointmentController@getPatietsAppointmens')->middleware(['https','auth','patient']);
Route::post('/pactient/appointment/create','AppointmentController@createPatietsAppointmens')->middleware(['https','auth','patient']);


////////////////////////////////////////////////////////

Route::get('/dashboard/secretary','SecretariesController@showSecretary')->middleware(['https','auth','secretary','notBanned']);
Route::get('/dashboard/secretary/inbox/{msg_id?}','MessageController@showInbox')->middleware(['https','auth','secretary','notBanned']);
Route::get('/dashboard/secretary/outbox','MessageController@showOutbox')->middleware(['https','auth','secretary','notBanned']);
Route::get('/dashboard/secretary/money','BillsController@showrMoneyAdmin')->middleware(['https','auth','secretary','notBanned']);
Route::get('/dashboard/secretary/allBills','BillsController@showAllBills')->middleware(['https','auth','secretary','notBanned']);
Route::get('/dashboard/secretary/allExpenses','BillsController@showAllExpenses')->middleware(['https','auth','secretary','notBanned']);
Route::get('/dashboard/secretary/secretaries','SecretariesController@showAllSecretaries')->middleware(['https','auth','secretary','notBanned']);
Route::get('/dashboard/secretary/nurses','NursesController@showAllNurses')->middleware(['https','auth','secretary','notBanned']);
Route::get('/dashboard/secretary/pacients','PacientController@showAllPacients')->middleware(['https','auth','secretary','notBanned']);

Route::post('/dashboard/secretary/updateBill','BillsController@updateBill')->middleware(['https','auth','secretary','notBanned']);
Route::post('/dashboard/secretary/updateExpense','BillsController@updateExpense')->middleware(['https','auth','secretary','notBanned']);
Route::get('/dashboard/secretary/calendar','AppointmentController@showCalendar')->middleware(['https','auth','secretary','notBanned']);
Route::get('/ajax/edit/secretary/{username}','SecretariesController@edit')->middleware(['https','auth','stuff','notBanned']);
Route::post('/secretary/update/{username}','SecretariesController@update')->middleware(['https','auth','stuff','notBanned']);

///////////////////////////////////////////////////////

Route::post('/event/add','EventsController@create')->middleware(['https','auth','stuff','notBanned']);
Route::get('/ajax/event/get/{id}','EventsController@get')->middleware(['https','auth','stuff','notBanned']);
Route::post('/event/update/{id}','EventsController@update')->middleware(['https','auth','stuff','notBanned']);
Route::get('/ajax/event/delete/{id}','EventsController@delete')->middleware(['https','auth','stuff','notBanned']);

////////////////////////////////////////////////////////

Route::post('/history/add','HistoryController@store')->middleware(['https','auth']);

Route::get('/ajax/appointment/get/{id?}','AppointmentController@getAppointments')->middleware(['https','auth']);
Route::get('/ajax/appointment/show/{id}','AppointmentController@showAppointments')->middleware(['https','auth']);
Route::post('/appointment/create','AppointmentController@createAppointment')->middleware(['https','auth']);
Route::post('/appointment/edit','AppointmentController@editAppointment')->middleware(['https','auth']);
Route::get('/ajax/appointment/changeDate/{date}/{id}','AppointmentController@changeAppointmentDate')->middleware(['https','auth']);
Route::get('/ajax/appointment/approve/{id}' , 'AppointmentController@approve')->middleware(['https','auth']);


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
})->middleware(['https','auth','stuff','notBanned']);


Route::get('/ajax/edit/nurse/{user_name}', ['uses' =>'NursesController@get'])->middleware(['https','auth','stuff','notBanned']);
Route::get('/ajax/delete/nurse/{user_name}', ['uses' =>'NursesController@delete'])->middleware(['https','auth','stuff','notBanned']);
Route::post('/nurse/update/{user_name}', ['uses' =>'NursesController@update'])->middleware(['https','auth','stuff','notBanned']);
Route::post('/nurses/create','NursesController@store')->middleware(['https','auth','stuff','notBanned']);

Route::get('/ajax/edit/pacient/{user_name}', ['uses' =>'PacientController@get'])->middleware(['https','auth']);
Route::get('/ajax/delete/pacient/{user_name}', ['uses' =>'PacientController@delete'])->middleware(['https','auth']);
Route::post('/pacient/update/{user_name}', ['uses' =>'PacientController@update'])->middleware(['https','auth']);
Route::post('/dashboard/pacient/book','PacientController@create')->middleware(['https','auth']);
Route::post('/pacient/create','PacientController@store')->middleware(['https','auth']);


