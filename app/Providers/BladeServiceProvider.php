<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * adds directive @eval() for setting vars or evaluates expression
         */
        Blade::extend(function($view)
        {
            return preg_replace('/\@eval\((.+)\)/', '<?php ${1}; ?>', $view);
        });

        /**
         *adds directive @ellip($string, $length) for truncating long strings
         */
        Blade::directive('ellip', function($expression)
        {
            list($string, $length) = explode(',',str_replace(['(',')',' '], '', $expression));

            return "<?php echo html_entity_decode(mb_strlen({$string}) > {$length} ? mb_substr({$string},0,{$length}).'&hellip;' : {$string}); ?>";
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
