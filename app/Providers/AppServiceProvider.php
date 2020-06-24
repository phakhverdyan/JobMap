<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Validator;
use App\Contracts\Services\User\Business\Location as BusinessLocationContract;
use App\Services\User\Business\LocationService as BusinessLocationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (preg_match('#^https://#i', env('APP_URL', 'https://jobmap.co'))) {
            URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);
        $this->custom_responses();

        Validator::extend('greater_than_field', function ($attribute, $value, $parameters, $validator) {
            $min_field = $parameters[0];
            $data = $validator->getData();
            $min_value = $data[$min_field];
            return $value >= $min_value;
        });

        Validator::replacer('greater_than_field', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':field', $parameters[0], $message);
        });

        Validator::extendImplicit('current_password', function($attribute, $value, $parameters, $validator) {
            if (!$user = \App\User::find($parameters[0])) {
                return false;
            }

            return \Hash::check($value, $user->password);
        });

        \Blade::directive('svg', function($expression) {
            return '<?php echo get_svg_contents(' . $expression . '); ?>';
        });

        // Bind services
        $this->app->bind(BusinessLocationContract::class, BusinessLocationService::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        require_once __DIR__ . '/../Http/helpers.php';
    }
    
    public function custom_responses() {
        Response::macro('error', function ($error = 'Internal Error', $status = 500, $extra = []) {
            $response = [
                'error' => $error,
            ];

            if (is_array($extra)) {
                $response = array_merge_recursive($response, $extra);
            }

            return response($response, $status);
        });

        Response::macro('resource', function ($resource = null, $extra = []) {
            $response = [];

            if ($resource instanceof LengthAwarePaginator) {
                $response['data'] = $resource->getCollection();

                $response['pagination'] = [
                    'current_page'  => $resource->currentPage(),
                    'last_page'     => $resource->lastPage(),
                    'per_page'      => $resource->perPage(),
                    'count'         => $resource->count(),
                    'total'         => $resource->total(),
                ];
            } else {
                $response['data'] = $resource;
            }

            if (is_array($extra)) {
                $response = array_merge_recursive($response, $extra);
            }

            return response($response, 200);
        });
    }
}
