<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|Here is where you can register web routes for your application. These
|routes are loaded by the RouteServiceProvider within a group which
|contains the "web" middleware group. Now create something great!
*/
Auth::routes();
Route::get('/','HomeController@getMainPage')->name('home');
Route::get('/timetable','HomeController@getTimeTable')->name('time');

//User Login & Reg routes
Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','Auth\LoginController@login')->name('loginPost');

Route::get('/logout','Auth\LoginController@userLogout')->name('logout');

Route::get('/signup','Auth\RegisterController@showRegistrationForm' )->name('signup');
Route::post('/signup','Auth\RegisterController@register')->name('register');

Route::get('/verify/{phone}','Auth\RegisterController@getOTP' )->name('otp');
Route::post('/verify/{phone}','Auth\RegisterController@verifyOTP');

Route::get('password/forget', 'Auth\ForgotPasswordController@forgotPassword')->name('forgotPassword');
Route::post('password/forget', 'Auth\ForgotPasswordController@postForgotPassword')->name('postForgotPassword');

Route::get('/reset_code/{phone}','Auth\ResetPasswordController@resetCode' )->name('reset');
Route::post('/reset_code/{phone}','Auth\ResetPasswordController@verifyCode')->name('verifyCode');

Route::get('/Reset_Password/{phone}','Auth\RegisterController@showNewForm')->name('newPassword');
Route::post('/Reset_Password/{phone}','Auth\RegisterController@newLogin');

//Route::get('/', 'HomeController@index')->name('home');
//Route::get('/search', 'HomeController@search')->name('search');
//Route::get('/about', 'HomeController@about')->name('about');
//Auth::routes();
//Route::get('/logout', 'Auth\LoginController@userLogout')->name('user.logout');
//
//Route::post('/get-content','HomeController@GetHomeContent')->name('GetHomeContent');
//Route::post('/get-ajxsearch','HomeController@GetSearch')->name('GetSearch');
//
//Route::prefix('category')->group(function(){
//   Route::get('/', 'CategoryController@showAllCategory')->name('show.categories');
//   Route::get('/create', 'CategoryController@createCategory')->name('create.category');
//   Route::post('/save', 'CategoryController@saveCategory')->name('save.category');
//   Route::get('/post/{id}', 'CategoryController@showCategoryPost')->name('show.catpost');
//});
Route::prefix('news')->group(function()
{
   Route::get('/', 'HomeController@showAllNews')->name('user.news');
   Route::get('/{slug}', 'HomeController@showSingleNews')->name('user.snews');
   Route::get('/share', 'HomeController@showUrl')->name('share.snews');
//   Route::post('/latest', 'HomeController@getLatest')->name('get.latestnews');
   
});
Route::prefix('notice')->group(function()
{
   Route::get('/', 'HomeController@showAllNotice')->name('user.notice');
 
//   Route::post('/latest', 'HomeController@getLatest')->name('get.latestnews');
   
});
//
Route::prefix('admin')->group(function()
{
   Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
   Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
   Route::get('/', 'AdminController@index')->name('admin.dashboard');
   Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
   Route::get('/admin-list', 'AdminController@UserList')->name('admin.user');
   Route::post('/get-admins','AdminController@getUsers')->name('userPro');
   Route::post('/save-admin','AdminController@saveAdmin')->name('save-admin');
   Route::post('/update-admin','AdminController@updateAdmin')->name('update.admin');
   Route::post('/checkadmin','AdminController@adminCheck')->name('check.admin');
   Route::post('/get-user-info', 'AdminController@getSingleUser')->name('admin.info');
   Route::post('/admin-sts','AdminController@statusAdmin')->name('status.admin');
   Route::post('/admin-delete','AdminController@deleteAdmin')->name('delete.admin');
   
   //*************Slider Setting****************
    Route::prefix('sliders')->group(function()
    {
        Route::get('/', 'SliderController@sliderList')->name('sliderlist');
        Route::post('/save','SliderController@saveSlider')->name('save.slider');
        Route::post('/get','SliderController@getSliders')->name('slidePro');
        Route::post('/update','SliderController@updateSlider')->name('update.slider');
        Route::post('/delete','SliderController@deleteSlider')->name('delete.slider');
        Route::post('/sts','SliderController@statusSlider')->name('status.slider');
    });
    Route::prefix('programs')->group(function()
    {
        Route::get('/','HomeController@programList')->name('programs');
        Route::post('/save','HomeController@saveProgram')->name('save.program');
        Route::post('/list','ProgramController@getProgram')->name('program.list');
        Route::post('/update','ProgramController@updateProgram')->name('update.program');
        Route::post('/delete','ProgramController@deleteProgram')->name('delete.program');
        Route::post('/sts','ProgramController@statusProgram')->name('status.program');
    });
    Route::prefix('coaches')->group(function()
    {
        Route::get('/','ProgramController@coachList')->name('coaches');
        Route::post('/save','ProgramController@saveCoach')->name('save.coach');
        Route::post('/list','ProgramController@getCoaches')->name('list.coach');
        Route::post('/update','ProgramController@updateCoach')->name('update.coach');
        Route::post('/delete','ProgramController@deleteCoach')->name('delete.coach');
        Route::post('/sts','ProgramController@statusCoach')->name('status.coach');
    });
    Route::prefix('abouts')->group(function()
    {
        Route::get('/','ProgramController@abouts')->name('abouts');
        Route::post('/save','ProgramController@saveAbouts')->name('save.abouts');
        Route::post('/list','ProgramController@getAbouts')->name('abouts.list');
        Route::post('/update','ProgramController@updateAbout')->name('update.about');
        Route::post('/delete','ProgramController@deleteAbout')->name('delete.about');
        // Route::post('/sts','ProgramController@statusProgram')->name('status.program');
    });
    Route::prefix('images')->group(function()
    {
        Route::get('/','ProgramController@singleImage')->name('images');
        Route::post('/save','ProgramController@saveImages')->name('save.single_image');
    });
    Route::prefix('testimonials')->group(function()
    {
       Route::get('/','ProgramController@testimonialList')->name('testimonials');
       Route::post('/save','ProgramController@saveTestimonial')->name('save.testimonial');
       Route::post('/list','ProgramController@getTestimonial')->name('testimonials.list');
       Route::post('/update','ProgramController@updateTestimonial')->name('update.testimonial');
       Route::post('/delete','ProgramController@deleteTestimonial')->name('delete.testimonial');
        // Route::post('/sts','ProgramController@statusProgram')->name('status.program');
    });
    
    Route::prefix('membership')->group(function()
    {
       Route::get('/','ProgramController@membershipList')->name('membership');
       Route::post('/save','ProgramController@saveMembership')->name('save.membership');
       Route::post('/list','ProgramController@getMembership')->name('membership.list');
       Route::post('/update','ProgramController@updateMembership')->name('update.membership');
       Route::post('/delete','ProgramController@deleteMembership')->name('delete.membership');
       Route::post('/status','ProgramController@statusMembership')->name('status.membership');
    });
    
    Route::prefix('notices')->group(function()
    {
       Route::get('/','ProgramController@noticeList')->name('notices');
       Route::post('/save','ProgramController@saveNotice')->name('save.notice');
       Route::post('/list','ProgramController@getNotice')->name('notice.list');
       Route::post('/update','ProgramController@updateNotice')->name('update.notice');
       Route::post('/delete','ProgramController@deleteNotice')->name('delete.notice');
        // Route::post('/sts','ProgramController@statusProgram')->name('status.program');
    });
    
    
   //=================================Slot Setting==============================
    Route::prefix('fullday')->group(function()
    {
        Route::get('/', 'SlotController@showFday')->name('get.fday');
        Route::post('/list','SlotController@getFday')->name('list.fday');
        Route::post('/save','SlotController@saveFday')->name('save.fday');
        Route::post('/update','SlotController@updateFday')->name('update.fday');
        Route::post('/sts', 'SlotController@StatusFday')->name('sts.fday');
        Route::post('/del','SlotController@delFday')->name('del.fday');
    });
    Route::prefix('dropin')->group(function()
    {
        Route::get('/', 'SlotController@showDropIn')->name('get.dropin');
        Route::post('/list','SlotController@getDropIn')->name('list.dropin');
        Route::post('/save','SlotController@saveDropIn')->name('save.dropin');
        Route::post('/update','SlotController@updateDropIn')->name('update.dropin');
        Route::post('/sts', 'SlotController@StatusDropIn')->name('sts.dropin');
        Route::post('/del','SlotController@delDropIn')->name('del.dropin');
        Route::get('/fetch','SlotController@fetchDropSlot')->name('fetchDropSlot');
        // Route::post('/sts','SlotController@StatusDropIn')->name('status.dropin');

    });
    Route::prefix('grounds')->group(function()
    {
        Route::get('/list', 'SlotController@groundList')->name('ground.setting');
        Route::post('/get','SlotController@getGround')->name('groundPro');
        Route::post('/save','SlotController@saveGround')->name('save.ground');
    });
    Route::prefix('weeks-pricing')->group(function()
    {
        Route::get('/', 'SlotController@getWeekTyp')->name('get.weektype');
        Route::post('/save','SlotController@saveType')->name('save.type');
        Route::post('/update','SlotController@updateType')->name('update.type');
        Route::post('/sts', 'SlotController@weekStatus')->name('week.sts');
    });
    Route::prefix('slots')->group(function()
    {
        Route::get('/slot-list', 'SlotController@slotList')->name('slot.setting');
        Route::post('/set-time', 'SlotController@setSlotPrice')->name('set.price');
        Route::post('/save-slot','SlotController@saveSlot')->name('save.slot');
        Route::post('/update-slot','SlotController@updateSlot')->name('update.slot');
        Route::post('/get-slot-list','SlotController@getSlotList')->name('slotPro');
        Route::post('/slot-status', 'SlotController@slotStatus')->name('slot.sts');
        Route::post('/check-start', 'SlotController@checkStart')->name('check.start');
        Route::post('/check-end', 'SlotController@checkEnd')->name('check.end');
        Route::post('/count','SlotController@countSlot')->name('count.slots');
        Route::post('/fetch-slot','SlotController@fetchSlot')->name('fetch.slots');
        Route::get('/fetch-date','SlotController@fetchDates')->name('findDates');
        Route::post('/pick-slot','SlotController@pickSlot')->name('pickSlot');
    });
   Route::prefix('offers')->group(function()
   {
        Route::get('/','OfferController@offerList')->name('list.offer');
        Route::post('/get','OfferController@getOffer')->name('get.offers');
        Route::post('/save','OfferController@saveOffer')->name('save.offer');
        Route::post('/update','OfferController@updateOffer')->name('update.offer');
        Route::post('/delete','OfferController@deleteOffer')->name('delete.offer');
        Route::post('/status','OfferController@stsOffer')->name('sts.offer');
        Route::post('/count','OfferController@countOffer')->name('count.offer');
        Route::post('/fetch','OfferController@fetchOffer')->name('fetch.offer');
        Route::post('/delofslt','OfferController@delOfslt')->name('del.ofslt');
   });
   Route::prefix('holidays')->group(function()
   {
        Route::get('/','HolidayController@holidayList')->name('list.holiday');
        Route::post('/get','HolidayController@getHoliday')->name('get.holidays');
        Route::post('/save','HolidayController@saveHoliday')->name('save.holiday');
        Route::post('/update','HolidayController@updateHoliday')->name('update.holiday');
        Route::post('/delete','HolidayController@deleteHoliday')->name('delete.holiday');
        Route::post('/status','HolidayController@stsHoliday')->name('sts.holiday');
        Route::post('/count','HolidayController@countHoliday')->name('count.holiday');
   });
   //*******Cart**********
//  Route::post('/cart-slot', 'SlotController@getAvailableSlot')->name('cart.slot');
    Route::post('/add-cart', 'SlotController@addCart')->name('add.cart');
    Route::post('/del-cart', 'SlotController@delCart')->name('del.cart');
    Route::post('/del-cartrow', 'SlotController@delCartRow')->name('del.cartrow');
   //*****Calender******
    Route::prefix('calender')->group(function()
    {
        Route::get('/', 'CalendarController@calender')->name('calender.setting');
        Route::post('/load-event','CalendarController@loadEvent')->name('load.event');
        Route::post('/cart-slot', 'CalendarController@getAvailableSlot')->name('cart.slot');
    });
   //****************USER**************
   Route::prefix('users')->group(function()
   {
        Route::get('/list','UserController@UserList')->name('user');
        Route::post('/get','UserController@getUsers')->name('get.users');
        Route::post('/save','UserController@saveUser')->name('save.users');
        Route::post('/update','UserController@updateUser')->name('update.user');
        Route::post('/delete','UserController@deleteUser')->name('delete.user');
        Route::post('/sts','UserController@statusUser')->name('status.user');
   });
   //****************Booking**************
   Route::prefix('booking')->group(function()
   {
        Route::get('/','BookingController@booking')->name('book');
        Route::get('/list','BookingController@bookingList')->name('show.bookings');
        Route::get('/slotlist','BookingController@bookedSlotList')->name('show.bookedslot');
        Route::post('/del-bookrow', 'BookingController@delBookRow')->name('del.bookrow');
        Route::post('/get-bookuser', 'BookingController@userDetails')->name('get.bookuser');
        Route::post('/count','BookingController@countBooking')->name('count.bookings');

   });
   Route::post('/get-bookinglist','BookingController@getbookList')->name('bookPro');
   Route::post('/get-bookingSlotlist','BookingController@getBookSlot')->name('bookSlotPro');
   Route::post('/get-bookslots','BookingController@getbookMdl')->name('get.bookslots');
   Route::post('/del-bookslots','BookingController@delbookMdl')->name('del.bookslots');
   Route::post('/save-book', 'BookingController@saveBook')->name('save.book');
   
   
   
   Route::prefix('reports')->group(function()
   {
        Route::get('/slot-list', ['as' => 'report.slotPrint', 'uses' => 'ReportController@slotPrint']);
        Route::get('/holiday-list', ['as' => 'report.holidayPrint', 'uses' => 'ReportController@holidayPrint']);
        Route::get('/booking-list', ['as' => 'report.bookingPrint', 'uses' => 'ReportController@bookingListPrint']);
        Route::get('/booked-slot-list', ['as' => 'report.bookslotPrint', 'uses' => 'ReportController@bookslotPrint']);
        
   });
    Route::prefix('acounts')->group(function()
    {
        Route::get('/sections','AccountController@showAsections')->name('show.aslist');
        Route::post('/alist','AccountController@listAsections')->name('list.aslist');
        Route::post('/acheck','AccountController@checkAccount')->name('check.account');
        Route::post('/asave','AccountController@saveAsection')->name('save.asec');
        Route::post('/aupdate','AccountController@updateAsection')->name('update.asec');
        Route::post('/asts','AccountController@statusAsection')->name('status.asec');
        Route::post('/adel','AccountController@deleteAsection')->name('delete.asec');
        
        Route::get('/groups','AccountController@showAgroups')->name('show.agrp');
        Route::post('/glist','AccountController@listAgroups')->name('list.agrp');
        Route::post('/gcheck','AccountController@checkAccount')->name('check.agrp');
        Route::post('/gsave','AccountController@saveAgroup')->name('save.agrp');
        Route::post('/gupdate','AccountController@updateAgroup')->name('update.agrp');
        Route::post('/gsts','AccountController@statusAgroup')->name('status.agrp');
        Route::post('/gdel','AccountController@deleteAgroup')->name('delete.agrp');
        
        Route::get('/','AccountController@showAccounts')->name('show.acc');
        Route::post('/list','AccountController@listAccounts')->name('list.acc');
        Route::post('/check','AccountController@checkAccount')->name('check.acc');
        Route::post('/save','AccountController@saveAccount')->name('save.acc');
        Route::post('/update','AccountController@updateAccount')->name('update.acc');
        Route::post('/sts','AccountController@statusAccount')->name('status.acc');
        Route::post('/del','AccountController@deleteAccount')->name('delete.acc'); 
        Route::get('/findgrp','AccountController@findGroup')->name('findgrp'); 
    });
    Route::prefix('news')->group(function()
    {
        Route::get('/category','PostController@showCategory')->name('show.ncat');
        Route::post('/clist','PostController@getCatList')->name('list.ncat');
        Route::post('/csave','PostController@saveCategory')->name('save.ncat');
        Route::post('/cupdate','PostController@updateCategory')->name('update.ncat');
        Route::post('/ncsts','PostController@statusCategory')->name('status.ncat');
        Route::post('/cdel','PostController@delCategory')->name('delete.ncat');
//        
        Route::get('/','PostController@showNews')->name('show.news');
        Route::post('/list','PostController@getNewsList')->name('list.news');
        Route::post('/save','PostController@saveNews')->name('save.news');
        Route::post('/update','PostController@updateNews')->name('update.news');
        Route::post('/sts','PostController@statusNews')->name('status.news');
        Route::post('/del','PostController@deleteNews')->name('delete.news');
    });

    Route::get('/test','CalendarController@showTest');
   

});


