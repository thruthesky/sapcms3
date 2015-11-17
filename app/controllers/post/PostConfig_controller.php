<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class PostConfig_controller extends MY_Controller
{

    public function collection()
    {
        echo 'post list collection<hr>';



        echo "<table>";
        echo "<tr><th>No.</th><th>Name</th></tr>";
        foreach ( post_config()->loadAll() as $config ) {
            echo "<tr>";
            echo "<td>" . $config->get('name') . "</td>";
            echo "<td>" . $config->get('description') . "</td>";
            echo "</tr>";
        }
        echo "</table>";

    }
}