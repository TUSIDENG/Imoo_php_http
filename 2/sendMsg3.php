<?php
$postData = array(
    'act' => 'insert',
    'username' => 'socket',
    'message' => '我是socket提交的内容'
);
$postData = http_build_query($postData);

$fp = fsockopen('localhost', 80, $errno, $errstr, 5);
if (!$fp) {
    echo "$errstr ($errno)<br />";
    exit();
}
$request = "POST http://localhost/http/2/curd.php HTTP/1.1\r\n";
$request .= "Host: localhost\r\n";
$request .= "Content-type: application/x-www-form-urlencoded\r\n";
$request .= "Content-length: " . strlen($postData) . "\r\n"; 
$request .="X-Requested-With: XMLHttpRequest\r\n\r\n";
$request .= $postData;
fwrite($fp, $request);
while (!feof($fp)) {
    echo fgets($fp, 1024);
}
fclose($fp);
