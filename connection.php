<?php
//info for database access...
$servername = 'server.endlesss.co:20205';
$username = 'kim';
$password = 'kim';
$dbname = 'greenhouse';

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) //bad connection
{die('Connection failed: '.$conn->connect_error);}
?>