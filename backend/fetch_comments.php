<?php
include_once '../config/Database.php';
include_once '../classes/Comment.php';

$database = new Database();
$db = $database->getConnection();

$comment = new Comment($db);

$comments = $comment->fetchComments(1);  // Fake content ID for now

foreach ($comments as $c) {
    echo "<div class='comment'>";
    echo "<p>" . htmlspecialchars($c['comment']) . "</p>";
    echo "<small>Posted on " . $c['timestamp'] . "</small>";
    echo "</div>";
}
?>