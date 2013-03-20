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
        'template' => 'wayne::widget.composite',
        'buttons'  => array()
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
     * @api
     * @param  string $key
     * @param  mixed  $default
     * @return mixed
     */
    public function part($key, $default = null)
    {
        if($this->hasPart($key)) {
            return $this->parts[$key];
        }

        return $default;
    }

    /**
     * Returns true if this widget contains a part, identified
     * by its key.
     * @api
     * @param  string $key
     * @return bool
     */
    public function hasPart($key)
    {
        return !empty($this->parts[$key]);
    }

    /**
     * Idiomatic alias to CompositeWidgetBuilder::hasPart that
     * also verifies thrutyness
     * @api
     * @example $widget->is('important')
     * @param  string $key
     * @return bool
     */
    public function is($key)
    {
        return $this->hasPart($key) && $this->part($key);
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
        $this->parts['template'] = $template;
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
        $this->parts['html'] = $html;
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
        $this->parts['title'] = $title;
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
        $this->parts['id'] = $id;
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
        $this->parts['description'] = $description;
        return $this;
    }

    /**
     * Adds a button to the widget. A widget may have
     * multiple buttons, which will be displayed in order,
     * side-to-side (by default)
     *
     * @api
     * @param  string $label 
     * @param  string $link  
     * @param  string $color   A CSS color for the button
     * @param  string $target  i.e: _self, _blank
     * @return Wayne\WidgetBuilder\CompositeWidgetBuilder
     */
    public function button($label, $link = '', $color = null, $target = '_self')
    {
        $this->parts['buttons'][] = (object) array(
            'label'  => $label,
            'href'   => $link,
            'color'  => $color,
            'target' => $target
        );

        return $this;
    }

    /**
     * Adds a badge to the widget, which looks like a button,
     * but isn't clickable. Can be used to highlight important
     * values or some such. It's really just a button.
     *
     * @api
     * @param  string $label 
     * @param  string $color   A CSS color for the button
     * @return Wayne\WidgetBuilder\CompositeWidgetBuilder
     */
    public function badge($label, $color = null)
    {
        $this->button($label, null, $color);
        return $this;
    }

    /**
     * Sets the plain-text content for this widget.
     * @api
     * @param string $text
     * @return Wayne\WidgetBuilder\CompositeWidgetBuil
     */
    public function text($text)
    {
        $this->parts['text'] = $text;
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

        $this->parts['style'] = $css;
        return $this;
    }
}
