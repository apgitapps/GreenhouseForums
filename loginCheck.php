<?php
session_start();

include 'connection.php';

$inputUsername = mysqli_real_escape_string($conn, $_GET['username']);
$inputPassword = mysqli_real_escape_string($conn, $_GET['password']);

$sqlLogin = "SELECT username, password FROM users WHERE "
. "username = '$inputUsername' AND password = '$inputPassword'";
$resultLogin = $conn->query($sqlLogin);
$rowLogin = $resultLogin->fetch_assoc();

if($rowLogin)
{ 
    $_SESSION['username'] = $rowLogin['username'];
    isset($_SESSION['username']);
    header("location: forumIndex.php");
    exit;
}
else
{
    $_SESSION['message'] = "Login failed!";
    isset($_SESSION['message']);
    header("location: login.php");
    exit;
}

$conn->close();
?>