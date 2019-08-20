<!DOCTYPE html>

<html>
    <head>
        <meta charset='UTF-8'>
        <link rel='stylesheet' href='forumStyle.css'>
        
        <title>Greenhouse Forums</title>
    </head>
    
    <body>
        <?php session_start(); ?>
        
        <div align='center'>
       
        <?php
        include 'connection.php';
        include 'navbar.php';

        echo "<table class='userTable'>";
        echo "<th colspan='5'>";
        echo "<a href='editProfile.php'>";
        echo "Edit Profile";
        echo "</a>";
        echo "</th>";
        
        $sqlUser = "SELECT username, type, rank, avatar, joinDate FROM users "
            . "WHERE username = '" . $_SESSION['username'] . "'";
        $resultUser = $conn->query($sqlUser);
        $rowUser = $resultUser->fetch_assoc();
            
        echo "<tr>";
        echo "<td>";
        echo "<img src='" . $rowUser['avatar'] . "' height='100' width='100'>";
        echo "</td>";
        echo "<td>";
        echo $rowUser['username'];
        echo "</td>";
        echo "<td>";
        echo "Type: ";
        echo $rowUser['type'];
        echo "</td>";
        echo "<td>";
        echo "Rank: ";
        echo $rowUser['rank'];
        echo "</td>";
        echo "<td>";
        echo "Joined: ";
        echo $rowUser['joinDate'];
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        
        echo "<br>";
        echo "<br>";
        
        echo "<table class='editTable'>";
        echo "<tr>";
        echo "<td>";
        echo "<form method='POST' action='editProfileCheck.php'>";
        echo "<label>";
        echo "New Avatar URL: ";
        echo "</label>";
        echo "<input name='avatar' type='text' value='' required>";
        echo "<br>";
        echo "<br>";
        echo "<button style='display:inline-block'>";
        echo "Submit";
        echo "</button>";
        echo "</form>";
        echo "</td>";
        
        echo "<td>";
        echo "<form method='POST' action='editProfileCheck.php'>";
        echo "<label>";
        echo "New Password: ";
        echo "</label>";
        echo "<input name='password1' maxlength='20' type='password' value='' required>";
        echo "<br>";
        echo "<br>";
        echo "<label>";
        echo "Re-enter new Password: ";
        echo "</label>";
        echo "<input name='password2' maxlength='20' type='password' value='' required>";
        echo "<br>";
        echo "<br>";
        echo "<button style='display:inline-block'>";
        echo "Submit";
        echo "</button>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        
        echo "<br>";
        echo "<br>";
        
        if(isset($_SESSION['message']))
        { 
            echo "<script>";
            echo "alert('" . $_SESSION['message'] . "')";
            echo "</script>";
            unset($_SESSION['message']); 
        }
        
        $conn->close();
        ?>
        
        </div>
    </body>
</html>