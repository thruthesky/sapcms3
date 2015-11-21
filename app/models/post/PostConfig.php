<?php
class PostConfig extends Post {

    public function __construct() {
        parent::__construct();
        $this->setTable(POST_CONFIG_TABLE);
    }



    public function loadByName($name) {
        return $this->loadBy('name', $name);
    }





}