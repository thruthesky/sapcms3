<?php
class PostData extends Post {

    public function __construct() {
        parent::__construct();
        $this->setTable(POST_CONFIG_TABLE);
    }





}