<?php
$ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
if (!$ajax) {
    header('Content-type:text/html;charset=utf-8');
    echo '<script>alert("请求不合法");location.href="index.html";</script>';
    exit();
}
header('Content-type: application/json');

include './vendor/autoload.php';
$db = \ParagonIE\EasyDB\Factory::create(
    'mysql:host=localhost;dbname=php',
    'root',
    'root'
);

if (strtolower($_SERVER['REQUEST_METHOD']) == 'get') {
    switch($_GET['act']) {
        case 'index':
        index($db);
        break;
        case 'delete':
        delete($db);
        break;
    }
} else {
    switch($_POST['act']) {
        case 'insert':
            insert($db);
            break;
    }
}


function index($db) {
    $rows = $db->run('SELECT * FROM message ORDER BY id ASC LIMIT 10');
    echo json_encode($rows);
};

function insert($db) {
    $db->insert('message', [
        'username' => $_POST['username'],
        'message' => $_POST['message'],
    ]);
    echo json_encode(array('success' => 1));
}

function delete($db) {
    $db->delete('message', [
        'id' => $_GET['id'],
    ]);
    echo json_encode(array('success' => 1));
}
