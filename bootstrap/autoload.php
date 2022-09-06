<?php

function fqcnToPath($fqcn) {
    return str_replace('\\', '/', $fqcn).'.php';
}

spl_autoload_register(function($class) {
    $path = fqcnToPath($class);
    include_once ROOT.'/app/'.$path;
});