<?php

abstract class AbstractPage {
    function __construct() {
        $this->code();
        $this->show();
    }

    function show() {
        $v = $this->v ?? [];
        require_once(SYSTEM . 'view/index.tpl.php');
    }

    abstract function code();
}