<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Install_controller extends MY_Controller {

    public function page() {

        echo "
        <a href='?'>Front</a>,
        <a href='?mode=install'>Install</a>,
        <a href='?mode=uninstall'>Uninstall</a>,
        <a href='?mode=reinstall'>Reinstall</a>,
        ";




        if ( in('mode') == 'install' ) {
            $this->installModels();
        }
        else if ( in('mode') == 'uninstall' ) {
            $this->uninstallModels();
        }
        else if ( in('mode') == 'reinstall' ) {
            $this->uninstallModels();
            $this->installModels();
        }

    }


    public function work($mode) {
        static $co = 0;
        foreach ( getModels() as $model ) {
            $name = pathinfo($model, PATHINFO_BASENAME);
            $path = "$name/" . ucfirst($name);
            $obj = $name . $co ++;
            $this->load->model($path, $obj);
            if ( $mode == 'install' ) {
                if ( method_exists( $this->$obj, 'install') ) $this->$obj->install();
            }
            else if ( $mode == 'uninstall' ) {
                if ( method_exists( $this->$obj, 'uninstall') ) $this->$obj->uninstall();
            }
        }
    }

    /**
     *
     */
    public function installModels() {
        $this->work('install');
    }

    /**
     *
     */
    public function uninstallModels() {
        $this->work('uninstall');
    }

    private function testInput() {
        meta('config')
            ->create()
            ->set('code', 'aaaa')
            ->set('value', '1111')
            ->save();
    }

}

