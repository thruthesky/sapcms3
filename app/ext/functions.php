<?php

use firebird\FireBird;
use firebird\Language;

$_list_error = [];

function di($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function debug_log($str) {
    static $count_debug_log = 0;
    $str = is_string($str) ? $str : print_r( $str, true );
    $count_debug_log ++;
    $str = "[$count_debug_log] $str\n";
    $fd = fopen('debug.log', 'a+');
    fwrite($fd, $str);
    fclose($fd);
}

function setError($message) {
    global $_list_error;
    $_list_error[] = $message;
}
function getError() {
    global $_list_error;
    return $_list_error;
}

/**
 * @param $name
 * @param null $o
 */
function widget($name, $o=null) {
    global $_last_widget_name;
    $_last_widget_name = $name;
    include "widget/$name/$name.php";
}


/**
 *
 * @warning Use this function ONLY at the very first line of the widget PHP script.
 *      Or it will create error.
 *
 * @param $file
 * @return string
 */
function widget_css($file=null) {
    global $_last_widget_name;
    if ( empty($file) ) $file = $_last_widget_name;
    echo "<link href='/widget/$_last_widget_name/$file.css' rel='stylesheet'>";
}

function widget_js($file=null) {
    global $_last_widget_name;
    if ( empty($file) ) $file = $_last_widget_name;
    echo "<script type='text/javascript' src='/widget/$_last_widget_name/$file.js'></script>";
}


function errorBox($message) {
    widget('errorBox', $message);
}



function is_email($str) {
    return filter_var($str, FILTER_VALIDATE_EMAIL);
}


/**
 * Returns page no.
 *  if the input is not a number or less than 0, then it returns 0.
 * @param $no
 * @return int|string
 */
function page_no($no) {
    if ( ! is_numeric($no) ) return 0;
    else if ( $no < 0 ) return 0;
    else return -- $no;
}

function getBrowserID() {
    return '';
}
function getIP() {
    return '';
}

function getDomain() {
    $domain = $_SERVER['HTTP_HOST'];
    $domain = strtolower($domain);
    return $domain;
}


/**
 *
 * Returns Base Domain from a domain
 *
 * @warning This is not perfect but works very good.
 * @param $domain
 * @return string
 * @code
 *              echo getBaseDomain(getDomain());
echo getBaseDomain('www.english.co.kr') . '<hr>';
echo getBaseDomain('www.dogs.co.kr') . '<hr>';
echo getBaseDomain('abc.string.pe.kr') . '<hr>';
echo getBaseDomain('www.abc.co.kr') . '<hr>';
echo getBaseDomain('www.abc.com') . '<hr>';
echo getBaseDomain('www.thefun.com.ph') . '<hr>';
echo getBaseDomain('www.get.com') . '<hr>';
echo getBaseDomain('get.some.com') . '<hr>';
echo getBaseDomain('www.explode.net') . '<hr>';
echo getBaseDomain('parts.domain.org') . '<hr>';
 * @endcode
 */
function getBaseDomain($domain) {
    $domain = strtolower($domain);
    $domain = str_replace('www.', '', $domain);
    $ex = explode('.', $domain);
    $index = count($ex)-1;
    $parts = [];
    for( $i=$index; $i >=0 ; $i-- ) {
        $parts[] = $ex[$i];
        if ( strlen($ex[$i]) > 3 ) break;
    }
    $parts_re = array_reverse($parts);
    return implode('.', $parts_re);
}

function getUserAgent() {
    return '';
}



function js($file) {
    return "<script type='text/javascript' src='$file.js'></script>";
}


function ln($code, $kvs=[]) {
    return Language::string($code, $kvs);
}


/**
 * @short returns the first two  bytes of web browser language
 * 이 함수는 오직 두 글자만 리턴한다.
 */
function browser_language()
{
    if ( FireBird::is_cli() ) return null;
    else return substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
}