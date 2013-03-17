<?php namespace Wayne\Facades;

/**
 * wayne - laravel4 debug toolbar
 * @author Filipe Dobreira <http://github.com/filp>
 */

use Illuminate\Support\Facades\Facade;

class WayneFacade extends Facade
{
    /**
     * @see Illuminate\Support\Facade\Facade::getFacadeAccessor
     */
    protected static function getFacadeAccessor() { return 'wayne'; }
}