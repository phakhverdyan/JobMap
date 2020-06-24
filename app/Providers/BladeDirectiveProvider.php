<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeDirectiveProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('svg', function($expression) {
            return '<?php echo get_svg_contents(' . $expression . '); ?>';
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
