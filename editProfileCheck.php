<?php
session_start();

include 'connection.php';

$inputAvatar = mysqli_real_escape_string($conn, $_POST['avatar']);
$inputPassword1 = mysqli_real_escape_string($conn, $_POST['password1']);
$inputPassword2 = mysqli_real_escape_string($conn, $_POST['password2']);
$message = "Edit successful!";

//avatar changed...
if($inputAvatar)
{
    if(!preg_match('/(\.jpg|\.png|\.bmp|\.gif)$/', $inputAvatar))
    { $message = "Edit failed!"; }
    else
    {
        $sqlNewAvatar = "UPDATE users SET avatar = '$inputAvatar' WHERE "
            . "username = '" . $_SESSION['username'] . "'";
        $resultNewAvatar = $conn->query($sqlNewAvatar);
    }
}
//password changed...
else
{
    if(strcmp($inputPassword1, $inputPassword2))
    { $message = "Edit failed!"; }
    else
    {
        $sqlNewPassword = "UPDATE users SET password = '$inputPassword1' WHERE "
            . "username = '" . $_SESSION['username'] . "'";
        $resultNewPassword = $conn->query($sqlNewPassword);
    }
}

$_SESSION['message'] = $message;
isset($_SESSION['message']);

header("location: editProfile.php");
exit;

$conn->close();
?>