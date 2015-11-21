<?php
/**
 * Class Post
 *
 * @desc This class holds methods that are used both in PostConfig and PostData
 */
class Post extends Entity {

    private $id = null;

    public function __construct() {
        parent::__construct();
    }


    /**
     * @return $this|FALSE
     */
    public function getUser() {
        return user()->load($this->get('id_user'));
    }
}