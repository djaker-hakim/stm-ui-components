<?php

namespace stm\UIcomponents\Support;

use Mexitek\PHPColors\Color;
use Illuminate\Support\Str;
class Stm
{

    private static $COLOR;
    private static $STYLES;


    public static function styles(){
        static::$STYLES = new Config('styles.php');
        return static::$STYLES;
    }

    public static function colors(string $color){
        static::$COLOR = new Color($color);
        return static::$COLOR;
    }

    
    /**
     * detect the format of a color.
     *
     * @param string $color The color to detect.
     * @return string The color format.
     */
    public static function detectColorFormat(string $color): string {
        $color = trim(strtolower($color));
        if (preg_match('/^#?([a-f0-9]{3}|[a-f0-9]{6})$/', $color)) return 'hex';
        if (preg_match('/^rgb\(\s*\d+\s*,\s*\d+\s*,\s*\d+\s*\)$/', $color)) return 'rgb';
        if (preg_match('/^rgba\(\s*\d+\s*,\s*\d+\s*,\s*\d+\s*,\s*(0|1|0?\.\d+)\s*\)$/', $color)) return 'rgba';
        if (preg_match('/^hsl\(\s*\d+\s*,\s*\d+%\s*,\s*\d+%\s*\)$/', $color)) return 'hsl';
        if (preg_match('/^[a-z]+$/', $color)) return 'named'; // e.g., "red", "blue", etc.
        return 'unknown';
    }
    

   
}