<?php
spl_autoload_register('autoloader');
function autoloader ($className){
    $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

    print_r($_SERVER['REQUEST_URI']);

    $path = '../models/';
    $extension = '.php';
    $file = $path.$className.$extension;

    if(!file_exists($file)){
        return "false";
    }
    include_once "$file";
}