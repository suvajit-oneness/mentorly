<?php
use Illuminate\Http\Request;



//user password reset routes
// Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
// Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
// Route::post('password/reset','Auth\ResetPasswordController@reset');
// Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');

Auth::routes(['verify' => true,'login'=>false]);

require 'admin.php';

// New Routes
Route::get('/','Site\WebsiteController@index');
// Registration
Route::get('registration/mentee','Site\WebsiteController@signupFormMentee')->name('singup.mentee');
Route::get('registration/mentor','Site\WebsiteController@signupFormMentor')->name('singup.mentor');
Route::post('registration/mentor_mentee','Site\WebsiteController@signUpMentorAndMentee')->name('registration.mentee_mentor');
// Login
Route::get('/mentor/login','Site\WebsiteController@showLoginFormForMentor');
Route::get('/mentee/login','Site\WebsiteController@showLoginFormForMentee');
Route::post('/mentor/mentee/login','Site\WebsiteController@postLogin');
// Forget Password
Route::get('forget/password/{userType}','Site\WebsiteController@showForgetPassword')->name('both.forget.password');
Route::post('forget/password/{userType}','Site\WebsiteController@postForgetPassword')->name('both.forget.password.post');

// reset password link generate //
Route::get('resetPassword/{userid?}','Site\WebsiteController@userResetPassword')->name('resetPassword');
Route::post('updatepassword','Site\WebsiteController@userUpdatePassword')->name('updatepassword');



// mentors Route
Route::get('mentor/mentee/setting','Site\MentorController@setting')->name('mentor.mentee.setting');
Route::post('mentor/mentee/setting','Site\MentorController@settingAccountUpdate')->name('mentor.mentee.account_update');
Route::get('mentor/mentee/email/setting','Site\MentorController@settingEmail')->name('mentor.email.setting');
Route::post('mentor/mentee/email/setting','Site\MentorController@settingEmailUpdate')->name('mentor.email.update');
Route::get('mentor/mentee/password/setting','Site\MentorController@settingPassword')->name('mentor.password.setting');
Route::post('mentor/mentee/password/setting/{userType}','Site\MentorController@settingPasswordUpdate')->name('mentor.password.update');

Route::post('message/submit/to_mentor','Site\MentorController@messageSubmitToMentor')->name('message.submit.to.mentor');
Route::get('mentor/shift/availability','Site\MentorController@mentorAvailabilitySettingView')->name('mentor.availability.setting');
Route::post('mentor/shift/availability','Site\MentorController@saveMentorAvailabilitySetting')->name('mentor.availability.setting.save');

Route::get('mentor/mentee/message/log','Site\MentorController@messageLog')->name('user.message.log');
Route::get('booking/history','Site\MenteeController@purchasHistory')->name('booking.history');
Route::get('booking/mylessons','Site\MenteeController@myLesson')->name('booking.mylessons');



Route::get('mentor/booking/request','Site\MentorController@seeBookingDetails')->name('mentor.booking.request');
Route::get('mentor/booking/request/approve/{id?}','Site\MentorController@approveBookingrequest')->name('booking.request.approve');
Route::get('mentor/booking/request/reject/{id?}','Site\MentorController@rejectBookingrequest')->name('booking.request.reject');
Route::get('mentor/booking/request/reschedule/{id?}/{mentorId?}','Site\MentorController@rescheduleBookingrequest')->name('booking.request.reschedule');





Route::get('find/mentors','Site\WebsiteController@findMentors')->name('mentors.find');
Route::get('mentor/details/{mentorId}','Site\WebsiteController@mentorDetails')->name('mentor.details');
// Route::get('mentor/full/availability/{mentorId}','Site\MentorController@viewFullAvailability')->name('mentor.full.availability');
Route::post('mentor/booking/request','Site\MentorController@holdBookingRequest')->name('mentor.booking.slot');
Route::post('mentor/booking/requestreschdule','Site\MentorController@bookRescheduleClass')->name('mentor.booking.reschduleslot');
Route::get('about-us','Site\WebsiteController@aboutUs')->name('aboutus');
Route::get('contact-us','Site\WebsiteController@contactUs')->name('contactus');
Route::get('logout','Site\WebsiteController@logout');

Route::get('user/zoom/meeting','ZoomMeetingController@list')->name('user.zoom.meeting');
Route::get('user/zoom/meeting/{meetingId}/cancel','ZoomMeetingController@cancelMeeting')->name('user.zoom.meeting.cancel');

Route::group(['prefix' => 'mentor'],function(){
	Route::get('experience/log','Site\MentorController@yourExperience')->name('mentor.experience.log');
	Route::post('experience/log','Site\MentorController@yourExperienceSave')->name('mentor.experience.log.update');
});

Route::get('slot/booking/invoice','StripePaymentController@invoiceshow');
// STRIPE Payment Routes
Route::get('slot/booking/stripe', 'StripePaymentController@bookingSlotstripe')->name('slot.booking.stripe');
Route::post('slot/booking/stripe', 'StripePaymentController@bookingStripePost')->name('slot.booking.stripe.post');
Route::get('stripe/payment/success', 'Site\MentorController@stripeBookingConfirmed')->name('stripe.payment.success');
Route::get('payment/bokking/success','StripePaymentController@thankyouPageToSHow')->name('mentor.booked.success');

Route::get('terms-and-condition','Site\WebsiteController@termsAndCondition')->name('terms.condition');
Route::get('policy','Site\WebsiteController@policy')->name('policy');

//get chats by conversation id
Route::post('/get-messages-by-id', 'Site\MentorController@getMessagesById')->name('get.messages.by.id');

// Cron Routes
Route::get('create_teacher_slot','CronController@teacherSlot');


Route::get('testmail',function(){
$data = [
'name' => 'Rajeev',
'address' => 'New Colony Hanuman Tola Dharahara Arrah',
];
$to = 'rrpit9@gmail.com';
$template = 'email/forgot_password';
$subject = 'Just for Testing';
sendmail($data,$template,$to,$subject);
});