<?php
/**
 * wayne - laravel4 debug toolbar
 * @author Filipe Dobreira <http://github.com/filp>
 */
namespace Wayne;

/**
 * A Node is the smallest unit of a Widget. It can be something
 * as simple as a link element, or as big as a whole chunk of HTML.
 * 
 * @example
 *     $link = $widget
 *         ->text("Go To Google")
 *           ->linkTo("http://google.com", [ "target" => "_blank" ])
 *         ->attach()
 */
class Node
{
    /**
     * Renders the Node and returns its string representation.
     * 
     * @return string
     */
    public function render()
    {
        
    }
}