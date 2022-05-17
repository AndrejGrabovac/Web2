<?php
set_exception_handler(array('AppCore', 'handleException'));

function my_autoloader($class) {
    include 'util/' . $class . '.class.php';
}

spl_autoload_register('my_autoloader');
?>