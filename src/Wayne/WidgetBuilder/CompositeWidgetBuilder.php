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
     * Widget meta-data, that may or may not be displayed
     * in the actual toolbar.
     * @var array
     */
    protected $meta = array();

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
        $app = $this->parentToolbar->getApp();
        return $app['view']->make('wayne::widget.composite', array(
            'widget' => $this
        ));
    }

    /**
     * Retrieves a value, by key, from this widget's meta-data
     * array. $default if the key does not exist, or is empty.
     * @param  string $key
     * @return mixed
     */
    public function meta($key, $default = null)
    {
        return !empty($this->meta[$key]) ? $this->meta[$key] : $default;
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
        $this->meta['title'] = (string) $title;
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
        $this->meta['id'] = (string) $id;
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
        $this->meta['description'] = (string) $description;
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

        $this->meta['style'] = (string) $css;
        return $this;
    }
}