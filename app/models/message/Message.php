<?php

class Message extends Node
{
    public function __construct() {
        parent::__construct();
        $this->setTable(MESSAGE_TABLE);
    }
	
	/**
     * @param int $id
     * @return array
     * @code
     * $files = $message->getFiles();
     * @endcode
     */
    public function getFiles($id=0) {
        if ( empty($id) ) $id = $this->get('id');
        return data()->query_loads("model='message' AND id_entity=$id");
    }
}