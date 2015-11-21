<?php

class Config extends Meta {

    public function __construct() {
        parent::__construct();
        $this->setTable(CONFIG_TABLE);
    }


    /**
     * @param $code
     * @param $value
     * @return Config
     */
    public function set($code, $value) {

        if ( parent::get('id') ) {
        }
        else {
            $this->create();
        }

        parent::set('code', $code);
        parent::set('value', $value);
        $this->save();

        return $this;
    }

    /**
     * @param $code
     * @return string
     */
    public function get($code) {
        $this->load($code);
        return parent::get('value');
    }

}
