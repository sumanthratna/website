<?php
require_once 'vendor/autoload.php';

class CustomSmarty extends Smarty
{
    public function __construct($document_root)
    {

        // Class Constructor.
        // These automatically get set with each new instance.
        parent::__construct();

        $this->setTemplateDir($document_root . '/templates/');
        $this->setCompileDir($document_root . '/../private/smarty/templates_c/');
        $this->setConfigDir($document_root . '/../private/smarty/configs/');
        $this->setCacheDir($document_root . '/../private/smarty/cache/');

        // https://www.smarty.net/docs/en/caching.tpl
        $this->setCaching(Smarty::CACHING_LIFETIME_CURRENT);
        $this->setCompileCheck(false);
    }
}
