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
        
        $boardTitle = mysqli_real_escape_string($conn, $_GET['board']);
        $subboardTitle = mysqli_real_escape_string($conn, $_GET['subboard']);
        $threadID = (int)$_GET['thread'];
        
        $sqlThread = "SELECT title FROM threads WHERE ID = '$threadID'";
        $resultThread = $conn->query($sqlThread);
        $rowThread = $resultThread->fetch_assoc();
        
        echo "<table>";
        echo "<th class='postAuthorColumn'>";
        echo "<a href='forumIndex.php'>";
        echo $boardTitle;
        echo "</a>";
        echo " > ";
        echo "<a href='forumSubboard.php?board=" . $boardTitle . "&subboard=";
        echo $subboardTitle . "'>";
        echo $subboardTitle;
        echo "</a>";
        echo " > ";
        echo "<a href='forumThread.php?board=" . $boardTitle. "&subboard=";
        echo $subboardTitle . "&thread=" . $threadID . "'>";
        echo $rowThread['title'];
        echo "</a>";        
        echo "</th>";
        echo "<th class='postContentColumn'>";
        
        //if logged in...
        if(isset($_SESSION['username']))
        {
            echo "<a class='newPost' href='#textArea'>";
            echo "New Post";
            echo "</a>";
        }
        
        echo "</th>";
        
        $sqlPosts = "SELECT author, content FROM posts WHERE parentThread = '$threadID'";
        $resultPosts = $conn->query($sqlPosts);
        
        //print posts...
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
        
        //if logged in...
        if(isset($_SESSION['username']))
        {
            echo "<form method='POST' action='newPostAdd.php'>";
            echo "<br>";
            echo "<br>";
            echo "<label>";
            echo "Enter a new post:";
            echo "</label>";
            echo "<br>";
            echo "<br>";
            echo "<textarea id='textArea' rows='10' cols='50' name='content' value='' required>";
            echo "</textarea>";
            echo "<input name='author' value='" . $_SESSION['username'] . "' hidden>";
            echo "<input name='parentThread' value='$threadID' hidden>";
            echo "<input name='boardTitle' value='$boardTitle' hidden>";
            echo "<input name='subboardTitle' value='$subboardTitle' hidden>";
            echo "<br>";
            echo "<br>";
            echo "<button style='display:inline-block'>";
            echo "Submit";
            echo "</button>";
            echo "</form>"; 
        }
        
        echo "<br>";
        echo "<br>";
        
        $conn->close();
        ?>
        
        </div>
    </body>
</html>