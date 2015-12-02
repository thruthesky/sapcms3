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
            'where' => 'id_config=' . $config->get('id'),
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

        $data = [
            'page' => 'post.edit',
            'config' => $config,
        ];

        if ( $id ) {
            $post = post_data($id);
            $data['post'] = $post;
            $data['files'] = $post->getFiles();
        }

        $this->render($data);
    }

    public function editSubmit($name) {
        $post = $this->formEditSubmit();
        redirect("/$name/view/" . $post->get('id'));
    }

    public function ajaxEditSubmit() {
        $post = $this->formEditSubmit();

        ob_start();
        widget('post_list_template_post', $post);
        $markup = ob_get_clean();

        $this->renderAjax([
            'id' => $post->get('id'),
            'id_parent' => $post->get('id_parent'),
            'html' => $markup
        ]);

    }
    public function formEditSubmit() {
        if ( in('id') ) $post = post_data()->updateFromInput();
        else if ( in('id_parent') ) $post = post_data()->createComment(in('id_parent'), in('content'));
        else $post = post_data()->createPostFromInput();
        return $post;
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
            $comments = $post_data->getComments();
            //$files = $post_data->getFiles();
            $render['config'] = $post_config;
            $render['post'] = $post_data;
            $render['user'] = $post_user;
            $render['comments'] = $comments;
            //$render['files'] = $files;
        }
        $this->render($render);
    }

    public function commentSubmit() {
        $comment = post_data()->createComment(in('id_parent'),in('content'));
        redirect( url_post_view_comment( $comment->get('id_root'), $comment->get('id'))  );
    }


    public function commentEditSubmit() {
        $comment = post_data()->updateFromInput();
        redirect( url_post_view_comment( $comment->get('id_root'), $comment->get('id'))  );
    }

    public function ajaxDelete($id) {
        $this->renderAjax(['id'=>$id]);
    }

}