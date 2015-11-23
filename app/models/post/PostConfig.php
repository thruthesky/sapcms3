<?php
class PostConfig extends Post {

    public function __construct() {
        parent::__construct();
        $this->setTable(POST_CONFIG_TABLE);
    }



    public function loadByName($name) {
        return $this->loadBy('name', $name);
    }



    public function get($field) {
        $value = parent::get($field);
        if ( $value === FALSE ) {
            switch ( $field ) {
                case 'widget_list' : return 'post_list_default';
                case 'widget_edit' : return 'post_edit_default';
                case 'widget_view' : return 'post_view_default';
                default: return 'no-config-value';
            }
        }
        else return $value;
    }


}