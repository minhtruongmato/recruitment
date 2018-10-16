<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

/*=============================
=            Admin            =
=============================*/

Route::group(['prefix' => 'admin', 'namespace' => 'Admin',], function(){
	/*----------  User  ----------*/
	
	/* Login */
	Route::get('/dang-nhap', 'AuthController@showLogin')->name('admin.getLogin');
	Route::post('/dang-nhap', 'AuthController@postLogin')->name('admin.postLogin');

	/* Logout */
	Route::get('/dang-xuat', 'AuthController@logout')->name('admin.logout');

	/* Forgot Password */
	Route::get('/quen-mat-khau', 'AuthController@showForgotPassword')->name('admin.getForgot');
	Route::post('/quen-mat-khau', 'AuthController@postForgotPassword')->name('admin.postForgotPassword');

	/* Reset Password */
	Route::get('/password/reset/{token}', 'AuthController@showResetPassword')->name('admin.getPasswordReset');
	Route::post('/password/reset/{token}', 'AuthController@postResetPassword')->name('admin.postResetPassword');

	/*----------  End User  ----------*/

	Route::group(['middleware'=>'adminmiddleware'], function() {
	    /* Register */
		Route::get('/dang-ky', 'AuthController@showRegister')->name('admin.getRegister');
		Route::post('/dang-ky', 'AuthController@postRegister')->name('admin.postRegister');

		/* ChangePassword */
		Route::get('/doi-mat-khau', 'AuthController@showChangePassword')->name('admin.getChangePassword');
		Route::post('/doi-mat-khau', 'AuthController@postChangePassword')->name('admin.postChangePassword');

		/* Dashboard Controller */
		Route::get('/', 'DashboardController@index')->name('admin.dashboard');

		/* Candidate Controller */
		Route::resource('candidate', 'CandidateController');
		// Route::post('candidate/update/{id}', 'CandidateController@update')->name('candidate.update');

		/* Field Controller */
		Route::get('field/remove/{id}', 'FieldController@remove')->name('field.remove');
		Route::resource('field', 'FieldController');

		/* Career Controller */
		Route::get('career/remove/{id}', 'CareerController@remove')->name('career.remove');
		Route::resource('career', 'CareerController');

		/* Position Controller */
		Route::get('position/remove/{id}', 'PositionController@remove')->name('position.remove');
		Route::resource('position', 'PositionController');

		/* Location Controller */
		Route::get('location/remove/{id}', 'LocationController@remove')->name('location.remove');
		Route::resource('location', 'LocationController');

		/* Location Controller */
		Route::get('time/remove/{id}', 'TimeController@remove')->name('time.remove');
		Route::resource('time', 'TimeController');

		/* Language Controller */
		Route::get('language/remove/{id}', 'LanguageController@remove')->name('language.remove');
		Route::resource('language', 'LanguageController');

		/* Wage Controller */
		Route::get('wage/remove/{id}', 'WageController@remove')->name('wage.remove');
		Route::resource('wage', 'WageController');

		/* Wage Controller */
		Route::get('education/remove/{id}', 'EducationController@remove')->name('education.remove');
		Route::resource('education', 'EducationController');
	});
});

/*=====  End of Admin  ======*/




/*================================
=            Employer            =
================================*/
Route::group(['prefix' => 'nha-tuyen-dung', 'namespace' => 'Employer'], function(){
	/*----------  User  ----------*/

	/* Login */
	Route::get('dang-nhap', 'AuthController@showLogin')->name('employer.getLogin');
	Route::post('dang-nhap', 'AuthController@postLogin')->name('employer.postLogin');

	/* Logout */
	Route::post('dang-xuat', 'AuthController@logout')->name('employer.logout');

	/* Register */
	Route::get('dang-ky', 'AuthController@showRegister')->name('employer.getRegister');
	Route::post('dang-ky', 'AuthController@postRegister')->name('employer.postRegister');

	/* Forgot Password */
	Route::get('quen-mat-khau', 'AuthController@showForgotPassword')->name('employer.getForgot');
	Route::post('quen-mat-khau', 'AuthController@postForgotPassword')->name('employer.postForgotPassword');

	/* Reset Password */
	Route::get('/password/reset/{token}', 'AuthController@showResetPassword')->name('employer.getPasswordReset');
	Route::post('/password/reset/{token}', 'AuthController@postResetPassword')->name('employer.postResetPassword');

	/*----------  End User  ----------*/


	Route::group(['middleware' => 'employermiddleware'], function(){

		/* ChangePassword */
		Route::get('/doi-mat-khau', 'AuthController@showChangePassword')->name('employer.getChangePassword');
		Route::post('/doi-mat-khau', 'AuthController@postChangePassword')->name('employer.postChangePassword');

		/* Dashboard Controller */
		Route::get('/', 'DashboardController@index')->name('employer.dashboard');
		
	});
	
});

/*=====  End of Employer  ======*/


/**
 *
 * Verify
 *
 */

Route::get('/verify/{token}', 'VerifyController@verify')->name('verify');



