<?php
session_start();

include 'connection.php';

$boardTitle = mysqli_real_escape_string($conn, $_POST['boardTitle']);
$subboardTitle = mysqli_real_escape_string($conn, $_POST['subboardTitle']);
$inputContent = mysqli_real_escape_string($conn, $_POST['content']);
$author = $_POST['author'];
$parentThreadID = (int)$_POST['parentThread'];

$sqlNewPost = "INSERT INTO posts (content, author, timestamp, parentThread) "
    . "VALUES ('$inputContent', '$author', NOW(), '$parentThreadID')";
$resultNewPost = $conn->query($sqlNewPost);

$sqlThreadTime = "UPDATE threads SET timestamp = NOW() WHERE ID = $parentThreadID";
$resultThreadTime = $conn->query($sqlThreadTime);

header("location: forumThread.php?board=" . $boardTitle . "&subboard="
    . $subboardTitle . "&thread=" . $parentThreadID);
exit;

$conn->close();
?>