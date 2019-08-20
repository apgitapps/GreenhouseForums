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
        echo "<th>";
        echo "<a href='forumIndex.php'>";
        echo $boardTitle;
        echo "</a>";
        echo " > ";
        echo "<a href='forumSubboard.php?board=" . $boardTitle . "&subboard=";
        echo $subboardTitle . "'>";
        echo $subboardTitle;
        echo "</a>";
        echo "</th>";
        echo "</table>";
        
        echo "<br>";
        echo "<br>";

        //if logged in...
        if(isset($_SESSION['username']))
        {
            echo "<form method='POST' action='newThreadAdd.php'>";
            echo "<label>";
            echo "Thread Title: ";
            echo "</label>";
            echo "<input name='threadTitle' type='text' maxlength='50' value='' required>";
            echo "<br>";
            echo "<br>";
            echo "<textarea rows='15' cols='75' name='content' value='' required>";
            echo "</textarea>";
            echo "<input name='author' value='" . $_SESSION['username'] . "' hidden>";
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