<?php

function load($file) {
    if(is_file($file)){
        require_once $file;
    }
}

spl_autoload_register(function($class) {
    $parts = explode('\\', $class);

    $classDirs = ['/core/', '/app/Models/', '/app/Controllers/', '/app/Controllers/Admin/'];

    foreach ($classDirs as $classDir) {
        load(ROOT.$classDir.end($parts).'.php');
    }

});