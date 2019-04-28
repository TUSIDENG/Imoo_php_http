<?php
$postData = array(
    'act' => 'insert',
    'username' => 'fopen',
    'message' => '我是fopen的内容'
);
$postData = http_build_query( $postData );
$opts = array(
    'http'=>array(
      'method'=>"POST",
      'header'=>"Host: localhost\r\n" .
                "Content-type: application/x-www-form-urlencoded\r\n" .
                "Content-length: " . strlen( $postData ) . "\r\n" .
                "X-Requested-With: XMLHttpRequest\r\n",
       'content' => $postData
    )
  );
$context = stream_context_create( $opts );
// $result = file_get_contents('http://127.0.0.1/http/2/curd.php', false, $context);
$fp = fopen('http://127.0.0.1/http/2/curd.php', 'r', false, $context);
// 从文件中读取一行
$result = fgets($fp);
fclose($fp);
var_dump($result);