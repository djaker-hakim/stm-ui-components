<?php

namespace stm\UIcomponents\Support;

class Script {


    private static $list = [];

    private $allowedScripts = [
        'datatable'
    ];

    public function enable(string $script): void {
        static::$list[$script] = true;
    }

    public function disable(string $script): void {
        static::$list[$script] = false;
    }

    public function getScripts(): array{
        return static::$list;
    }
}