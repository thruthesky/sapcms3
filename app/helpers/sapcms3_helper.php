<?php

/**
 * Returns loaded 'Entity' object.
 *  - Meaning it does not create a new object.
 *  - It only loaded the entity object that is already loaded.
 * @param string $table
 * @return mixed
 */
function entity($table) {
    static $count_entity = 0;
    $temp = $table . ($count_entity ++);
    $ci = & get_instance();
    $ci->load->model('entity', $temp);
    $entity = $ci->$temp;
    $entity->setTable($table);
    return $entity;
}

function meta($table) {
    static $count_meta = 0;
    $temp = $table . ($count_meta ++);
    $ci = & get_instance();
    $ci->load->model('meta', $temp);
    $meta = $ci->$temp;
    $meta->setTable($table);
    return $meta;
}

/**
 * @param null $id
 * @return mixed
 */
function post() {
    $ci = & get_instance();
    $ci->load->model('post');
    return $ci->post;
}



function post_config() {
    static $count_post_config = 0;
    $temp = '_' . ($count_post_config ++);
    $ci = & get_instance();
    $ci->load->model('post', $temp);
    $config = $ci->$temp->setTable('post_config');
    return $config;
}
