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

        $errors = [];
        foreach( $this->unit->result() as $row ) {
            if ( $row['Result'] == 'Passed' ) echo 'O ';
            else {
                echo "<b style='color:red;'>X</b> ";
                $errors[] = $row;
            }
        }

        if ( $errors ) {
            echo "<h4>TEST ERROR</h4>";
            foreach( $errors as $e ) {
                echo "
<pre>
Test Name : {$e['Test Name']}
File Name : {$e['File Name']}
Line Number : {$e['Line Number']}
                </pre>
                <hr>
                ";
            }
        }

        // echo $this->unit->report();
    }
}