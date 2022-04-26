<?php
class RequestHandler{

    public function __construct($className){
        $className = $className.'Page';
        $classPath = SYSTEM.'control/'.$className.'.class.php';

        if (!file_exists($classPath)) {
            throw new Exception("Nevažeči URL!");
        }

        require_once($classPath);

        if (!class_exists($className)) {
            throw new Exception("Klasa '".$className."' nije pronađena!");
        }
        new $className;
    }

    public static function handle(){
        if (!empty($_GET['page']) || !empty($_POST['page'])) {
            new RequestHandler((!empty($_GET['page']) ? $_GET['page'] : $_POST['page']));
        }
        else{
            new RequestHandler('Index');
        }
    }
}


?>