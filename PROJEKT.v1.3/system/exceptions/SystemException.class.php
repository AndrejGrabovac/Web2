<?php

class SystemException extends Exception{

    function show(){
        $this->getMessage();
        $this->getFile();
        $this->getLine();
        $this->getTraceAsString();
    }
}

?>