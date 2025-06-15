<?php

namespace stm\UIcomponents\Support;


class Stm
{
    private static $COLOR;
    private static $STYLES;
    private static $SCRIPTS = [];



    public static function styles(): Config{
        static::$STYLES = new Config('styles.php');
        return static::$STYLES;
    }


    public static function scripts(): Script {
        static::$SCRIPTS = new Script();
        return new Script();
    }

    public static function colors(string $color): Color{
        static::$COLOR = new Color($color);
        return static::$COLOR;
    }

    public static function id(string $id, string $prefix) : string {
        if($id == '') return uniqid($prefix);
        return $id;
    }
    
   
    

   
}