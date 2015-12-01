<?php
/*
 * This file allows you auto load classes
 * without having to include them on the page. 
 * include must be the name of the folder the classes are in
 */
function load_lib($class) {
    include 'models/'.$class . '.php';
};
spl_autoload_register('load_lib');
session_start();
