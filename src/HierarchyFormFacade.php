<?php


namespace Dakine\HierarchySelect;


use Illuminate\Support\Facades\Facade;

class HierarchyFormFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'hierarchyForm';
    }

}