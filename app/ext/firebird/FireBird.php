<?php

namespace firebird;

class FireBird {


    static $list_controller = [];
    static $list_theme = [];
    static $list_model = [];


    public static function initialize()
    {
        self::setModels( glob(APPPATH . "models/*", GLOB_ONLYDIR) );
        self::setControllers( glob(APPPATH . "controllers/*", GLOB_ONLYDIR) );
        /**
         * Load theme namestheme.
         */
        self::setThemes( glob(VIEWPATH . "*", GLOB_ONLYDIR) );
    }




    private static function setModels( $list ) {
        self::$list_model = $list;
    }
    public static function getModels( ) {
        return self::$list_model;
    }

    private static function setControllers( array $list ) {
        self::$list_controller = $list;
    }

    public static function getControllers() {
        return self::$list_controller;
    }


    private static function setThemes( $list ) {
        self::$list_theme = $list;
    }

    public static function getThemes( ) {
        return self::$list_theme;
    }



    public static function is_cli() {
        return (php_sapi_name() === 'cli' OR defined('STDIN'));
    }



    /**
     * @param $plain_text_password
     * @return string
     */
    public static function encryptPassword($plain_text_password) {
        return password_hash($plain_text_password, PASSWORD_DEFAULT);
    }

    public static function checkPassword($plain_text_password, $hash) {
        return password_verify($plain_text_password, $hash);
    }


}