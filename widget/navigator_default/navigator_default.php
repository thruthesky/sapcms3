<?php
/**
 *
 * @param $navigator - is the 'config' array as the same values of CI3
 *
 *
 * @example /theme/default/page/user.admin_list.php
 * @example /theme/default/page/post_list_list.php
 *
 * @code
 *
<?php widget('navigator_default', [
'base_url' => "/message/$data[type]",
'per_page'=> $data['per_page'],
'total_rows' => $data['total_rows'],
] )?>

 * @endcode
 *
 *
 */
widget_css();

if ( ! isset($o['total_rows']) ) errorBox("No 'total_rows' value");
if ( ! isset($o['per_page']) ) errorBox("No 'per_page' value");
if ( ! isset($o['base_url']) ) errorBox("No 'base_url' value");

$o['num_links'] = 4;

$o['full_tag_open'] = "<ul class='pagination'>";
$o['full_tag_close'] ="</ul>";

$o['num_tag_open'] = '<li>';
$o['num_tag_close'] = '</li>';

$o['cur_tag_open'] = "<li class='disabled active'><a href='#'>";
$o['cur_tag_close'] = "<span class='sr-only'></span></a></li>";

$o['next_tag_open'] = "<li>";
$o['next_tag_close'] = "</li>";

$o['prev_tag_open'] = "<li>";
$o['prev_tag_close'] = "</li>";

$o['first_tag_open'] = "<li>";
$o['first_tag_close'] = "</li>";

$o['last_tag_open'] = "<li>";
$o['last_tag_close'] = "</li>";

$o['first_link'] = "&lt;&lt; First";
$o['last_link'] = "Last &gt;&gt;";

$ci = & get_instance();
$ci->load->library('pagination');
$ci->pagination->initialize($o);
echo $ci->pagination->create_links();
