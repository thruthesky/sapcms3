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
     *
     */
    public function createComment($id_parent, $content) {


        $post = post_data( $id_parent );
        $user = user()->getCurrent();
        $config = post_config($post->get('id_config'));

        $comment = [];
        $comment['id_config'] = $config->get('id');
        $comment['id_user'] = $user->get('id');
        $comment['id_root'] = $post->get('id_root');
        $comment['id_parent'] = $post->get('id');
        $comment['content'] = $content;

        return post_data()->createPost($comment);
    }

}