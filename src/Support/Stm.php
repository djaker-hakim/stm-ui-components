<?php

namespace stm\UIcomponents\Support;

require __DIR__ . '/../../vendor/autoload.php';

class Stm
{
    private static $COLOR;
    private static $STYLES;



    public static function styles(): Config{
        static::$STYLES = new Config('styles.php');
        return static::$STYLES;
    }

    public static function colors(string $color): Color{
        static::$COLOR = new Color($color);
        return static::$COLOR;
    }

    
    
   
    

   
}