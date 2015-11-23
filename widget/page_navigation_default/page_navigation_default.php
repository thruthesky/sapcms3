<?php
//needs variables to get passed

$config['first_link'] = "<<";
$config['last_link'] = ">>";
$config['total_rows'] = $total_rows;
$config['per_page'] = $per_page;
$this->pagination->initialize($config);		
$page_navigator = $this->pagination->create_links();	