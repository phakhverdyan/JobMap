<?php

use Illuminate\Http\Request;

Route::any('/login', 'Api\AuthController@login')->middleware('forbidden_if_logged_in');
Route::any('/register', 'Api\AuthController@register')->middleware('forbidden_if_logged_in');
Route::any('/reset_password', 'Api\AuthController@reset_password')->middleware('forbidden_if_logged_in');
Route::any('/check-email/{email}', function($email) {
    $user = \App\User::where('email', $email)->first();
    if($user) return response(['exist'=> true]);
    else return response(['exist'=> false]);
});

Route::any('/auth/{provider}','SocialController@redirect');
Route::any('/auth/{provider}/callback','SocialController@Callback');

Route::prefix('/widgets/{business_widget_id}/v1')->middleware('public.api')->group(function () {
    Route::get('/', 'Api\WidgetV1Controller@index');
});

Route::prefix('/map')->group(function () {
    Route::get('/', 'Api\MapController@index');
    Route::get('/locations', 'Api\MapController@locations');
});

Route::prefix('/businesses')->group(function () {
    Route::any('/create', 'Api\BusinessController@create');

    Route::prefix('/{business_id}')->group(function () {
        Route::any('/', 'Api\BusinessController@get');
        Route::any('/locations', 'Api\BusinessController@locations');
        Route::any('/applicants', 'Api\BusinessController@applicants');
        Route::any('/interview_requests', 'Api\BusinessController@interview_requests');
        Route::any('/jobs', 'Api\BusinessController@jobs');
        Route::any('/job_locations', 'Api\BusinessController@job_locations');
        Route::any('/apply','Api\BusinessController@apply');
        Route::any('/get_counts', 'Api\BusinessController@getCounts');
        Route::any('/brand/create', 'Api\BusinessController@createBrand');
        Route::any('/update', 'Api\BusinessController@updateBrand');
        Route::any('/delete', 'Api\BusinessController@deleteBusiness');
    });
});
Route::prefix('/brand')->group(function () {
    Route::prefix('/{business_id}')->group(function () {
        Route::put('/', 'Api\BusinessController@updateBrand');
        Route::delete('/', 'Api\BusinessController@deleteBusiness');
        Route::post('/', 'Api\BusinessController@createBrand');
    });
});


Route::prefix('/users')->group(function () {
    Route::any('/exists', 'Api\UserController@exists');

    Route::any('/update-on-email-send', 'Api\UserController@updateOnEmailSend');

    Route::prefix('/{user_id}')->group(function () {
        Route::any('/', 'Api\UserController@index');
        Route::any('/update', 'Api\UserController@update')->middleware('forbidden_if_not_logged_in');
        Route::any('/change_password', 'Api\UserController@change_password')->middleware('forbidden_if_not_logged_in');
        Route::any('/applications', 'Api\UserController@applications')->middleware('forbidden_if_not_logged_in');
        Route::any('/preference/update', 'Api\UserPreferenceController@update')->middleware('forbidden_if_not_logged_in');

        Route::prefix('/chats')->group(function () {
            Route::any('/', 'Api\UserChatController@list')->middleware('forbidden_if_not_logged_in');
            Route::any('/count_of_unread_messages', 'Api\UserChatController@countOfUnreadMessages');

            Route::prefix('/{chat_id}')->group(function () {
                Route::any('/', 'Api\UserChatController@get')->middleware('forbidden_if_not_logged_in');

                Route::any('/count_of_unread_messages', 'Api\UserChatController@countOfUnreadMessages')->middleware([
                    'forbidden_if_not_logged_in',
                ]);

                Route::prefix('/messages')->group(function () {
                    Route::any('/', 'Api\UserChatController@messages')->middleware('forbidden_if_not_logged_in');
                    Route::any('/create', 'Api\UserChatController@createMessage')->middleware('forbidden_if_not_logged_in');
                    Route::any('/{message_id}', 'Api\UserChatController@getMessage')->middleware('forbidden_if_not_logged_in');
                });

                Route::any('/interlocutors/{intelocutor_id}', 'Api\UserChatController@getInterlocutor')->middleware([
                    'forbidden_if_not_logged_in',
                ]);

                Route::any('/my_interlocutor/update', 'Api\UserChatController@updateMyInterlocutor')->middleware([
                    'forbidden_if_not_logged_in',
                ]);

                Route::any('/emit_typing', 'Api\UserChatController@emitTyping')->middleware('forbidden_if_not_logged_in');
            });
        });

        Route::prefix('/videos')->group(function () {
            Route::any('/', 'Api\UserVideoController@list')->middleware('forbidden_if_not_logged_in');
            Route::any('/create', 'Api\UserVideoController@create')->middleware('forbidden_if_not_logged_in');
            Route::any('/exists', 'Api\UserVideoController@exists')->middleware('forbidden_if_not_logged_in');

            Route::prefix('/{video_id}')->group(function () {
                Route::any('/update', 'Api\UserVideoController@update')->middleware('forbidden_if_not_logged_in');
                Route::get('/delete', 'Api\UserVideoController@delete')->middleware('forbidden_if_not_logged_in');
            });
        });
    });
});

Route::prefix('/locations')->group(function () {
    Route::any('/', 'Api\LocationController@list');

	Route::prefix('/{location_id}')->group(function () {
		Route::any('/', 'Api\LocationController@get');
		Route::any('/apply', 'Api\LocationController@apply');
        Route::any('/wave', 'Api\LocationController@wave')->middleware('forbidden_if_not_logged_in');
	});
});

Route::prefix('/business_jobs')->group(function () {
    Route::prefix('/{job_id}')->group(function () {
        Route::any('/', 'Api\Job2Controller@get');
        Route::any('/apply','Api\Job2Controller@apply');
    });
});

Route::prefix('/job_locations')->group(function () {
    Route::any('/', 'Api\JobLocationController@list');

    Route::prefix('/{job_location_id}')->group(function () {
        Route::any('/', 'Api\JobLocationController@get');
    });
});

Route::prefix('/applicants/{applicant_id}')->group(function () {
    Route::get('/', 'Api\CandidateController@get');
});

Route::prefix('/interview_requests')->group(function () {
    Route::any('/create', 'Api\InterviewRequestController@create')->middleware('forbidden_if_not_logged_in');

    Route::prefix('/{interview_request_id}')->group(function () {
        Route::get('/', 'Api\InterviewRequestController@get')->middleware('forbidden_if_not_logged_in');
        Route::any('/update', 'Api\InterviewRequestController@update')->middleware('forbidden_if_not_logged_in');
    });
});

// ---------------------------------------------------------------------- //

Route::prefix('/autocomplete')->group(function () {
    Route::any('/country', 'Api\AutocompleteController@country');
    Route::any('/cities', 'Api\AutocompleteController@cities');
	Route::any('/street', 'Api\AutocompleteController@street');
});

Route::prefix('/jobs')->group(function () {
    Route::any('/create', 'Api\JobController@create');
    Route::any('/delete', 'Api\JobController@delete');
    Route::any('/get-opened-closed-location', 'Api\JobController@getOpenedClosedLocation');
    Route::any('/event-opened-closed-location', 'Api\JobController@eventOpenedClosedLocation');
    Route::any('/get-business-data-table-jobs', 'Api\JobController@getDataTableJobs');

    Route::any('/update', 'Api\JobController@update');

    Route::prefix('/{id}')->group(function () {
        Route::any('/get', 'Api\JobController@get');

        Route::any('/set-locations', 'Api\JobController@setLocations');
    });
});

Route::prefix('/departments')->group(function () {
    Route::any('/create', 'Api\DepartmentController@create');
    Route::prefix('/{id}')->group(function () {
        Route::any('/get', 'Api\DepartmentController@get');
        Route::any('/update', 'Api\DepartmentController@update');
        Route::any('/set-locations', 'Api\DepartmentController@setLocations');
    });
});

Route::prefix('/managers')->group(function () {
    Route::any('/create', 'Api\ManagerController@create');
    Route::any('/resend-invite', 'Api\ManagerController@resendInvite');
    Route::prefix('/{id}')->group(function () {
        Route::any('/get', 'Api\ManagerController@get');
        Route::any('/update', 'Api\ManagerController@update');
        Route::any('/set-locations', 'Api\ManagerController@setLocations');
        Route::any('/remove','Api\ManagerController@remove');
    });
});

// ---------------------------------------------------------------------- //

Route::prefix('/datatable')->group(function () {
    Route::any('/get-all-business-list', 'Api\DatatableController@getAllBusinessList');
    Route::any('/get-business-data', 'Api\DatatableController@getBusinessData');
    Route::any('/get-location-data', 'Api\DatatableController@getLocationData');
    Route::any('/get-location-assign-data', 'Api\DatatableController@getLocationAssignData');
    Route::any('/get-location-by-business/{id_business}', 'Api\DatatableController@getLocationByBusiness');
    Route::any('/get-location-assign-by-business/{id_business}', 'Api\DatatableController@getLocationAssignByBusiness');
    Route::any('/get-selected-list', 'Api\DatatableController@getSelectedListQuery');
    Route::any('/get-id-list-locations-assign', 'Api\DatatableController@getIdListLocationsAssign');

});

Route::prefix('/qr-code')->group(function () {
    Route::any('/generate-code', 'Api\QRCodeController@GenerateCode');
    Route::any('/get-pdf-code', 'Api\QRCodeController@getPDFCode');
    Route::any('/get-qr-code-setting', 'Api\QRCodeController@getQrCodeSetting');
    Route::any('/update-qr-code-setting', 'Api\QRCodeController@updateQrCodeSetting');
    Route::any('/get-crop-image', 'Api\QRCodeController@getCropImage');
    Route::any('/get-selected-location-by-business', 'Api\QRCodeController@getSelectedLocationByBusiness');

});


Route::prefix('/candidate')->namespace('Api\Candidate')->group(function () {

    Route::prefix('/note')->group(function () {
        Route::any('/get', 'NoteController@get');
        Route::post('/create', 'NoteController@create');
        Route::any('/delete', 'NoteController@delete');
    });

    Route::prefix('/history')->group(function () {
        Route::any('/get', 'HistoryController@get');
        //Route::post('/create', 'HistoryController@create');
        //Route::any('/delete', 'HistoryController@delete');
    });

    Route::prefix('/brand')->group(function () {
        Route::any('/get', 'BrandController@get');
        //Route::post('/create', 'HistoryController@create');
        //Route::any('/delete', 'HistoryController@delete');
    });

    Route::prefix('/pipeline')->group(function () {
        Route::any('/get', 'PipelineController@get');
        //Route::post('/create', 'HistoryController@create');
        //Route::any('/delete', 'HistoryController@delete');
    });

});

Route::prefix('/candidate')->group(function () {



    Route::any('/get-pipeline', 'Api\CandidateController@getPipeline');

    Route::any('/send-candidate-data', 'Api\CandidateController@sendCandidateData');
    Route::any('/update-pipeline', 'Api\CandidateController@updatePipeline');
    Route::any('/get-count-only-waves', 'Api\CandidateController@getCountOnlyWaves');

    Route::any('/update-resume-request', 'Api\CandidateController@updateResumeRequest');
    Route::any('/get-resume-request', 'Api\CandidateController@getResumeRequest');
    Route::any('/get-candidate-overview', 'Api\CandidateController@getCandidateOverview');
    Route::any('/get-candidate-table-data', 'Api\CandidateController@getCandidateTableData');
    Route::any('/get-candidate-location-applied-to', 'Api\CandidateController@getLocationAppliedTo');
    Route::any('/get-candidate-job-applied-to', 'Api\CandidateController@getJobAppliedTo');
    Route::any('/get-candidate-brands-jobs', 'Api\CandidateController@getCandidateBrandsJobs');
    Route::post('/create-user-import', 'Api\CandidateController@createUserImport');
    Route::post('/update-user-import', 'Api\CandidateController@updateUserImport');
    Route::get('/get-data-user-import', 'Api\CandidateController@getDataUserImport');
    Route::get('/delete-candidate-wave', 'Api\CandidateController@deleteCandidateWave');
});

Route::prefix('/billing')->group(function () {
    Route::any('/get-prices', 'Api\BillingController@getPrices');
    Route::any('/get-current-paid', 'Api\BillingController@getCurrentPaid');
    Route::any('/create-cart', 'Api\BillingController@createCart');
    Route::any('/get-user-slots','Api\BillingController@getUserSlots');
    Route::any('/get-failed-invoices','Api\BillingController@getFailedInvoiceCount');
    Route::any('/get-current-user-paid','Api\BillingController@getCurrentUserPaidStatus');
    Route::any('/get-empty-slots-for-manager', 'Api\BillingController@getEmptySlotsForManager');
    Route::any('/refresh', 'ManagerController@billingPage');
    Route::any('/update-invoice', 'Api\BillingController@updateInvoice');

    Route::prefix('/{id}')->group(function () {
        Route::any('/deactivate','Api\BillingController@deactivate');
    });

    Route::any('/pay-invoice','Api\BillingController@payInvoice');

    Route::any('/activate','Api\BillingController@activate');

    Route::prefix('/datatable')->group(function () {
        Route::any('/get-cards-data', 'Api\BillingController@getCardsData');
        Route::any('/action-cart', 'Api\BillingController@actionCard');
        Route::any('/get-invoices-data', 'Api\BillingController@getInvoicesData');
        Route::any('/get-paid-location-data', 'Api\BillingController@getPaidLocationData');
        Route::any('/get-paid-user-data', 'Api\BillingController@getPaidUserData');
    });

    Route::prefix('/manager')->group(function () {
        Route::any('/create-subscription', 'Api\BillingController@createSubscription');
        Route::any('/delete-subscription', 'Api\BillingController@deleteSubscription');
    });

    Route::prefix('/location')->group(function () {
        Route::any('/create-subscription', 'Api\BillingController@createSubscriptionLocation');
        Route::any('/delete-subscription', 'Api\BillingController@deleteSubscriptionLocation');
    });

    Route::any('/cancel-subscription', 'Api\BillingController@cancelSubscription');
    Route::any('/modify-subscription', 'Api\BillingController@modifySubscription');

    Route::any('/checked-card', 'Api\BillingController@checkedCard');

    Route::any('/webhook', 'Api\BillingController@webhook');

});

# location information
# registration + apply to location
