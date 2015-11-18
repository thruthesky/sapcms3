<?php

class Config extends Meta {

    public function __construct() {
        parent::__construct();
        $this->setTable(TABLE_CONFIG);
    }

    public function install() {
        $config = $this->init();
        $config
            ->create()
            ->set('code', 'install.stamp')
            ->set('value', time())
            ->save();

        config()
            ->create()
            ->set('code', 'version')
            ->set('value', '0.0.1')
            ->save();
    }
    public function uninstall() {
        $config = meta('config')->uninit();
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
