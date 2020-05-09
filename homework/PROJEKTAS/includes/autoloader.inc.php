<?php

spl_autoload_register('autoLoader');

function autoLoader($className)
{
    $path      = $_SERVER['DOCUMENT_ROOT'] . '/PROJEKTAS/classes/';
    $path2     = $_SERVER['DOCUMENT_ROOT'] . '/PROJEKTAS/config/';
    $extention = '.php';
    $fullPath  = $path . $className . $extention;
    $fullPath2 = $path2 . $className . $extention;

    if (file_exists($fullPath)):
        include_once $fullPath;
    elseif (file_exists($fullPath2)):
        include_once $fullPath2;
    else:
        return false;
    endif;
}
