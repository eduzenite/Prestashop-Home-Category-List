<?php

class mymoduledisplayModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::initContent();
        $this->setTemplate('module:home_categories/views/templates/front/home_categories.tpl');
    }
}