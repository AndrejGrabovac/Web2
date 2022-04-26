<?php
define('SYSTEM', __DIR__.'/');
include('core.functions.php');


class AppCore{

    protected static $dbObj;

    function __construct(){
        $this->initOptions();
        $this-> initDB();
        RequestHandler::handle();
    }

    function handleException(\Throwable $e){
        var_dump($e);exit();
        print $e->getMessage();
    }

    function initDB(){
        require_once 'system/config.inc.php';
        require_once 'system/model/MySQLiDatabase.class.php';
        self::$dbObj = new MySQLiDatabase($host, $user, $password, $database);
        
    }

    public static final function getDB(){
        return self::$dbObj;
    }

    function initOptions(){
        require_once 'system/options.inc.php';
    }

}

?>