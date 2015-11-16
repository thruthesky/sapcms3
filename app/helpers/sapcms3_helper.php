<?php

/**
 * Returns loaded 'Entity' object.
 *  - Meaning it does not create a new object.
 *  - It only loaded the entity object that is already loaded.
 * @param null $storage
 * @return mixed
 */
function entity($table=null) {
    $ci = & get_instance();
    $ci->load->model('entity', $table);
    $entity = $ci->entity->$table;
    $entity->table($table);
    return $entity;
}