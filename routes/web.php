<?php

use Illuminate\Support\Facades\Storage;

// ---------------------------------------------------------------------- //

/*
    - Testing routes
*/

// ---------------------------------------------------------------------- //

Route::get('sitemap.xml', 'SitemapController@sitemap')->name('sitemap');

Route::get('/test_run', ['uses' => 'UserController@test_run']);

Route::get('/test_add_locations', ['uses' => 'LocationController@addBusinessesLocations']);

Route::any('/test', function (Request $request) {
    $client = new Google_Client();
    $client->setAuthConfig(base_path('google_service_account_file.json'));
    $client->addScope('https://www.googleapis.com/auth/indexing');
    $httpClient = $client->authorize();
    $endpoint = 'https://indexing.googleapis.com/v3/urlNotifications:publish';

    $content = "{
      \"url\": \"http://devx.jobmap.co/jobs/42\",
      \"type\": \"URL_UPDATED\"
    }";

    $response = $httpClient->post($endpoint, ['body' => $content]);
    $status_code = $response->getStatusCode();
    return $response->getBody()->getContents();
});

Route::get('/phpinfo', function () {
	phpinfo();
});

// ---------------------------------------------------------------------- //

Route::get('/widget.{business_website_widget_id}.js', 'WidgetController@javascript')->middleware('language');
Route::get('/widget/{business_website_widget_id}/resume_uploader', 'WidgetController@resumeUploader')->middleware('language');
Route::get('/widget/{business_website_widget_id}/preview', 'WidgetController@preview')->middleware('language');

// ---------------------------------------------------------------------- //

Route::prefix('/manager')->group(function() {
    Route::get('/', 'ManagerController@index');
    Route::get('/logout', 'ManagerController@logout');
    Route::get('/logout_page', 'ManagerController@logoutPage');
    Route::get('/switch_business/{business_id}', 'ManagerController@switchBusiness');
});

// ---------------------------------------------------------------------- //

Route::middleware(['language'])->group(function () {
    Route::post('/landing/signup', [
        'uses' => 'UserController@landingForm',
    ])->name('landing.signup')->middleware('jwt.auth.redirect.auth');

    //Route::any('/user/signup', ['uses' => 'UserController@signup'])->name('user.signup')->middleware('jwt.auth.redirect.auth');

    /*Route::post('/user/signup', [
        'uses' => 'UserController@signup',
    ])->name('user.signup')->middleware('jwt.auth.redirect.auth');*/

    Route::get('/user/signup_c', function() {
        header("Set-Cookie: plan-price=" . $_GET['c'] . "; Domain=" . env('SESSION_DOMAIN') . "; EXPIRES 129600;path=/");
        header("Location: /user/signup");
        exit;
    })->name('user.resume.create');

    Route::get('/user/signup', ['uses' => 'UserController@signup'])->name('user.signup');//->middleware('jwt.auth.redirect.auth');
    Route::get('/user/change_password', ['uses' => 'UserController@changePassword'])->name('user.change_password')->middleware('jwt.auth.redirect.auth');
    Route::get('/user/reference', ['uses' => 'UserController@sendReference'])->name('user.send_reference');//->middleware('jwt.auth.redirect.auth');
    Route::get('/user/verification', ['uses' => 'UserController@verificationCode'])->name('user.verification');//->middleware('jwt.auth.redirect.auth');
    Route::get('/get/session_value', ['uses' => 'UserController@getSessionValue'])->name('get.session_value');

    Route::get('/user/confirm-new-email', [
        'uses' => 'UserController@confirmNewEmail',
    ])->name('user.confirm_new_email')->middleware('jwt.auth.redirect');

    Route::get('/user/confirm-new-password', [
        'uses' => 'UserController@confirmNewPassword',
    ])->name('user.confirm_new_password')->middleware('jwt.auth.redirect');

    Route::get('/u/{username}', ['uses' => 'UserController@publicProfile'])->name('user.public_profile');
    Route::get('/user/print-preview', ['uses' => 'UserController@pdfPrintPreview'])->name('user.print_preview')->middleware('jwt.auth.redirect');
    Route::get('/u-pdf/{username}', ['uses' => 'UserController@downloadPdfPrintPreview'])->name('user.link_print_preview');

    Route::get('/invite/business/{id}', ['uses' => 'BusinessController@inviteBusiness'])->name('business.invite');
    Route::get('/reference_user/{id}', ['uses' => 'UserController@referenceUser'])->name('user.reference_s');

    Route::get('/user/not_work', function () {
        return view('user.not_work');
    })->name('user.not_work');

    Route::get('/manager_blocked', function() {
        return view('business.manage.manager_blocked');
    });

    Route::middleware(['jwt.auth.redirect'])->group(function () {

        
        Route::get('/user/resume/create', function () {
            return view('user.resume.create');
        })->middleware('check.managers.edit.self')->name('user.resume.create');

        Route::get('/user/settings', function () {
            return view('user.settings');
        });

        Route::get('/user/interviews', function () {
            return view('user.interviews');
        });

        Route::get('/user/dashboard', function () {
            return view('user.dashboard');
        })->name('user.dashboard');

        Route::middleware(['check.user.resume'])->group(function () {
            Route::get('/user/resume/manage', function () {
                return view('user.resume.manage');
            });

            Route::get('/user/resume/view', function () {
                return view('user.resume.view');
            });

            Route::get('/user/resume/sent', function () {
                return view('user.resume.sent');
            });

            Route::get('/user/resume/print-select', function () {
                return view('user.resume.print_select');
            });

            Route::get('/user/resume/print-preview', function () {
                return view('user.resume.print_preview');
            });

            Route::get('/user/resume/congratulations', function () {
                return view('user.resume.congratulations');
            });

            Route::get('/user/references', function () {
                return view('user.references');
            });

            Route::get('/user/messages', function () {
                return view('user.messages');
            });

            Route::get('/user/profile', function () {
                return view('user.profile');
            });
            Route::get('/user/print-builder', function () {
                return view('user.print_builder');
            });
            Route::get('/user/step-by-step-guide', function () {
                return view('user.sbs_guide');
            });
        });

        Route::get('/lets-get-started-jobseeker', function () {
            return view('user.lets_get_started_jobseeker');
            //return view('common.biss_lets_get_started_jobseeker');
        });

        // Route::namespace('Business')->middleware(['check.permit.brands'])->group(function () {
        Route::namespace('Business')->group(function () {
            Route::get('/business/signup', ['uses' => 'SignupController@create'])->name('business.signup');
        });

        Route::middleware(['jwt.auth.business'])->group(function () {

            Route::get('/lets-get-started-business', function () {
                return view('business.lets_get_started_business');
                //return view('common.biss_lets_get_started0');
            });

            Route::get('/lets-get-started-business-resume', function () {
                return view('business.lets_get_started_business_resume');
                //return view('common.biss_lets_get_started');
            });

            Route::get('/lets-get-started-business-receive', function () {
                return view('business.lets_get_started_business_receive');
                //return view('common.biss_lets_get_started');
            });

            Route::get('/business/information', function () {
                return view('business.information');
            });

            Route::get('/business/interviews', function () {
                return view('business.interviews');
            });

            Route::get('/business/cta', function () {
                return view('business.cta');
            });

            Route::get('/business/job-boards', function () {
                return view('business.job_boards');
            });

            Route::get('/business/integration_overview', function () {
                return view('business.auth.integration_overview');
            });

            Route::middleware(['check.permit.connect_jobmap'])->group(function () {

                Route::get('/business/candidate/manage-ats', function () {
                    return view('business.auth.candidate_manage-ats');
                });

                Route::get('/business/widget/manager', function () {
                    return view('business.auth.widget_manager');
                })->middleware('check.permit.current_paid');

                Route::get('/business/email-forwarder', function () {
                    return view('business.email_forwarder');
                });

                Route::get('/business/button/manager', function () {
                    return view('business.auth.button_manager');
                });

                Route::get('/business/CR-link', function () {
                    return view('business.CR_link');
                });
            });

            Route::get('/business/CR-email', function () {
                return view('business.CR_email');
            });

            Route::get('/business/button/all', function () {
                return view('business.auth.button_all');
            });

            Route::get('/business/pricing', function () {
                return view('business.pricing');
            });

            Route::get('/business/pricing/features', function () {
                return view('business.pricing_features');
            });

            Route::get('/business/registration', function () {
                return view('business.registration');
            });

            Route::get('/business/contact-information', function () {
                return view('business.contact_information');
            });

            Route::get('/business/dashboard', function () {
                return view('business.auth.dashboard');
            })->name('business.dashboard');

            Route::get('/business/dashboard-simple', function () {
                return view('business.auth.dashboard_simple');
            });

            Route::get('/business/dashboard/incomplete', function () {
                return view('business.auth.dashboard_incomplete');
            });

            Route::get('/business/dashboard/no-business', function () {
                return view('business.auth.no_business');
            });

            Route::get('/business/dashboard/no-button', function () {
                return view('business.auth.no_button');
            });

            Route::get('/business/candidate/list', function () {
                return view('business.auth.candidate_list');
            });

            Route::get('/business/candidate/edit', function () {
                return view('business.auth.candidate_edit');
            });

            Route::get('/business/candidate/profile', function () {
                return view('business.auth.candidate_profile');
            });

            Route::get('/business/candidate/manage', function () {
                //return view('business.auth.candidate_manage');
                return view('business.auth.candidate_manage_new');
            })->middleware('check.permit.current_paid')->name('business.applicants');


            Route::get('/business/candidate/list/profie/view', function () {
                return view('business.auth.candidate_list_profie_view');
            });

            Route::get('/business/candidate/from/url', function () {
                return view('business.auth.candidate_from_url');
            });

            Route::get('/business/employee/manage', function () {
                return view('business.auth.employee_manage_new');
            });

            Route::get('/business/brands', function () {
                return view('business.auth.brands');
            });

            Route::get('/business/branch/locations', function () {
                return view('business.auth.branch_locations');
            });

            Route::middleware(['check.permit.locations'])->group(function () {

                Route::get('/business/branch/add', function () {
                    return view('business.auth.branch_locations_add');
                });

                Route::get('/business/branch/clone', function () {
                    return view('business.auth.branch_locations_add');
                });

                Route::get('/business/branch/edit', function () {

                    return view('business.auth.branch_locations_edit');
                });
            });

            /*
             *-no work
            Route::get('/business/branch/location/profile', function () {
                return view('business.auth.branch_locations_profile');
            });
            */

            Route::get('/business/job/position', function () {
                return view('business.auth.job_position');
            });

            Route::middleware(['check.permit.jobs'])->group(function () {

                Route::get('/business/job/add', function () {
                    return view('business.auth.job_add', [
                        'job_types' => \App\JobType::orderBy('id', 'asc')->get(),
                    ]);
                });

                Route::get('/business/job/edit', function () {
                    return view('business.auth.job_edit', [
                        'job_types' => \App\JobType::orderBy('id', 'asc')->get(),
                    ]);
                });

                Route::get('/business/job/clone', function () {
                    return view('business.auth.job_add', [
                        'job_types' => \App\JobType::orderBy('id', 'asc')->get(),
                    ]);
                });
            });

            Route::get('/business/job/manage', function () {
                return view('business.auth.job_manage');
            });

            Route::get('/business/account/users', function () {
                return view('business.auth.account_users');
            });

            Route::get('/business/messages', function () {
                return view('business.auth.messages');
            });

            Route::get('/business/profile', function () {
                return view('business.auth.profile');
            });

            Route::namespace('Business')->middleware(['check.permit.brands', 'check.permit.career_page'])->group(function () {
                Route::get('/business/profile/edit', function() {
                    //
                    return view('business.auth.profile_edit');
                });
            });

            Route::get('/business/settings', function () {
                //return view('user.settings');
                return view('business.auth.settings');
            });

            Route::get('/business/integrations', function () {
                return view('business.integrations');
            });

            Route::middleware(['check.business.admin'])->group(function () {

                Route::get('/business/billing', function () {
                    //return view('business.auth.billing');
                    return view('business.auth.new_billing');
                });

                // Route::get('/business/billing/modify', function () {
                //     return view('business.auth.billing_modify');
                // });

            });

            Route::get('/business/billing/pdf-ca', function () {
                return view('business.auth.billing_pdf-ca');
            });
            Route::get('/business/billing/invoice/{id}', 'InvoiceController@viewInvoice');
            Route::get('/business/billing/invoice/{id}/pdf', 'InvoiceController@pdfInvoice');

            Route::get('/billing/get-invoices-pdf/{id}/{action}', 'Api\BillingController@getInvoicesPdf');

            // Route::get('/business/importATS/', 'AtsTempController@atsTemp');

            Route::get('/business/billing/pdf-not-ca', function () {
                return view('business.auth.billing_pdf-not-ca');
            });

            Route::middleware(['check.permit.managers_franchisees'])->group(function () {

                // Route::get('/business/manage/manager', function () {
                //     return view('business.manage.manager');
                // });
                Route::get('/business/manage/manager', 'ManagerController@billingPage');
            });

            Route::middleware(['check.permit.managers'])->group(function () {

                Route::middleware(['check.manager.slot.available'])->get('/business/manage/manager/add', function () {
                    return view('business.manage.manager_add');
                });

                Route::get('/business/manage/manager/edit', function () {
                    return view('business.manage.manager_edit');
                });

                //--???????????
                Route::get('/business/manage/job', function () {
                    return view('business.manage.manager_add');
                });

                Route::get('/business/manage/job/add', function () {
                    return view('business.manage.manager_add');
                });
            });

            Route::middleware(['check.permit.franchisees'])->group(function () {

                Route::get('/business/manage/franchisee/add', function () {
                    return view('business.manage.franchisee_add');
                });

                Route::get('/business/manage/franchisee/edit', function () {
                    return view('business.manage.franchisee_edit');
                });
            });

            Route::middleware(['check.permit.departments'])->group(function () {

                Route::get('/business/manage/department/list', function () {
                    return view('business.auth.manage-department');
                });

                Route::get('/business/manage/department/add', function () {
                    return view('business.auth.add-department');
                });

                Route::get('/business/manage/department/edit', function () {
                    return view('business.auth.edit-department');
                });
            });

            Route::get('/business/manage/edit-candidate-pipeline', function () {
                return view('business.manage.edit_candidate_pipeline');
            });

            Route::get('/business/integrated-tools', function () {
                return view('business.integrated_tools');
            });

            Route::get('/scan/business/new/{id}', function () {
                return view('business.scan.business_new');
            });

            Route::get('/business/scanner', function () {
                return view('business.auth.scanner');
            });
        });
    });

    // NEW BUSINESS AND JOB SEEKER LANDINGS

    Route::get('/business-landing', function () {
        return view('business.landing_new');
    })->middleware('jwt.auth.redirect.auth');

    // ////////////////////////////////////

    Route::get('/site_map', function () {
        return redirect('/sitemap', 301);
        return view('common.site_map');
    });

    Route::get('/get-a-demo', function () {
        return view('common.get_a_demo');
    });

    Route::get('/employer_got_it', function () {
        return view('common.employer_got_it');
    });

    Route::middleware(['check.user.resume'])->group(function () {
        Route::get('/user/test', function(Request $request) {
            $user = \App\User::where('id', 3)->first();
            return ['completed' => $user->isResumeCompleted()];
        });

        Route::get('/user/resume/manage', function () {
            return view('user.resume.manage');
        });
    });

    Route::get('/employer_got_it_step2', function () {
        return view('common.employer_got_it_step2');
    });

    Route::get('/employer_got_it_step3', function () {
        return view('common.employer_got_it_step3');
    });

    Route::get('/employer_got_it_step4', function () {
        return view('common.employer_got_it_step4');
    });

    Route::get('/about', function () {
        return view('common.about');
    });

    Route::get('/career-with-us', function () {
        return view('common.career_with_us');
    });

    Route::get('/contact', function () {
        return view('common.contact');
    });

    Route::get('/privacy-policy', function () {
        return view('common.privacy_policy');
    });

    Route::get('/pricing', function () {
        return view('common.billing');
    });

    Route::get('/terms-of-service', function () {
        return view('common.terms_of_service');
    });

    Route::get('/faq', function () {
        return view('common.faq');
    });

    Route::get('/how-it-works', function () {
        return view('common.how_it_works');
    });

    Route::get('/how-it-works-together', function () {
        return view('common.how_it_works_together');
    });

    Route::get('/landing-employer', function () {
        return view('common.landing_employer');
    });

    Route::get('/lets-get-started2', function () {
        return view('common.biss_lets_get_started2-1');
    });

    Route::get('/links', function () {
        return view('common.links');
    });

    Route::get('/uikit', function () {
        return view('common.uikit');
    });

    Route::get('/signup', function () {
        return view('common.signup');
    });

    Route::get('/previous/email', function () {
        return view('user.previous_email');
    });

    Route::get('/previous/facebook', function () {
        return view('user.previous_facebook');
    });

    Route::get('/previous/google', function () {
        return view('user.previous_google');
    });

    Route::get('/scan/business', function () {
        return view('business.scan.business_logged_out');
    });

    Route::get('/scan/business/logged_in', function () {
        return view('business.scan.business_logged_in');
    });

    Route::get('/scan/business/exist', function () {
        return view('business.scan.business_exist');
    });

    Route::get('/candidate/profile/url', function () {
        return view('common.profile_url');
    });

    Route::get('/candidate/profile/url/edit', function () {
        return view('common.profile_url_edit');
    });

    Route::get('/job', function () {
        return view('common.job.job');
    });

    Route::get('/business-old-landing', function () {
        return view('business.landing');
    });

    // user area

    /*Route::get('/fr', function () {
        //return view('business.landing_new');
        //$response = response()->view('user.landing');
        App::setLocale('fr');
        $response = response()->view('business.landing_new');
        $business_id = strval(\Request::input('b', '0'));

        if ($business = \App\Business::where('id', $business_id)->first()) {
            $response->withCookie(cookie('inviting_business_id', $business->id, 365 * 86400));
        }

        return $response;
    })->middleware('jwt.auth.redirect.auth');*/

    Route::get('/landing', function () {
        return view('common.jobmap.landing_new');
    });//->middleware('go_no_login');

    // Route::get('/', function () {

        // return redirect(url('/landing'));
        //return view('user.landing_new');

        //return view('business.landing_new');
        //$response = response()->view('user.landing');
        //App::setLocale('en');
//        $response = response()->view('business.landing_new');
//        $business_id = strval(\Request::input('b', '0'));
//
//        if ($business = \App\Business::where('id', $business_id)->first()) {
//            $response->withCookie(cookie('inviting_business_id', $business->id, 365 * 86400));
//        }
//
//        return $response;
    // })->middleware('jwt.auth.redirect.auth');

    Route::get('/employers', function () {
        //return view('business.landing_new');
        //$response = response()->view('user.landing');
        //App::setLocale('en');
        $response = response()->view('business.landing_new');
        $business_id = strval(\Request::input('b', '0'));

        if ($business = \App\Business::where('id', $business_id)->first()) {
            $response->withCookie(cookie('inviting_business_id', $business->id, 365 * 86400));
        }

        return $response;
    })->middleware('jwt.auth.redirect.auth');



    Route::post('/landing/teacher/signup', ['uses' => 'UserController@landingFormAcademy'])->name('academy.teacher.signup');//->middleware('jwt.auth.redirect.auth');
    Route::get('/teacher', function () {
        return view('user.landing_academy', ['type' => 'teacher']);
    })->name('landing.teacher');//->middleware('jwt.auth.redirect.auth');
    Route::any('/teacher/signup', ['uses' => 'UserController@signupAcademy'])->name('landing.teacher.signup');//->middleware('jwt.auth.redirect.auth');
    /*Route::any('/teacher/signup', function () {
        return view('common.academy.teacher');
    })->name('landing.teacher.signup')->middleware('jwt.auth.redirect.auth');*/
    Route::get('/teacher/{token}', function () {
        return view('common.academy.teacher_inside');
    })->name('landing.teacher-inside');//->middleware('jwt.auth.redirect.auth');

    Route::post('/landing/director/signup', ['uses' => 'UserController@landingFormAcademy'])->name('academy.director.signup');//->middleware('jwt.auth.redirect.auth');
    Route::get('/director', function () {
        return view('user.landing_academy', ['type' => 'director']);
    })->name('landing.director');//->middleware('jwt.auth.redirect.auth');
    Route::any('/director/signup', ['uses' => 'UserController@signupAcademy'])->name('landing.director.signup');//->middleware('jwt.auth.redirect.auth');
    /*Route::any('/director/signup', function () {
        return view('common.academy.director');
    })->name('landing.director.signup')->middleware('jwt.auth.redirect.auth');*/
    Route::get('/director/{token}', function () {
        return view('common.academy.director_inside');
    })->name('landing.director-inside');//->middleware('jwt.auth.redirect.auth');

    Route::get('/school/{school}', function () {
        return view('common.academy.school');
    })->name('landing.school');//->middleware('jwt.auth.redirect.auth');

    Route::get('/user/landing', function () {
        return view('user.landing');
    });

    Route::get('/user/career', function () {
        return view('user.career.main');
    });

    Route::get('/job/position', function () {
        return view('user.career.list');
    });

    Route::get('/user/career/add', function () {
        return view('user.career.add');
    });

    Route::get('/user/feedback', function () {
        return view('user.feedback');
    });

    Route::get('/business/view/{id}/{slug}/{items?}', 'BusinessController@viewCareerPage');

    Route::get('business/location_files/{file_name}', function($file_name) {
        $path = storage_path('app/business/location_files/' . $file_name);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    });

    Route::get('business/{id}/widgets/{filename}', function ($id, $filename) {
        $path = $id . '/' . $filename;
        if (!Storage::disk('business_widget')->exists($path)) {
            $path = 'img/business-logo-small.png';
        }

        $file = Storage::disk('business_widget')->get($path);
        $type = Storage::disk('business_widget')->mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    })->name('business.widgets.file');

    Route::get('business/{id}/{full_filename}', function ($id, $full_filename) {
        $extension = pathinfo($full_filename, PATHINFO_EXTENSION); // extension
        $filename = pathinfo($full_filename, PATHINFO_FILENAME); // filename without extension

        if ($extension != 'png') {
            return redirect('/business/' . $id . '/' . $filename . '.png');
        }

        $possible_extensions = ['png', 'jpg', 'gif', 'bmp'];

        foreach ($possible_extensions as $possible_extension) {
            $path = storage_path('app/business/' . $id . '/logo/' . $filename . '.' . $possible_extension);

            if (!File::exists($path)) {
                continue;
            }

            $response = \Image::make($path)->response('png');
            // caching_file_headers($response, $path);

            return $response;

            // $response->header('Cache-Control', 'max-age=315360000');
            // $response->header('Expires', gmdate(DATE_RFC1123, time() + 315360000));
            // $response->header('Last-Modified', gmdate(DATE_RFC1123, filemtime($path)));

            // return $response;
        }

        $path = public_path('img/business-logo-small.png');
        $content = File::get('img/business-logo-small.png');
        $mime_type = File::mimeType('img/business-logo-small.png');
        $response = Response::make($content, 200);
        caching_file_headers($response, $path);

        return $response;

        $response->header('Cache-Control', 'max-age=315360000');
        $response->header('Expires', gmdate(DATE_RFC1123, time() + 315360000));
        $response->header('Last-Modified', gmdate(DATE_RFC1123, filemtime($path)));
        $response->header('Content-Type', $mime_type);

        return $response;
    });

    Route::get('resume/{id}/{filename}', function ($id, $filename) {
        $path = storage_path('app/user/' . $id . '/resume/' . $filename);

        if (!File::exists($path)) {
            $path = 'img/profilepic2.png';
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    });
    Route::get('candidate/{id}/{filename}', function ($id, $filename) {
        $path = storage_path('app/candidates/' . $id . '/' . $filename);

        if (!File::exists($path)) {
            $path = 'img/profilepic2.png';
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    });
    Route::get('qr-code/{id}/{filename}', function ($id, $filename) {
        $path = storage_path('app/qr-code/' . $id . '/' . $filename);

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    });

    Route::get('/langs/{language_prefix}', function($language_prefix) {
        $default_path = resource_path() . '/client_lang/en.php';

        if (!File::exists($default_path)) {
            abort(404);
        }

        $data = include($default_path);

        if ($language_prefix != 'en') {
            $extra_path = resource_path() . '/client_lang/' . $language_prefix . '.php';

            if (File::exists($extra_path)) {
                $extra_data = include($extra_path);

                $merge = function(&$a, $b) use (&$merge) {
                    foreach ($b as $child => $value) {
                        if (isset($a[$child]) && is_array($a[$child]) && is_array($value)) {
                            $merge($a[$child], $value);
                            continue;
                        }

                        $a[$child] = $value;
                    }
                };

                $merge($data, $extra_data);
            }
        }

        return $data;
    });

    Route::get('/CR-landing', function () {
        return view('common.CR_landing');
    });
    Route::get('/CR-teacher', function () {
        return view('common.CR_teacher');
    });
    Route::get('/CR-teacher-inside', function () {
        return view('common.CR_teacher_inside');
    });

    Route::get('/CR-director', function () {
        return view('common.CR_director');
    });
    Route::get('/CR-director-inside', function () {
        return view('common.CR_director_inside');
    });
    Route::get('/CR-school', function () {
        return view('common.CR_school_inside');
    });

    Route::get('/unconfirmed-business/view/{id}/{slug}', 'BusinessController@viewUnconfirmedBusiness');

    Route::get('/unconfirmed-business', function () {
        return view('common.unconfirmed_business');
    });

    Route::get('/businesses/{busines_id}/indeed_feed', 'BusinessController@getIndeedFeed');
});


/**
 * From JobMap
 */
Route::middleware(['language'])->namespace('JobMap')->group(function () {

    Route::get('/', 'CardinalController@index');

    Route::get('/popular', 'PopularController@index');
    Route::get('/popular/{country}', 'PopularController@byCountry');
    Route::get('/popular/{city}/{country}', 'PopularController@byCity');
    Route::get('/explore-keywords/{letter?}', 'PopularController@index');

    Route::get('/about', function () {
        return view('common.jobmap.about');
    });

    Route::get('/contact', function () {
        return view('common.jobmap.contact');
    });

    Route::get('/faq', function () {
        return view('common.jobmap.faq');
    });

    Route::get('/pricing', function () {
        return view('common.jobmap.billing');
    });

    Route::get('/sitemap', function () {
        return view('common.jobmap.site_map');
    });

    Route::get('/test/cardinal', function () {
        return view('common.jobmap.cardinal_test');
    });

    Route::get('/map/world-jobs', function () {
        return view('common.jobmap.job_map_world-jobs');
    });

    Route::get('/headquarter-union', function () {
        return view('common.jobmap.job.headquarter_union');
    });
    Route::get('/location-union', function () {
        return view('common.jobmap.job.location_union');
    });

    Route::get('/map/world-headquarters', function () {
        return view('common.jobmap.job_map_world-headquarters');
    });

    Route::get('/map/world-locations', function () {
        return view('common.jobmap.job_map_world-locations');
    });

    Route::get('/map/world-keywords', function () {
        return view('common.jobmap.job_map_world-keywords');
    });

    Route::get('/jobs-in-locations', function () {
        return view('common.jobmap.job_in_different_locations');
    });

    Route::get('/map/world', 'WorldController@index');

    Route::get('/map/view/job/{id}/{type?}', 'JobController@view');

    Route::get('/map/view/job-union/{id}', 'JobController@viewUnion');

    Route::get('/map/view/location/{id}/{slug}/{type?}', 'LocationController@view');

    Route::get('/map/view/unconfirmed-location/{id}/{slug}', 'LocationController@viewUnconfirmed');

    Route::get('/map/country/{location}', 'LocationController@viewByLocationPart');

    Route::get('/map/region/{region}/{country}', 'LocationController@viewByLocatisearch-formonPart');

    Route::get('/map/city/{city}/{country}', 'LocationController@viewByLocationPart');

    Route::get('/map/street/{street}/{city}/{country}', 'LocationController@viewByLocationPart');

    Route::get('/map/address/{street}/{city}/{country}', 'LocationController@viewByLocationPart');

    Route::get('/map', 'MapController@index');

    Route::get('/test/map', function () {
        return view('common.jobmap.fullmap_test');
    });

    Route::get('/how-jobmap-cloudresume-work', function () {
        return view('common.jobmap.how_jm_and_cr_work');
    });

    Route::get('/advanced-search', 'SearchController@advanced');
    Route::get('/explore-jobs', 'JobController@index');
    Route::get('/explore-jobs-in-letter/{letter?}', 'JobController@index');

    Route::get('/explore-jobs-in-career/{id}/{slug?}', 'JobController@viewSubCategoriesByID');
    Route::get('/explore-locations', function () {
        return view('common.jobmap.explore_locations');
    });

    Route::get('/jobmap_unclaimed_employer_profile', function () {
        return view('common.jobmap.jobmap_unclaimed_employer_profile');
    });

    Route::get('/search', 'SearchController@results');

    Route::get('/explore-employers-in-letter/{letter?}', 'EmployerController@index');
    Route::get('/explore-employers', 'EmployerController@index');

    Route::get('/explore-industries', 'IndustryController@index');
    Route::get('/explore-industries-in-letter/{letter?}', 'IndustryController@index');

    //Route::get('/popular-keywords', function () {
    //    return view('common.explore_popularEmployerKeywords_in_letter');
    //});

    Route::get('/latest/{type?}', 'LatestController@index');
});

Route::any('/stripe/webhook-invoice', 'StripeWebHookController@WebHookInvoice');

Route::any('/wistiti/businesses', 'WistitiController@businesses');
Route::any('/wistiti/applicants', 'WistitiController@applicants');

Route::any('/scan/ajax/set-cropper-picture', 'ScannerController@setCropperPicture');
Route::any('/scan/ajax/get-jobs', 'ScannerController@getJobs');
Route::any('/scan/ajax/user-sign-up', 'ScannerController@signUp');
Route::any('/scan/{location_id}', 'ScannerController@scan');
Route::any('/blur/{id}', function($id) {
    $user = \App\User::find($id);
    $image = imagecreate(200, 20);
    $bg = imagecolorallocate($image, 255, 255, 255);
    $textcolor = imagecolorallocate($image, 0, 0, 0);
    imagestring($image, 5, 0, 0, $user->first_name." ".$user->last_name, $textcolor);

    /* Scale by 25% and apply Gaussian blur */
    $s_img1 = imagecreate(100,10);
    imagecopyresampled($s_img1, $image, 0, 0, 0, 0, 100, 10, 200, 20);
    imagefilter($s_img1, IMG_FILTER_GAUSSIAN_BLUR);

    /* Scale result by 200% and blur again */
    // $s_img2 = imagecreate(150,10);
    // imagecopyresampled($s_img2, $s_img1, 0, 0, 0, 0, 150, 10, 75, 5);
    // imagedestroy($s_img1);
    // imagefilter($s_img2, IMG_FILTER_GAUSSIAN_BLUR);

    /* Scale result back to original size and blur one more time */
    imagecopyresampled($image, $s_img1, 0, 0, 0, 0, 200, 20, 100, 10);
    imagedestroy($s_img1);
    imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
    imagecolortransparent($image, $bg); 
    header('Content-type: image/png');
    imagepng($image);
});

// Route::any('/blur/{id}', function($id) {
//     $user = \App\User::find($id);
//     $image = imagecreate(300, 20);
//     $bg = imagecolorallocate($image, 255, 255, 255);
//     $textcolor = imagecolorallocate($image, 0, 0, 0);
//     imagestring($image, 16, 0, 0, $user->first_name." ".$user->last_name, $textcolor);

//     for ($i=0; $i < 200; $i++) { 
//         # code...
//         imagefilter($image, IMG_FILTER_GAUSSIAN_BLUR);
//     }


//     header('Content-type: image/png');
//     imagepng($image);
// });

Route::any('/image', function() {
    return '<img src="/blur/330" />';
});
