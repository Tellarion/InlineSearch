<?php

    $db = new mysqli("mysql", "web", "112233", "search");
    
    $_POST = json_decode(file_get_contents("php://input"), true);
    $name = $_POST['name'];

    $res = $db->query("SELECT p.*, c.*, p.body pb FROM comments as c INNER JOIN posts as p ON p.id = c.postId WHERE c.body LIKE '%{$name}%'");
    $array = array();
    while($list = $res->fetch_assoc()) {
        array_push($array, json_encode($list));
    }
    echo json_encode($array);
?>