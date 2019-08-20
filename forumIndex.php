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
        
        $sqlBoards = "SELECT * FROM boards ORDER BY position";
        $resultBoards = $conn->query($sqlBoards);
        
        //print board...
        for($b = 0; $b < $resultBoards->num_rows; $b++)
        {
            $rowBoards = $resultBoards->fetch_assoc();
            $boardTitle = $rowBoards['title'];
            
            echo "<table>";
            echo "<th>";
            echo "<a href='forumIndex.php'>";
            echo $boardTitle;
            echo "</a>";
            echo "</th>";
            
            $sqlSubboards = "SELECT * FROM subboards WHERE parentBoard = "
                . "'$boardTitle' ORDER BY position";
            $resultSubboards = $conn->query($sqlSubboards);
           
            //print subboards inside board...
            for($sb = 0; $sb < $resultSubboards->num_rows; $sb++)
            {
                $rowSubboards = $resultSubboards->fetch_assoc();
                
                echo "<tr>";
                echo "<td>";
                echo "<a href='forumSubboard.php?board=" . $boardTitle;
                echo "&subboard=" . $rowSubboards['title'] . "'>";
                echo $rowSubboards["title"];
                echo "</a>";
                echo "<br>";
                echo $rowSubboards["description"];
                echo "</td>";
                echo "</tr>";
            }
            
            echo "</table>";
            echo "<br>";
        }
        
        echo "<br>";
        echo "<br>";
        
        $conn->close();
        ?>
        
        </div>
    </body>
</html>