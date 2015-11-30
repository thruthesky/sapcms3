<?php
/**
 * Class Node
 *
 *
 *
 *
 *
 */
class Node extends Entity
{

    public function __construct()
    {
        parent::__construct();
        $this->setTable(DATA_TABLE);
        $this->load->library('upload');
    }


    public function setTable($name) {
        $name = $name . '_node';
        parent::setTable($name);
    }

}
