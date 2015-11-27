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
        $count = 0;
        foreach( $this->unit->result() as $row ) {
            $count ++;
            if ( $row['Result'] == 'Passed' ) echo "<span>$count</span> ";
            else {
                echo "<b style='color:red; font-size:300%;'>X</b> ";
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

        echo "
        <style>
        span {
        display:inline-block;
        margin:4px 0;
        padding:4px;
        background-color:grey;
        color:white;
        border-radius:3px;
        }
        </style>
        ";
        // echo $this->unit->report();
    }
}