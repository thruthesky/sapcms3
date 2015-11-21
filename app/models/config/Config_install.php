<?php

class Config_install extends Config {

    public function __construct() {
        parent::__construct();
    }

    public function install() {
        $this->init();
        $this->set('install.stamp', time());
        $this->set('version', '0.0.1');
    }

    public function uninstall() {
        if ( meta('config')->tableExists() ) meta('config')->uninit();
    }

}
