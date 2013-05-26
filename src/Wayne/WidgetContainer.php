<?php
/**
 * wayne - laravel4 debug toolbar
 * @author Filipe Dobreira <http://github.com/filp>
 */
namespace Wayne;
use Wayne\Widget;
use IteratorAggregate;

/**
 */
class WidgetContainer implements IteratorAggregate
{
    /**
     * @var Wayne\Widget[]
     */
    private $widgets = array();

    /**
     * Starts up a new widget, with the means to attach it back
     * to this container. Widgets do not have to be opened and closed
     * in any particular order or sequence.
     * 
     * @api
     * @param  string $name (unique) identifier for the new widget
     * @return Wayne\Widget
     */
    public function widget($name)
    {
        return new Widget($name, $this /* container */);
    }

    /**
     * Attaches a widget to this container.
     * 
     * @api
     * @param  Wayne\Widget $widget
     * @return Wayne\WidgetContainer
     */
    public function attach(Widget $widget)
    {
        $this->widgets[] = $widget;
    }

    /**
     * Returns an array with all attached widgets.
     * 
     * @api
     * @return array|Wayne\Widget[]
     */
    public function getWidgets()
    {
        return $this->widgets;
    }

    /**
     * @see    IteratorAggregate::getIterator
     * @return array|Wayne\Widget[]
     */
    public function getIterator()
    {
        return $this->getWidgets();
    }
}