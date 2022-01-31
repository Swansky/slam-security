<?php
require_once('class/Settings.php');
spl_autoload_register( function($className){

    $BASE_PATH = Settings::BASE_PATH;

    if(!isset($BASE_PATH)){
        throw new Exception("Autoload Exception : Basepath not defined", 1);
    }

    $dirList = ['view', 'model', 'controller', 'utils', 'class'];

    $classLoaded = false;

    foreach($dirList as $dirName){
        $file = $BASE_PATH.'/'.$dirName.'/'.$className.'.php';

        if( !$classLoaded && file_exists($file) ){
            $classLoaded = true;
            require_once($file);
            break;
        }
    }
    if(! $classLoaded){
        throw new Exception("Autoload Exception : class ". $className." is not load", 1);
    }


});