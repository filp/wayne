<?php namespace Wayne\Providers;

/**
 * wayne - laravel4 debug toolbar
 * @author Filipe Dobreira <http://github.com/filp>
 */

use Illuminate\Support\ServiceProvider;

class WayneServiceProvider extends ServiceProvider
{
    /**
     * @see Illuminate\Support\ServiceProvider::boot
     */
    public function boot()
    {
        $this->package('filp/wayne');
    }

    /**
     * @see Illuminate\Support\ServiceProvider::register
     */
    public function register()
    {
        $app = $this->app;

        // Bail out if we're in production, testing, or not in a web context.
        // @todo: Is this reliable enough?
        if($app->environment() == 'production' || $app->runningInConsole() || $app->runningUnitTests()) {
            return null;
        }
        
        $app['wayne'] = $app->share(function() {
            return 'baloney';
        });
    }

    /**
     * @see Illuminate\Support\ServiceProvider::providers
     * @return array
     */
    public function provides()
    {
        return array('wayne');
    }
}