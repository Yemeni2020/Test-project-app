<?php
include_once '../config/Database.php';
include_once '../classes/Comment.php';

$database = new Database();
$db = $database->getConnection();

$comment = new Comment($db);

$comment->user_id = 1;  // Fake user ID for now
$comment->content_id = 1;  // Fake content ID for now
$comment->comment = $_POST['comment'];
$comment->timestamp = date('Y-m-d H:i:s');

if ($comment->create()) {
    echo "Comment posted successfully.";
} else {
    echo "Unable to post comment.";
}
?>