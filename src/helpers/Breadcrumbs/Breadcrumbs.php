<?php 

namespace MrJuliuss\Syntara\Helpers;

use Illuminate\Support\Facades\URL;

/**
* Breadcrumb class
*/
class Breadcrumbs 
{
    /**
    * Create breadcrumb
    * @param array $items breadcrumb items
    * @return string
    */
    public static function create($items)
    {
        if(empty($items))
        {
            return;
        }
        
        $crumbs = array();
        foreach($items as $key => $item)
        {
            $active = false;
            if((count($items) - 1) === $key)
            {
                $active = true;
            }
            $crumbs[] = static::renderItem($item, $active);
        }
        
        $html = '<div id="breadcrumb">';
        $html .= implode('', $crumbs);;
        $html .= '</div>';
        
        return $html;
    }
    
    /**
    * Render the current item
    * @param array $item part of the breadcrumb
    * @param boolean $active current breadcrumb is active
    * @return string
    */
    public static function renderItem($item, $active)
    {
        $class = "";
        if($active === true)
        {
            $class = "current";
        }
        
        return '<a href="'.URL::to($item["link"]).'" class="tip-bottom '.$class.'"><i class="glyphicon '.$item["icon"].'"></i>'.$item["title"].'</a>';
    }
}