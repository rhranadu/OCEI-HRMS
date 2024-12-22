<?php

Route::group(['middleware' => ['preventbackbutton','auth']], function(){

    Route::group(['prefix' => 'manageHoliday'], function () {
        Route::get('/',['as' => 'holiday.index', 'uses'=>'Leave\HolidayController@index']);
        Route::get('/create',['as' => 'holiday.create', 'uses'=>'Leave\HolidayController@create']);
        Route::post('/store',['as' => 'holiday.store', 'uses'=>'Leave\HolidayController@store']);
        Route::get('/{manageHoliday}/edit',['as'=>'holiday.edit','uses'=>'Leave\HolidayController@edit']);
        Route::put('/{manageHoliday}',['as' => 'holiday.update', 'uses'=>'Leave\HolidayController@update']);
        Route::delete('/{manageHoliday}/delete',['as'=>'holiday.delete','uses'=>'Leave\HolidayController@destroy']);
    });

    Route::group(['prefix' => 'publicHoliday'], function () {
        Route::get('/',['as' => 'publicHoliday.index', 'uses'=>'Leave\PublicHolidayController@index']);
        Route::get('/create',['as' => 'publicHoliday.create', 'uses'=>'Leave\PublicHolidayController@create']);
        Route::post('/store',['as' => 'publicHoliday.store', 'uses'=>'Leave\PublicHolidayController@store']);
        Route::get('/{publicHoliday}/edit',['as'=>'publicHoliday.edit','uses'=>'Leave\PublicHolidayController@edit']);
        Route::put('/{publicHoliday}',['as' => 'publicHoliday.update', 'uses'=>'Leave\PublicHolidayController@update']);
        Route::delete('/{publicHoliday}/delete',['as'=>'publicHoliday.delete','uses'=>'Leave\PublicHolidayController@destroy']);

        Route::get('/holidayCalendar',['as' => 'publicHoliday.holidayCalendarCreate', 'uses'=>'Leave\PublicHolidayController@holidayCalendar']);
    });

    Route::group(['prefix' => 'holidayCalendar'], function () {
        Route::get('/',['as' => 'holidayCalendar.index', 'uses'=>'Leave\HolidayCalendarController@index']);
        Route::get('/create',['as' => 'holidayCalendar.create', 'uses'=>'Leave\HolidayCalendarController@create']);
        Route::post('/store',['as' => 'holidayCalendar.store', 'uses'=>'Leave\HolidayCalendarController@store']);
        Route::get('/{holidayCalendar}/edit',['as'=>'holidayCalendar.edit','uses'=>'Leave\HolidayCalendarController@edit']);
        Route::put('/{holidayCalendar}',['as' => 'holidayCalendar.update', 'uses'=>'Leave\HolidayCalendarController@update']);
        Route::delete('/{holidayCalendar}/delete',['as'=>'holidayCalendar.delete','uses'=>'Leave\HolidayCalendarController@destroy']);
    });

    Route::group(['prefix' => 'weeklyHoliday'], function () {
        Route::get('/',['as' => 'weeklyHoliday.index', 'uses'=>'Leave\WeeklyHolidayController@index']);
        Route::get('/create',['as' => 'weeklyHoliday.create', 'uses'=>'Leave\WeeklyHolidayController@create']);
        Route::post('/store',['as' => 'weeklyHoliday.store', 'uses'=>'Leave\WeeklyHolidayController@store']);
        Route::get('/{weeklyHoliday}/edit',['as'=>'weeklyHoliday.edit','uses'=>'Leave\WeeklyHolidayController@edit']);
        Route::put('/{weeklyHoliday}',['as' => 'weeklyHoliday.update', 'uses'=>'Leave\WeeklyHolidayController@update']);
        Route::delete('/{weeklyHoliday}/delete',['as'=>'weeklyHoliday.delete','uses'=>'Leave\WeeklyHolidayController@destroy']);
    });

    Route::group(['prefix' => 'leaveType'], function () {
        Route::get('/',['as' => 'leaveType.index', 'uses'=>'Leave\LeaveTypeController@index']);
        Route::get('/create',['as' => 'leaveType.create', 'uses'=>'Leave\LeaveTypeController@create']);
        Route::post('/store',['as' => 'leaveType.store', 'uses'=>'Leave\LeaveTypeController@store']);
        Route::get('/{leaveType}/edit',['as'=>'leaveType.edit','uses'=>'Leave\LeaveTypeController@edit']);
        Route::put('/{leaveType}',['as' => 'leaveType.update', 'uses'=>'Leave\LeaveTypeController@update']);
        Route::delete('/{leaveType}/delete',['as'=>'leaveType.delete','uses'=>'Leave\LeaveTypeController@destroy']);
    });

    Route::group(['prefix' => 'applyForLeave'], function () {
        Route::get('/',['as' => 'applyForLeave.index', 'uses'=>'Leave\ApplyForLeaveController@index']);
        Route::get('/create',['as' => 'applyForLeave.create', 'uses'=>'Leave\ApplyForLeaveController@create']);
        Route::post('/store',['as' => 'applyForLeave.store', 'uses'=>'Leave\ApplyForLeaveController@store']);
        Route::post('getEmployeeLeaveBalance','Leave\ApplyForLeaveController@getEmployeeLeaveBalance');
        Route::post('applyForTotalNumberOfDays','Leave\ApplyForLeaveController@applyForTotalNumberOfDays');
        Route::get('/{applyForLeave}',['as'=>'applyForLeave.show','uses'=>'Leave\ApplyForLeaveController@show']);
        Route::any('religion_wise_leave_list/{religion_name}','Leave\ApplyForLeaveController@religionWiseLeave');
        Route::delete('/{applyForLeave}/delete',['as'=>'applyForLeave.delete','uses'=>'Leave\ApplyForLeaveController@destroy']);
        
        Route::get('/getHolidayCalendar/{id}','Leave\ApplyForLeaveController@getHolidayCalendar');

    });

    Route::group(['prefix' => 'earnLeaveConfigure'], function () {
        Route::get('/',['as' => 'earnLeaveConfigure.index', 'uses'=>'Leave\EarnLeaveConfigureController@index']);
        Route::post('updateEarnLeaveConfigure','Leave\EarnLeaveConfigureController@updateEarnLeaveConfigure');
    });


    Route::group(['prefix' => 'requestedApplication'], function () {
        Route::get('/',['as' => 'requestedApplication.index', 'uses'=>'Leave\RequestedApplicationController@index']);
        Route::get('/{requestedApplication}/viewDetails',['as'=>'requestedApplication.viewDetails','uses'=>'Leave\RequestedApplicationController@viewDetails']);
        Route::put('/{requestedApplication}',['as' => 'requestedApplication.update', 'uses'=>'Leave\RequestedApplicationController@update']);
    });

    Route::get('leaveReport',['as' => 'leaveReport.leaveReport', 'uses'=>'Leave\ReportController@employeeLeaveReport']);
    Route::post('leaveReport',['as' => 'leaveReport.leaveReport', 'uses'=>'Leave\ReportController@employeeLeaveReport']);
    Route::get('downloadLeaveReport','Leave\ReportController@downloadLeaveReport');

    Route::get('summaryReport',['as' => 'summaryReport.summaryReport', 'uses'=>'Leave\ReportController@summaryReport']);
    Route::post('summaryReport',['as' => 'summaryReport.summaryReport', 'uses'=>'Leave\ReportController@summaryReport']);
    Route::get('downloadSummaryReport','Leave\ReportController@downloadSummaryReport');


    Route::get('myLeaveReport',['as' => 'myLeaveReport.myLeaveReport', 'uses'=>'Leave\ReportController@myLeaveReport']);
    Route::post('myLeaveReport',['as' => 'myLeaveReport.myLeaveReport', 'uses'=>'Leave\ReportController@myLeaveReport']);
    Route::get('downloadMyLeaveReport','Leave\ReportController@downloadMyLeaveReport');

    Route::post('approveOrRejectLeaveApplication','Leave\RequestedApplicationController@approveOrRejectLeaveApplication');

    // optional leave setup    
    Route::get('optionalLeaveSetup',['as' => 'optional.leave.setup.index', 'uses'=>'Leave\OptionalLeaveSetupController@index']);
    Route::get('optionalLeaveSetup/create',['as' => 'optional.leave.setup.create', 'uses'=>'Leave\OptionalLeaveSetupController@create']);
    Route::post('optionalLeaveSetup/store','Leave\OptionalLeaveSetupController@store');
    Route::get('optionalLeaveSetup/edit/{id}',['as' => 'optional.leave.setup.edit', 'uses'=>'Leave\OptionalLeaveSetupController@edit']);
    Route::any('optionalLeaveSetup/update/{optional_leave_id}','Leave\OptionalLeaveSetupController@update');
    Route::any('optionalLeaveSetup/delete/{optional_leave_id}','Leave\OptionalLeaveSetupController@destroy');
});

