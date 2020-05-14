<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class Home_Categories extends Module
{
    public function __construct()
    {
        $this->name = 'home_categories';
        $this->tab = 'home_categories';
        $this->version = '1.0.0';
        $this->author = 'Eduardo Nascimento';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Home Categories');
        $this->description = $this->l('List all categories of the store in home web page');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('HOME_CATEGORIES')) {
            $this->warning = $this->l('No name provided');
        }

        if (Configuration::get('PS_SSL_ENABLED')) {
            $this->ssl = 'https://';
        } else {
            $this->ssl = 'http://';
        }
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        return parent::install() &&
            $this->registerHook('displayHome') &&
            $this->registerHook('header') &&
            Configuration::updateValue('HOME_CATEGORIES', 'my friend');
    }

    public function uninstall()
    {
        if (!parent::uninstall() || !Configuration::deleteByName('HOME_CATEGORIES')) {
            return false;
        }

        return true;
    }

    public function hookDisplayHome($params)
    {
        $this->context->smarty->assign([
            'my_module_name' => Configuration::get('HOME_CATEGORIES'),
            'my_module_link' => $this->context->link->getModuleLink('home_categories', 'display')
        ]);

        $cats = Category::getNestedCategories(2);

        $this->context->smarty->assign('categories', $cats);

        return $this->display(__FILE__, 'home_categories.tpl');
    }

    public function hookDisplayRightColumn($params)
    {
        return $this->hookDisplayHome($params);
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path.'css/style.css', 'all');
    }
}