<?php
/**
 * wayne - laravel4 debug toolbar
 * @author Filipe Dobreira <http://github.com/filp>
 */
namespace Wayne;
use Wayne\WidgetContainer;
use IteratorAggregate;
use BadMethodCallException;

/**
 * A Widget is made of NodeInterface objects, like for example
 * a TextNode, which can contain a label and a link, a color, etc.
 * 
 * @example
 *     $widget // Wayne\Widget
 *         ->text("Hello world") // Wayne\Node\NodeInterface
 *     ->attach();
 */
class Widget implements IteratorAggregate
{
    /**
     * Nodes attached to this Widget, in order.
     * 
     * @var Wayne\Node\NodeInterface[]
     */
    private $nodes = array();

    /**
     * If available, the parent WidgetContainer. This
     * allows for calls to Widget::attach() to just work.
     * 
     * @var Wayne\WidgetContainer
     */
    private $parentContainer;

    /**
     * The (unique, but not enforced) string identifier for this widget
     * 
     * @api
     * @var string
     */
    public $name;

    /**
     * @param string $name
     * @param Wayne\WidgetContainer $parentContainer
     */
    public function __construct($name, $parentContainer = null)
    {
        $this->name            = $name;
        $this->parentContainer = $parentContainer;
    }

    /**
     * Attached this Widget to a container. If no container is provided,
     * and a $parentContainer is available, it'll be attached to it.
     * 
     * @api
     * @see    Wayne\WidgetContainer::attach
     * @param  null|Wayne\WidgetContainer $container
     * @return mixed
     */
    public function attachTo(WidgetContainer $container = null)
    {
        if($container === null) {
            if($this->parentContainer === null) {
                throw new BadMethodCallException(
                    "Argument to " . __METHOD__ . " omitted, but no \$parentContainer available"
                );
            }

            $container = $this->parentContainer;
        }

        return $container->attach($this);
    }

    /**
     * Semantic alias to attachTo
     * 
     * @api
     * @todo   Is this too confusing?
     * @see    Wayne\Widget::attachTo
     * @return mixed
     */
    public function attach()
    {
        return $this->attachto();
    }
}