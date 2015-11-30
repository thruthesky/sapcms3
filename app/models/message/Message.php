<?php

class Message extends Node
{
    public function __construct() {
        parent::__construct();
        $this->setTable(MESSAGE_TABLE);
    }
}