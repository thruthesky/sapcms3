<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class PostData_controller extends MY_Controller
{

    public function collection($name, $offset=0)
    {

        $config = post_config($name);
        $per_page = $config->get('per_page');

        $list = post_data()->search([
            'id_config' => $config->get('id'),
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

        $post_config = post_config()->getCurrent();

        $post_user = $post_data->getUser();

        $this->render([
            'page' => 'post.view',
            'config' => $post_config,
            'post' => $post_data,
            'user' => $post_user,
        ]);
    }

    public function commentSubmit() {

    }

}