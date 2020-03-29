<?php
require_once 'vendor/autoload.php';

class CustomSmarty extends Smarty {
    function __construct() 
    {

        // Class Constructor.
        // These automatically get set with each new instance.
        
        parent::__construct();
        
        $this->setTemplateDir($_SERVER['DOCUMENT_ROOT'].'/templates/');
        $this->setCompileDir($_SERVER['DOCUMENT_ROOT'].'/../private/smarty/templates_c/');
        $this->setConfigDir($_SERVER['DOCUMENT_ROOT'].'/../private/smarty/configs/');
        $this->setCacheDir($_SERVER['DOCUMENT_ROOT'].'/../private/smarty/cache/');
        
        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
    }
}
