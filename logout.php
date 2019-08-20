<?php
session_start();

unset($_SESSION['username']);

header("location: forumIndex.php");
exit;
?>