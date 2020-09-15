<?php

namespace CyberCraft\OrderMate\Facades;

use Illuminate\Support\Facades\Facade;

class OrderMate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'coremate';
    }
}
