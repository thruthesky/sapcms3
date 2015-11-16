<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Install extends MY_Controller {


    public function submitInstall()
    {

        // drop tables
        meta('config')->uninit();
        post()->uninit();


        // create tables
        meta('config')->init();
        post()->init();


        $this->testInput();


        echo "install done;";
    }



    private function testInput() {



        meta('config')
            ->create()
            ->set('code', 'aaaa')
            ->set('value', '1111')
            ->save();

    }
}

