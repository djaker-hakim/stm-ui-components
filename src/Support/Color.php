<?php

namespace stm\UIcomponents\Support;


use Mexitek\PHPColors\Color as BaseColor;

class Color extends BaseColor {


    /**
     * 
     * @var static class $color 
     */
    protected static $color;

/**
 * init the color
 * @param string $color
 */
public function __construct($color) {
    static::$color = $color;
    parent::__construct(self::convertColorToHex($color));
}

/**
 * coverts hsl array to string
 * @param array $hsl
 * @return string
 */
public static function hslToString(array $hsl): string {
    $h = (int)($hsl['H'] * 360);
    $s = (int)($hsl['S'] * 100);
    $l = (int)($hsl['L'] * 100);
    return "hsl($h, $s%, $l%)";
}

/**
 * convert hsl string value to hsl array ['H' => x , 'S' => y , 'L' => z ]
 * @param string $color
 * @return array<float|int>
 */
public static function stringToHsl(string $color): array {
    $color = trim(strtolower($color));
    $color = str_replace(['hsl(', ')', '%'], '', $color);
    $arr = explode(',', $color);
    $hsl['H'] = (int)trim($arr[0]) /360;
    $hsl['S'] = (int)trim($arr[1]) /100;
    $hsl['L'] = (int)trim($arr[2]) /100;
    return $hsl;
}

/**
 * converts rgb string to rgb array ['R' => x , 'G' => y , 'B' => z ]
 * @param string $color
 * @return array
 */
public static function stringToRgb(string $color): array {
    $color = trim(strtolower($color));
    $color = str_replace(['rgb(', ')'], '', $color);
    $arr = explode(',', $color);
    $rgb['R'] = (int)trim($arr[0]);
    $rgb['G'] = (int)trim($arr[1]);
    $rgb['B'] = (int)trim($arr[2]);
    return $rgb;
}

/**
 * convert any color format to hex format
 * @param string $color
 * @throws \Exception
 * @return string
 */
public static function convertColorToHex(string $color){
    
    $format = self::detectColorFormat($color);
    if($format == 'hex') return $color;
    if($format == 'rgb') return self::rgbToHex(self::stringToRgb($color));
    if($format == 'rgba') return self::rgbToHex(self::stringToRgb($color));
    if($format == 'hsl') return self::hslToHex(self::stringToHsl($color));
    if($format == 'name') return self::nameToHex($color);
    throw new \Exception("Color format not supported");

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
        if (preg_match('/^[a-z]+$/', $color)) return 'name'; // e.g., "red", "blue", etc.
        return 'unknown';
    }

    /**
     * converts string color formats (rgb, hsl, rgba) to snake case
     * @param string $color
     * @return string
     */
    public static function colorToSnake(string $color) : string {
        $colorFormat = self::detectColorFormat($color);
        if(in_array($colorFormat, ['rgb', 'hsl', 'rgba'])){
            return str_replace(' ', '_', trim($color));
        }
        return $color;
    }
}