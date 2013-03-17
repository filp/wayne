<?php namespace Wayne;

/**
 * wayne - laravel4 debug toolbar
 * @author Filipe Dobreira <http://github.com/filp>
 */

use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Response;

class Toolbar
{
    /**
     * @var Illuminate\Foundation\Application $app
     */
    protected $app;

    /**
     * @param Illuminate\Foundation\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
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
        $bodyRe  = '/<\/body>/i';
        $newContent = preg_replace($bodyRe, "wayne\n</body>", $content, 1);
        $response->setContent($newContent);
    }
}