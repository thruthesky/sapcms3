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
     * @param $id_parent
     * @param $content
     * @return PostData
     */
    public function createComment($id_parent, $content) {


        $parent = post_data( $id_parent );
        $user = user()->getCurrent();
        $config = post_config($parent->get('id_config'));

        $id_root = $parent->get('id_root');

        $comment = [];
        $comment['id_config'] = $config->get('id');
        $comment['id_user'] = $user->get('id');
        $comment['id_root'] = $id_root;
        $comment['id_parent'] = $parent->get('id');
        $comment['depth'] = $parent->get('depth') + 1;
        $comment['content'] = $content;

        $comment['order_list'] = post_data()->getListOrder($parent);

        $post = post_data()->createPost($comment);

        return $post;
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
