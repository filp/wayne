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
     * Renders all registered widgets and the full toolbar,
     * ready to ship off to a user-agent.
     * @return string
     */
    protected function render()
    {
        return "not yet";
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