<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class PostData_controller extends MY_Controller
{

    public function collection($name, $offset=0)
    {

        $config = post_config($name);
        $per_page = $config->get('per_page');

        $id_config = $config->get('id');
        $where = "id_config=$id_config AND id_parent=0";
        $list = post_data()->search([
            'where' => $where,
            'order_by' => 'id DESC',
            'offset' => $offset,
            'limit' =>  $per_page,
        ]);

        $total_rows = post_data()->searchCount([
            'id_config' => $config->get('id'),
        ]);

        $this->render([
            'page' => 'post.list',
            'config' => $config,
            'list' => $list,
            'total_rows' => $total_rows,
        ]);

    }

    public function edit($name, $id = 0 ) {
        $config = post_config($name);
        if ( ! $config->exists() ) setError("PostConfig does not exists");
        $this->render([
            'page' => 'post.edit',
            'config' => $config,
        ]);
    }

    public function editSubmit() {

        $post = post_data()->createPostFromInput();
        $name = post_config()->getCurrent()->get('name');
        $id = $post->get('id');
        redirect("/$name/view/$id");
    }

    public function view() {
        $post_data = post_data()->getCurrent();
        $render = ['page' => 'post.view'];
        if ( empty($post_data) ) {
            setError("No post by that post id");
        }
        else {
            $post_config = post_config()->getCurrent();
            $post_user = $post_data->getUser();
            $comments = post_data()->getComments($post_data->get('id'));
            $render['config'] = $post_config;
            $render['post'] = $post_data;
            $render['user'] = $post_user;
            $render['comments'] = $comments;
        }


        $this->render($render);
    }

    public function commentSubmit() {
        $comment = post()->createComment(in('id_parent'),in('content'));
        redirect( url_post_view_comment( $comment->get('id_root'), $comment->get('id'))  );
    }


}