<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test_controller extends MY_Controller
{

    public function index() {
        static $co = 0;
        foreach ( getModels() as $model ) {
            $name = pathinfo($model, PATHINFO_BASENAME);
            $files = glob( $model . '/*_test.php' );
            foreach( $files as $file ) {
                $filename = pathinfo($file, PATHINFO_FILENAME);

                $path = "$name/$filename";
                $obj = $name . $co ++;
                $this->load->model($path, $obj);
                if ( method_exists( $this->$obj, 'unitTest') ) $this->$obj->unitTest();
            }
        }

        foreach( $this->unit->result() as $row ) {
            if ( $row['Result'] == 'Passed' ) echo 'O';
            else echo "<b style='color:red;'>X</b>";
        }

        echo $this->unit->report();
    }
}