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



    /**
     * Returns the number of items.
     * @param $id_root
     * @return mixed
     */
    public function countComment($id_root) {
        return post_data()->count("id_root=$id_root AND id_parent>0");
    }




}
