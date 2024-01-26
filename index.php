<?php
session_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

function show_error(){
    $error = new errorController();
    $error->index();
}

if(isset($_GET['controller'])){
    $nombre_controller = $_GET['controller'].'Controller';
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    $nombre_controller = controller_defaul;
}else{
    show_error();
    exit();
}

if(class_exists($nombre_controller)){
    $controlador = new $nombre_controller();

    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        $action = $_GET['action'];
        $controlador->$action();
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        $action_defaul = action_defaul;
        $controlador->$action_defaul();
    }
    else{
        show_error();
    }
}else{
    show_error();
}

require_once 'views/layout/footer.php';