<?php
/**
 * Class Post
 *
 * @desc This class holds methods that are used both in PostConfig and PostData
 */
class Post extends Node {

    private $id = null;

    public function __construct() {
        parent::__construct();
    }


    /**
     *
     * Returns the User object of PostConfig or PostData
     *
     * @note This methods can be used for both of PostConfig and PostData
     *
     * @return User
     */
    public function getUser() {
        return user()->load($this->get('id_user'));
    }







}
