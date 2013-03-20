<?php namespace Wayne\Providers;

/**
 * wayne - laravel4 debug toolbar
 * @author Filipe Dobreira <http://github.com/filp>
 */

use Wayne\Toolbar;
use Wayne\WidgetBuilder\CompositeWidgetBuilder;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
        $app   = $this->app;

        // Bail out if we're in production, testing, or not in a web context.
        // @todo: Is this reliable enough?
        if($app->environment() == 'production' || $app->runningInConsole() || $app->runningUnitTests()) {
            return null;
        }

        // Add Wayne's view directory to the list of search paths.
        $app['view.finder']->addNamespace('wayne', __DIR__ . '/../views');

        $app['wayne.widget_builder'] = function() use($app) {
            return new CompositeWidgetBuilder($app['wayne']);
        };

        $app['wayne'] = $app->share(function() use($app) {
            return new Toolbar($app);
        });

        // Attach the Wayne toolbar to the request, just before
        // it's shipped off to the user agent, but only if we're
        // not dealing with an AJAX request.
        $app->after(function(Request $request, Response $response) use($app) {
            if(!$request->ajax()) {
                $app['wayne']->attachToResponseBody($response);
            }
        });
    }

    /**
     * @see Illuminate\Support\ServiceProvider::providers
     * @return array
     */
    public function provides()
    {
        return array('wayne', 'wayne.widget_builder');
    }
}