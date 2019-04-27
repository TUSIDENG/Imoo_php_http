<?php
/**
 * 模拟POST请求
 * 1.请求行: POST /http/test.php HTTP/1.1
 * 
 * 2.首部：
 * HOST:localhost
 * Content-type:application/x-www-form-urlencoded
 * Content-length:20
 * act=query&name=ghost
 */
$str = implode(';', $_POST);
echo $str;