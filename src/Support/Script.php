<?php

namespace stm\UIcomponents\Support;

class Script {
    
    /**
     * holds a list of scripts
     * @var array
     */
    private static $list = [];

    /**
     * holds a list of allowed scripts
     * @var array
     */
    private $allowedScripts = [
        'datatable'
    ];

    /**
     * enable a script
     * @param string $script
     * @return void
     */
    public function enable(string $script): void {
        static::$list[$script] = true;
    }

    /**
     * disabling a script
     * @param string $script
     * @return void
     */
    public function disable(string $script): void {
        static::$list[$script] = false;
    }

    /**
     * returns all scripts from the list. It provides an array of key-value pair key (script name) value (bool)
     * @return array
     */
    public function getScripts(): array{
        return static::$list;
    }
}