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
     *
     * Returns value of the Config item.
     *
     * @note You cannot use 'get()' to get the value of code field.
     *          - This will only return the value of 'value' field.
     *
     * @param $code
     * @return string
     */
    public function get($code) {
        $this->load($code);
        return parent::get('value');
    }

}
