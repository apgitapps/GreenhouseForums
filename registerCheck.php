<?php
session_start();

include 'connection.php';

$inputUsername = mysqli_real_escape_string($conn, $_POST['username']);
$inputPassword1 = mysqli_real_escape_string($conn, $_POST['password1']);
$inputPassword2 = mysqli_real_escape_string($conn, $_POST['password2']);
$inputMedCardID = mysqli_real_escape_string($conn, $_POST['medCardID']);
$inputBizLicenseID = mysqli_real_escape_string($conn, $_POST['bizLicenseID']);
$type = "Regular"; //regular until otherwise set
$message = "Registration successful!"; //successful until otherwise set

if(!empty($inputBizLicenseID))
{ $type = "Dispensary"; }

$message = checkErrors($conn, $inputUsername, $inputPassword1,
    $inputPassword2, $inputMedCardID, $inputBizLicenseID, $type, $message);

$_SESSION['message'] = $message;
isset($_SESSION['message']);

//errors found...
if(strcmp($message, "Registration failed!") === 0)
{
    header("location: register.php");
    exit;
}
//no errors found...
else
{
    //insert into database...
    $sqlNewUser = "INSERT INTO users (username, password, type, rank, avatar, "
        . "medCardID, bizLicenseID, joinDate) VALUES ('$inputUsername', "
        . "'$inputPassword1', '$type', 'Newbie', 'https://i.imgur.com/EeiaRhm.png', "
        . "'$inputMedCardID', NULLIF('$inputBizLicenseID',''), NOW())";
    $resultNewUser = $conn->query($sqlNewUser);

    header("location: login.php");
    exit; 
}

function checkErrors($conn, $inputUsername, $inputPassword1, 
    $inputPassword2, $inputMedCardID, $inputBizLicenseID, $type, $message)
{
    // --- username already exists in database...
    $sqlDupeUser = "SELECT username FROM users WHERE username = "
        . "'$inputUsername'";
    $resultDupeUser = $conn->query($sqlDupeUser);
    $rowDupeUser = $resultDupeUser->fetch_assoc();

    if($rowDupeUser)
    { return "Registration failed!"; }

    // --- passwords are not equal...
    if(strcmp($inputPassword1, $inputPassword2))
    { return "Registration failed!"; }

    // --- medical card id already exists in database...
    $sqlDupeMedID = "SELECT medCardID FROM users WHERE medCardID = "
        . "'$inputMedCardID'";
    $resultDupeMedID = $conn->query($sqlDupeMedID);
    $rowDupeMedID = $resultDupeMedID->fetch_assoc();

    if($rowDupeMedID)
    { return "Registration failed!"; }

    // --- invalid medical card...
    if(!ctype_digit($inputMedCardID) || strlen($inputMedCardID) != 6)
    { return "Registration failed!"; }

    //if dispensary...
    if(!strcmp($type, "Dispensary"))
    {
        // --- business license id already exists in database...
        $sqlDupeBizID = "SELECT bizLicenseID FROM users WHERE bizLicenseID = "
            . "'$inputBizLicenseID'";
        $resultDupeBizID = $conn->query($sqlDupeBizID);
        $rowDupeBizID = $resultDupeBizID->fetch_assoc();

        if($rowDupeBizID)
        { return "Registration failed!"; }

        // --- invalid business license...
        if(!ctype_digit($inputBizLicenseID) || strlen($inputBizLicenseID) != 6)
        { return "Registration failed!"; }
    }
    
    return $message;
}

$conn->close();
?>