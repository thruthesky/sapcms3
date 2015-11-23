<?php

class Message extends Entity
{
    public function __construct() {
        parent::__construct();
        $this->setTable(MESSAGE_TABLE);
    }
}