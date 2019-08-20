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
        
        echo "<table>";
        echo "<th class='threadTitleColumn'>";
        echo "<a href='forumIndex.php'>";
        echo $boardTitle;
        echo "</a>";
        echo " > ";
        echo "<a href='forumSubboard.php?board=" . $boardTitle . "&subboard=";
        echo $subboardTitle . "'>";
        echo $subboardTitle;
        echo "</a>";
        echo "</th>";
        echo "<th class='threadAuthorColumn'>";
        echo "</th>";
        echo "<th class='threadTimestampColumn'>";
        
        //if logged in...
        if(isset($_SESSION['username']))
        {
            $sqlType = "SELECT type FROM users WHERE username = '" . $_SESSION['username'] . "'";
            $resultType = $conn->query($sqlType);
            $rowType = $resultType->fetch_assoc();
            
            //medical strains board accesss
            if(((((strcmp($subboardTitle, "Listings") !== 0) && (strcmp($subboardTitle, "FAQ")) !== 0)
                && ((strcmp($rowType['type'], "Regular")) === 0 || (strcmp($rowType['type'], "Dispensary")) === 0)))
                    ||
            //marketplace board access
                (((strcmp($subboardTitle, "Listings") === 0) || (strcmp($subboardTitle, "FAQ")) === 0)
                && (strcmp($rowType['type'], "Dispensary") === 0)))
            {
                echo "<a class='newThread' ";
                echo "href='newThread.php?board=" . $boardTitle . "&subboard=";
                echo $subboardTitle . "'>";
                echo "New Thread";
                echo "</a>";
            }
        }
        
        echo "</th>";
        
        $sqlThreads = "SELECT * FROM threads WHERE parentSubboard = "
            . "'$subboardTitle' ORDER BY timestamp DESC";
        $resultThreads = $conn->query($sqlThreads);
        
        //print threads...
        for($t = 0; $t < $resultThreads->num_rows; $t++)
        {
            $rowThreads = $resultThreads->fetch_assoc();
            
            echo "<tr>";
            echo "<td>";
            echo "<a href='forumThread.php?board=" . $boardTitle . "&subboard=";
            echo $subboardTitle . "&thread=" . $rowThreads['ID'] . "'>";
            echo $rowThreads['title'];
            echo "</td>";
            echo "<td>";
            echo "Author: ";
            echo $rowThreads['author'];
            echo "</td>";
            echo "<td>";
            echo "Latest Post: ";
            echo $rowThreads['timestamp'];
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