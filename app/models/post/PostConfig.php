<?php
class PostConfig extends Post {

    private static $current = null;

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
                case 'per_page' : return 10;
                default: return 'no-config-value';
            }
        }
        else return $value;
    }


    /**
     * Sets the PostConfig of current forum.
     * @param null $id
     */
    public function setCurrent($id=null) {
        if ( is_numeric($id) ) self::$current = $this->load($id);
        else if ( is_string($id) ) self::$current = $this->loadByName($id);
        else if ( $id instanceof PostConfig ) self::$current = $id;
        else PostConfig::$current = null;
    }

    /**
     * Returns the PostConfig object of current forum.
     * @note $this->setCurrent() must be called before using this method.
     * @return PostConfig
     */
    public function getCurrent() {
        if ( self::$current ) return self::$current;

        $mode = $this->uri->segment(2);
        if ( $mode == 'list' || $mode == 'edit' || $mode == 'view' ) {
            $name = $this->uri->segment(1);
            $this->setCurrent($name);
        }
        else if ( in('id_config') ) {
            $this->setCurrent( in('id_config') );
        }
        else if ( in('name') ) {
            $this->setCurrent( in('name') );
        }
        else if ( $post_data = post_data()->getCurrent() ) {
            $this->setCurrent( $post_data->get('id') );
        }

        return self::$current;
    }
}