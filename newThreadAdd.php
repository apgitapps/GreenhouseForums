<?php
session_start();

include 'connection.php';

$boardTitle = mysqli_real_escape_string($conn, $_POST['boardTitle']);
$subboardTitle = mysqli_real_escape_string($conn, $_POST['subboardTitle']);
$inputThreadTitle = mysqli_real_escape_string($conn, $_POST['threadTitle']);
$author = $_POST['author'];
$inputContent = mysqli_real_escape_string($conn, $_POST['content']);

$sqlNewThread = "INSERT INTO threads (title, parentSubboard, timestamp, author) "
    . "VALUES ('$inputThreadTitle', '$subboardTitle', NOW(), '$author')";
$resultNewThread = $conn->query($sqlNewThread);
$threadID = (int)$conn->insert_id;

$sqlNewPost = "INSERT INTO posts (content, author, timestamp, parentThread) "
    . "VALUES ('$inputContent', '$author', NOW(), '$threadID')";
$resultNewPost = $conn->query($sqlNewPost);

header("location: forumThread.php?board=" . $boardTitle. "&subboard="
    . $subboardTitle . "&thread=" . $threadID);
exit;

$conn->close();
?>