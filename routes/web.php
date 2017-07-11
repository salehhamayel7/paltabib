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

//Auth::routes();
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard/manager','ManagerController@showManager');
Route::get('/dashboard/manager/doctors','ManagerController@showManagerDoctors');
Route::get('/dashboard/manager/secretaries','SecretariesController@showAllSecretaries');
Route::get('/dashboard/manager/nurses','NursesController@showAllNurses');
Route::get('/dashboard/manager/pacients','PacientController@showAllPacients');
Route::get('/dashboard/manager/inbox/{msg_id?}','MessageController@showInbox');
Route::get('/dashboard/manager/outbox','MessageController@showOutbox');
Route::get('/dashboard/manager/money','BillsController@showrMoneyAdmin');
Route::post('/dashboard/manager/changeProfilePic','ManagerController@changeProfilePic');
Route::get('/dashboard/manager/allBills','BillsController@showAllBills');
Route::get('/dashboard/manager/allExpenses','BillsController@showAllExpenses');

Route::post('/dashboard/manager/updateBill','BillsController@updateBill');
Route::post('/dashboard/manager/updateExpense','BillsController@updateExpense');

Route::post('/dashboard/manager/addDoctor','DoctorsController@create');
Route::post('/dashboard/manager/addSec','SecretariesController@create');
Route::post('/manager/edit','ManagerController@edit');
Route::get('/dashboard/manager/patientsRecords','PacientController@showAllRecords');
Route::get('/dashboard/manager/record/{user_name}','PacientController@showRecord');
Route::get('/dashboard/manager/search','DoctorsController@showSearch');
Route::get('/dashboard/manager/calendar','AppointmentController@showCalendarD');
Route::get('/dashboard/manager/myCalendar','AppointmentController@showCalendar');
//////////////////////////////////////////////////


Route::get('/dashboard/doctor','DoctorsController@showDoctor');
Route::get('/dashboard/doctor/inbox/{msg_id?}','MessageController@showInbox');
Route::get('/dashboard/doctor/outbox','MessageController@showOutbox');
Route::get('/dashboard/doctor/money','DoctorsController@showDoctorMoney');
Route::get('/dashboard/doctor/secretaries','SecretariesController@showAllSecretaries');
Route::get('/dashboard/doctor/nurses','NursesController@showAllNurses');
Route::get('/dashboard/doctor/pacients','PacientController@showAllPacients');

Route::get('/ajax/edit/doctor/{username}','DoctorsController@edit');
Route::post('/doctor/update/{username}','DoctorsController@update');
Route::post('/doctor/changeProfilePic','DoctorsController@changePic');
Route::get('/dashboard/doctor/patientsRecords','PacientController@showAllRecords');
Route::get('/dashboard/doctor/record/{user_name}','PacientController@showRecord');
Route::get('/dashboard/doctor/calendar','AppointmentController@showCalendar');

/////////////////////////////////////////////////////

Route::post('/ajax/bill/create','BillsController@createBills');
Route::post('/ajax/expense/create','BillsController@createExpenses');
Route::get('/ajax/bill/show/{bill_id}','BillsController@getBill');
Route::get('/ajax/expense/show/{expense_id}','BillsController@getExpense');

Route::get('/ajax/appointment/delete/{id}' , 'AppointmentController@delete');


Route::get('/ajax/message/show/{msg_id}','MessageController@getMessage');
Route::post('/send/msg','MessageController@sendMessage');
Route::get('/message/delete/{deleter}/{msg_id}','MessageController@deleteMessage');
Route::get('/ajax/message/saw/{msg_id}','MessageController@sawMessage')->name('seen');

////////////////////////////////////////////////////////

Route::get('/dashboard/pacient','PacientController@showPacient');
Route::get('/dashboard/pacient/calendar','AppointmentController@showCalendar');
Route::post('/dashboard/pacient/changeProfilePic','PacientController@changePic');
Route::post('/pacient/update/{username}','PacientController@update');
Route::get('/dashboard/pacient/inbox/{msg_id?}','MessageController@showInbox');
Route::get('/dashboard/pacient/outbox','MessageController@showOutbox');
Route::get('/dashboard/pacient/my_record','PacientController@showMyRecord');


////////////////////////////////////////////////////////

Route::get('/dashboard/secretary','SecretariesController@showSecretary');
Route::get('/dashboard/secretary/inbox/{msg_id?}','MessageController@showInbox');
Route::get('/dashboard/secretary/outbox','MessageController@showOutbox');
Route::get('/dashboard/secretary/money','BillsController@showrMoneyAdmin');
Route::get('/dashboard/secretary/allBills','BillsController@showAllBills');
Route::get('/dashboard/secretary/allExpenses','BillsController@showAllExpenses');
Route::get('/dashboard/secretary/secretaries','SecretariesController@showAllSecretaries');
Route::get('/dashboard/secretary/nurses','NursesController@showAllNurses');
Route::get('/dashboard/secretary/pacients','PacientController@showAllPacients');

Route::post('/dashboard/secretary/updateBill','BillsController@updateBill');
Route::post('/dashboard/secretary/updateExpense','BillsController@updateExpense');
Route::get('/dashboard/secretary/calendar','AppointmentController@showCalendar');

///////////////////////////////////////////////////////

Route::post('/event/add','EventsController@create');
Route::get('/ajax/event/get/{id}','EventsController@get');
Route::post('/event/update/{id}','EventsController@update');
Route::get('/ajax/event/delete/{id}','EventsController@delete');

////////////////////////////////////////////////////////

Route::post('/history/add','HistoryController@store');
Route::get('/ajax/appointment/get/{id?}','AppointmentController@getAppointments');
Route::get('/ajax/appointment/show/{id}','AppointmentController@showAppointments');
Route::post('/appointment/create','AppointmentController@createAppointment');
Route::post('/appointment/edit','AppointmentController@editAppointment');
Route::get('/ajax/appointment/changeDate/{date}/{id}','AppointmentController@changeAppointmentDate');


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
});

Route::get('/ajax/edit/secretary/{username}','SecretariesController@edit');
Route::post('/secretary/update/{username}','SecretariesController@update');



Route::get('/ajax/edit/nurse/{user_name}', ['uses' =>'NursesController@get']);
Route::get('/ajax/delete/nurse/{user_name}', ['uses' =>'NursesController@delete']);
Route::post('/nurse/update/{user_name}', ['uses' =>'NursesController@update']);

Route::get('/ajax/edit/pacient/{user_name}', ['uses' =>'PacientController@get']);
Route::get('/ajax/delete/pacient/{user_name}', ['uses' =>'PacientController@delete']);
Route::post('/pacient/update/{user_name}', ['uses' =>'PacientController@update']);




Route::post('/dashboard/doctor/search','DoctorsController@search');
Route::post('/dashboard/pacient/book','PacientController@create');
Route::post('/ajax/secretary/approve/appointment/','SecretariesController@approveAppointment');


Route::get('/home', 'HomeController@index');

Route::get('/ajax/appointment/approve/{id}' , 'AppointmentController@approve');


Route::resource('nurses', 'NursesController');
Route::resource('pacient', 'PacientController');
