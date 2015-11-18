<?php

class Config extends Meta {

    public function __construct() {
        parent::__construct();
        $this->setTable(TABLE_CONFIG);
    }

    public function install() {
        $this->init();
        $this->set('install.stamp', time());
        $this->set('version', '0.0.1');
    }

    public function uninstall() {
        if ( meta('config')->tableExists() ) meta('config')->uninit();
    }

    public function set($code, $value) {
        parent::create();
        parent::set('code', $code);
        parent::set('value', $value);
        parent::save();
        return $this;
    }

    public function get($code) {
        $this->load($code);
        return parent::get('value');
    }

}
