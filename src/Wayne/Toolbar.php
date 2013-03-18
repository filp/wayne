<?php namespace Wayne;

/**
 * wayne - laravel4 debug toolbar
 * @author Filipe Dobreira <http://github.com/filp>
 */

use Wayne\WidgetBuilder\CompositeWidgetBuilder;
use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Response;

class Toolbar
{
    /**
     * @var Illuminate\Foundation\Application $app
     */
    protected $app;

    /**
     * All the widgets for this toolbar
     * @var array
     */
    protected $widgets = array();

    /**
     * @param Illuminate\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @api
     * @return Wayne\WidgetBuilder\CompositeWidgetBuilder
     *         - OR maybe not, an interface might be in order.
     */
    public function widget()
    {
        return $this->app['wayne.widget_builder']($this);
    }

    /**
     * Attaches a widget to this toolbar. Will mostly be called
     * by the WidgetBuilder to attach a complete widget, but
     * may also be accessed directly when working with more complex
     * widget constructions.
     *
     * @api
     * @param  CompositeWidgetBuilder $widget
     * @return Wayne\Toolbar
     */
    public function attach($widget)
    {
        $this->widgets[] = $widget;
        return $this;
    }

    /**
     * Renders all registered widgets and the full toolbar,
     * ready to ship off to a user-agent.
     * @return string
     */
    protected function render()
    {
        return $this->app['view']->make('wayne::toolbar');
    }

    /**
     * @param Symfony\Component\HttpFoundation\Response $response
     */
    public function attachToResponseBody(Response $response)
    {
        $content = $response->getContent();

        // Monkey-business ahead!
        // Apply heuristics (read: regular expressions) to attach
        // right before an existing </body> tag, if it exists. This
        // helps us prevent messing up non-html responses.
        // 
        // Regex searches are fast, so we do them twice: once to check
        // there's actually something there, and one to do the replace.
        // This is because the toolbar rendering may be a more or less
        // intensive operation, and I'd rather avoid doing it for EVERY
        // request.
        $bodyRe  = '/<\/body>/i';
        if(preg_match($bodyRe, $content)) {
            $toolbarContent = $this->render();
            $newContent     = preg_replace($bodyRe, "{$toolbarContent}\n</body>", $content, 1);

            $response->setContent($newContent);
        }
    }
}