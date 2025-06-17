<?php

namespace stm\UIcomponents\Support;


class Stm
{

    /**
     * Create a new Config instance for styles.
     *
     * @return Config A Config object initialized with 'styles.php'.
     */
    public static function styles(): Config{
        return new Config('styles.php');
    }


    /**
     * Create a new Script instance.
     * @return Script a new Script object.
     */
    public static function scripts(): Script {
        return new Script();
    }

    /**
     * Create a new Color instance.
     * 
     * @param string $color The color value as a string (e.g., "#ff0000", "red").
     * @return Color A new Color object initialized with the given color.
     */
    public static function colors(string $color): Color{
        return new Color($color);
    }

    /**
     * returns the given $id if it’s not empty. 
     * If $id is an empty string, it generates a unique ID, optionally prefixed by $prefix.
     * @param string $id
     * @param string $prefix
     * @return string
     */
    public static function id(string $id, string $prefix = '') : string {
        if($id == '') return uniqid($prefix);
        return $id;
    }
    
   
    

   
}