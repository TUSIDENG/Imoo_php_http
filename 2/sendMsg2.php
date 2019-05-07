<?php
$postData = array(
    'act' => 'insert',
    'username' => 'curl',
    'message' => '我是curl提交的内容'
);
// 初始化curl会话
$ch = curl_init();
// 设置会话选项
curl_setopt($ch, CURLOPT_URL, 'http://localhost/http/2/curd.php');
curl_setopt($ch, CURLOPT_POST, true);
//   设置header
curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Requested-With: XMLHttpRequest'));
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
//   设置返回数据为字符串
curl_setopt($ch, CURLOPT_TRANSFERTEXT, true);
// 执行会话
$output = curl_exec($ch);
// 关闭会话
curl_close($ch);
echo $output;