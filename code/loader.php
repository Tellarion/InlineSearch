<?php

$db = new mysqli("127.0.0.1", "root", "tellariondocker", "search");

$getPosts = file_get_contents("https://jsonplaceholder.typicode.com/posts");
$getPosts = json_decode($getPosts);
$getPostsLength = 0;
$db->query('TRUNCATE posts');
for($i = 0; $i < count($getPosts); $i++) {
    $array = array((int) $getPosts[$i]->id, (int) $getPosts[$i]->userId, (string) $getPosts[$i]->title, (string) $getPosts[$i]->body);
    $idx = 0;
    foreach($array as $value) {
        if(gettype($value) == "string") {
            $array[$idx] = "'$value'";
        }
        $idx++;
    }
    $array = implode(',', $array);
    $db->query("INSERT INTO posts VALUES ({$array})");
    $getPostsLength++;
}
$getComments = file_get_contents("https://jsonplaceholder.typicode.com/comments");
$getComments = json_decode($getComments);
$getCommentsLength = 0;
$db->query('TRUNCATE comments');
for($i = 0; $i < count($getComments); $i++) {
    $array = array((int) $getComments[$i]->id, (int) $getComments[$i]->postId, (string) $getComments[$i]->name, (string) $getComments[$i]->email, (string) $getComments[$i]->body);
    $idx = 0;
    foreach($array as $value) {
        if(gettype($value) == "string") {
            $array[$idx] = "'$value'";
        }
        $idx++;
    }
    $array = implode(',', $array);
    $db->query("INSERT INTO comments VALUES ({$array})");
    $getCommentsLength++;
}
echo "Загружено {$getPostsLength} записей и {$getCommentsLength} комментариев";
?>