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
        echo "<a href='members.php'>";
        echo "Members";
        echo "</a>";
        echo "</th>";
        
        $sqlMembers = "SELECT username, type, rank, avatar, joinDate FROM users";
        $resultMembers = $conn->query($sqlMembers);
        
        for($m = 0; $m < $resultMembers->num_rows; $m++)
        {
            $rowMembers = $resultMembers->fetch_assoc();
            
            echo "<tr>";
            echo "<td>";
            echo "<img src='" . $rowMembers['avatar'] . "' height='100' width='100'>";
            echo "</td>";
            echo "<td>";
            echo $rowMembers['username'];
            echo "</td>";
            echo "<td>";
            echo "Type: ";
            echo $rowMembers['type'];
            echo "</td>";
            echo "<td>";
            echo "Rank: ";
            echo $rowMembers['rank'];
            echo "</td>";
            echo "<td>";
            echo "Joined: ";
            echo $rowMembers['joinDate'];
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
        echo "<br>";
        echo "<br>";
        
        $conn->close();
        ?>
        
        </div>
    </body>
</html>