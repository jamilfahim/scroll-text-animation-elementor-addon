<?php
namespace Jhfahim_Addon;

/**
* Get All Post Types
* @return array
*/
trait Fahim_Helper
{

   public function jhfahim_get_post_type() {
      $jhfahim_cpts = get_post_types(array('public' => true, 'show_in_nav_menus' => true), 'object');
      $options = array();
      if(!empty($jhfahim_cpts )){
         foreach( $jhfahim_cpts as $type ){
            $options [$type->name] = $type->label;
         }
         return $options;
      }
      
   }

}
