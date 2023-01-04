<?php
if (!defined('_PS_VERSION_')) {
    exit;
}
class Mdn_Disable extends Module {
    public function __construct()
    {
        $this->name = 'mdn_disable';
        $this->author = 'Maison du Net - Loris';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->bootstrap = true;
        $this->ps_versions_compliancy = array('min' => '1.7.2.0', 'max' => _PS_VERSION_);
        $this->displayName = "Disable Prestashop Controllers";
        parent::__construct();
    }

    public function install()
    {
        return parent::install() && $this->registerHook('actionDispatcher');
    }

    // hook runs just after controller has been instantiated
    public function hookActionDispatcher($params)
    {
        if ($params['controller_type'] === 1 && in_array($params['controller_class'],[ 'CartController', 'AuthController', 'OrderController', 'OrderDetailController', 'OrderConfirmationController', 'PasswordController', 'MyAccountController'])) {
            Tools::redirect('pagenotfound'); // redirect contact page to 404 page
        }
    }
}
