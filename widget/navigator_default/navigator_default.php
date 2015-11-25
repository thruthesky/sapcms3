<?php
/**
 *
 * @param $navigator - is the 'config' array as the same values of CI3
 *
 *
 *
 *
 */
widget_css();

if ( ! isset($o['total_rows']) ) errorBox("No 'total_rows' value");
if ( ! isset($o['per_page']) ) errorBox("No 'per_page' value");
if ( ! isset($o['base_url']) ) errorBox("No 'base_url' value");

$o['num_links'] = 4;
//$o['use_page_numbers'] = TRUE;

$o['full_tag_open'] = "<ul class='pagination'>";
$o['full_tag_close'] ="</ul>";

$o['num_tag_open'] = '<li>';
$o['num_tag_close'] = '</li>';

$o['cur_tag_open'] = "<li class='disabled active'><a href='#'>";//you added extra li tag here
$o['cur_tag_close'] = "<span class='sr-only'></span></a></li>";

$o['next_tag_open'] = "<li>";
$o['next_tag_close'] = "</li>";//tagl? should be tag

$o['prev_tag_open'] = "<li>";
$o['prev_tag_close'] = "</li>";//tagl? should be tag

$o['first_tag_open'] = "<li>";
$o['first_tag_close'] = "</li>";//tagl? should be tag

$o['last_tag_open'] = "<li>";
$o['last_tag_close'] = "</li>";//tagl? should be tag



$ci = & get_instance();
$ci->load->library('pagination');
$ci->pagination->initialize($o);
echo $ci->pagination->create_links();
