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
        
        $searchString = mysqli_real_escape_string($conn, $_GET['searchString']);

        echo "<table>";
        echo "<th class='postAuthorColumn'>";
        echo "<a href='search.php'>";
        echo "Search";
        echo "</a>";
        echo "</th>";
        echo "<th class='postContentColumn'>";
        echo "</th>";
        
        $sqlPosts = "SELECT author, content FROM posts WHERE content LIKE '$searchString'";
        $resultPosts = $conn->query($sqlPosts);
        
        for($p = 0; $p < $resultPosts->num_rows; $p++)
        {
            $rowPosts = $resultPosts->fetch_assoc();
            
            $sqlAuthor = "SELECT avatar, type, rank, joinDate FROM users WHERE "
                . "username = '" . $rowPosts['author'] . "'";
            $resultAuthor = $conn->query($sqlAuthor);
            $rowAuthor = $resultAuthor->fetch_assoc();
            
            echo "<tr>";
            echo "<td class='postAuthorData'>";
            echo $rowPosts['author'];
            echo "<br>";
            echo "<img src='" . $rowAuthor['avatar'] . "' height='100' width='100'>";
            echo "<br>";
            echo "Type: ";
            echo $rowAuthor['type'];
            echo "<br>";
            echo "Rank: ";
            echo $rowAuthor['rank'];
            echo "<br>";
            echo "Joined: ";
            echo $rowAuthor['joinDate'];
            echo "</td>";
            echo "<td class='postContentData'>";
            echo nl2br($rowPosts['content']);
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
        if($resultPosts->num_rows === 0)
        {
            echo "<br>";
            echo "<br>";
            echo "<label>";
            echo "There are no posts containing the string.";
            echo "</label>";
        }
        
        echo "<br>";
        echo "<br>";
        
        $conn->close();
        ?>
        
        </div>
    </body>
</html>