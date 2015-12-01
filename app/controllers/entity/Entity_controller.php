<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Entity_controller extends MY_Controller
{

    public function collection($name)
    {

        di($name);

        $rows = $name()->loadAll();

        di($rows);
    }
}
