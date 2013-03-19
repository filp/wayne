<?php namespace Wayne\WidgetBuilder;

/**
 * wayne - laravel4 debug toolbar
 * @author Filipe Dobreira <http://github.com/filp>
 */

use Wayne\Toolbar;
use RuntimeException;

/**
 * Exposes a fluent interface for building kick-ass widgets.
 */
class CompositeWidgetBuilder
{
    /**
     * @var Wayne\Toolbar
     */
    protected $parentToolbar;

    /**
     * Widget parts, includes both visible components, and
     * meta-data.
     * @var array
     */
    protected $parts = array(
        'template' => 'wayne::widget.composite'
    );

    /**
     * If no Toolbar instance is provided at time of creation,
     * the widget will have to be explicitly attached to the
     * Toolbar through Wayne\Toolbar::attach
     * 
     * @param Toolbar|null $toolbar
     */
    public function __construct(Toolbar $toolbar = null)
    {
        $this->parentToolbar = $toolbar;
    }

    /**
     * Renders the contents of this Widget and returns a string.
     * @return string
     */
    public function render()
    {
        // If there's raw html for this widget, return it right away,
        // ignoring all other properties of this Widget, otherwise,
        // render the template part with the existing widget data.
        if($this->hasPart('html')) {
            return $this->part('html');
        } else {
            $app = $this->parentToolbar->getApp();
            return $app['view']->make($this->part('template'), array(
                'widget' => $this
            ));
        }
    }

    /**
     * Retrieves a value, by key, from this widget's contents.
     * @param  string $key
     * @return mixed|null Null if doesn't exist
     */
    public function part($key)
    {
        if($this->hasPart($key)) {
            return $this->parts[$key];
        }
    }

    /**
     * Returns true if this widget contains a part, identified
     * by its key.
     * @param  string $key
     * @return bool
     */
    public function hasPart($key)
    {
        return !empty($this->parts[$key]);
    }

    /**
     * Attaches this widget to the $parentToolbar instance
     * @api
     * @throws RuntimeException If attempt to attach with no Toolbar instance
     * @return Wayne\Toolbar
     */
    public function attach()
    {
        if(!$this->parentToolbar instanceof Toolbar) {
            throw new RuntimeException(
                "Cannot attach widget: no Toolbar instance to attach to"
            );
        }

        return $this->parentToolbar->attach($this);
    }

    /**
     * Sets the template for this widget. Must be a valid Path
     * accepted by the View\Environment, i.e: wayne::widget.composite
     * This template will receive a $widget property, for the instance
     * being rendered.
     * @api
     * @param string $template
     * @return Wayne\WidgetBuilder\CompositeWidgetBuilder
     */
    public function template($template)
    {
        $this->parts['template'] = (string) $template;
        return $this;
    }

    /**
     * Sets raw HTML content for this widget. Setting this
     * part will effectively all(or most) other properties
     * of the widget to be ignored, as there's no template
     * to render.
     * @api
     * @param  string $html
     * @return Wayne\WidgetBuilder\CompositeWidgetBuilder
     */
    public function html($html)
    {
        $this->parts['html'] = (string) $html;
        return $this;
    }
    
    /**
     * Sets the title for this widget.
     * Will be built automagically from some unique value
     * if not present, such as order of attachment to the
     * Toolbar.
     * @api
     * @param  string $title
     * @return Wayne\WidgetBuilder\CompositeWidgetBuilder
     */
    public function title($title)
    {
        $this->parts['title'] = (string) $title;
        return $this;
    }

    /**
     * Sets a unique identifier for this widget
     * Will be built automagically out of the title if not
     * present.
     * Will also be used in the html for the toolbar, prefixed
     * with "wayne-widget-"
     * @api
     * @param  string $id
     * @return Wayne\WidgetBuilder\CompositeWidgetBuilder
     */
    public function id($id)
    {
        $this->parts['id'] = (string) $id;
        return $this;
    }

    /**
     * Sets a description for this widget
     * @api
     * @param  string $description
     * @return Wayne\WidgetBuilder\CompositeWidgetBuilder
     */
    public function description($description)
    {
        $this->parts['description'] = (string) $description;
        return $this;
    }

    /**
     * Attaches extra css to outer container of this widget,
     * allowing quick customizations without the trouble of
     * using a whole new template.
     *
     * Argument may be a string, or array of strings
     * 
     * @api
     * @example Wayne::css('color: red; font-weight: bold')
     * @example Wayne::css(array(
     *    'color: red',
     *    'font-weight: bold'
     * ));
     * @param  string|array $css
     * @return Wayne\WidgetBuilder\CompositeWidgetBuilder
     */
    public function css($css)
    {
        if(is_array($css)) {
            $css = join(";", $css);
        }

        $this->parts['style'] = (string) $css;
        return $this;
    }
}