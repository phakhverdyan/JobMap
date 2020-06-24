<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
        \App\Http\Middleware\Cors::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\JWTAuthProcess::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
            'guard_switcher:api',
            \App\Http\Middleware\ApiAuthProcess::class,
            \App\Http\Middleware\ApiLocaleDetection::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'graph' => \App\Http\Middleware\Graph::class,
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'forbidden_if_not_logged_in' => \App\Http\Middleware\ForbiddenIfNotLoggedIn::class,
        'forbidden_if_logged_in' => \App\Http\Middleware\ForbiddenIfLoggedIn::class,
        'jwt.auth.redirect' => \App\Http\Middleware\RedirectJWTAuth::class,
        'jwt.auth.redirect.auth' => \App\Http\Middleware\RedirectifJWTAuth::class,
        'jwt.auth.business' => \App\Http\Middleware\BusinessAuth::class,
        'jwt.auth' => \Tymon\JWTAuth\Middleware\GetUserFromToken::class,
        'jwt.refresh' => \Tymon\JWTAuth\Middleware\RefreshToken::class,
        'check.user.resume' => \App\Http\Middleware\CheckResumeFill::class,
        'isAdminUser' => \App\Modules\Admin\Http\Middleware\IsAdminUser::class,
        'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
        'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
        'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,
        'language' => \App\Http\Middleware\GetRequestLanguage::class,
        'go_no_login' => \App\Http\Middleware\goNoLogin::class,
        'check.manager_log_in' => \App\Http\Middleware\checkManagerLogIn::class,
        'check.managers.edit.self' => \App\Http\Middleware\Permit\CheckManagersEditSelf::class,
        'check.business.admin' => \App\Http\Middleware\Permit\CheckIsBusinessAdmin::class,
        'check.permit.locations' => \App\Http\Middleware\Permit\CheckLocations::class,
        'check.permit.jobs' => \App\Http\Middleware\Permit\CheckJobs::class,
        'check.permit.managers_franchisees' => \App\Http\Middleware\Permit\CheckManagersFranchisees::class,
        'check.permit.managers' => \App\Http\Middleware\Permit\CheckManagers::class,
        'check.manager.slot.available' => \App\Http\Middleware\Permit\CheckManagerSlotAvailable::class,
        'check.permit.franchisees' => \App\Http\Middleware\Permit\CheckFranchisees::class,
        'check.permit.brands' => \App\Http\Middleware\Permit\CheckBrands::class,
        'check.permit.departments' => \App\Http\Middleware\Permit\CheckDepartments::class,
        'check.permit.career_page' => \App\Http\Middleware\Permit\CheckCareerPage::class,
        'check.permit.connect_jobmap' => \App\Http\Middleware\Permit\CheckConnectJobMap::class,
        'check.permit.current_paid' => \App\Http\Middleware\Permit\checkCurrentPaid::class,
        'public.api' => \App\Http\Middleware\PublicApi::class,
        'guard_switcher' => \App\Http\Middleware\GuardSwitcher::class,
    ];
}
