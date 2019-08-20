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
        
        echo "<table>";
        echo "<th>";
        echo "<a href='search.php'>";
        echo "Search";
        echo "</a>";
        echo "</th>";
        echo "</table>";
        
        echo "<br>";
        echo "<br>";
        
        echo "<form method='GET' action='searchResults.php'>";
        echo "<label>";
        echo "String to search for: ";
        echo "</label>";
        echo "<input name='searchString' type='text' value='' required>";
        echo "<br>";
        echo "<br>";
        echo "<button style='display:inline-block'>";
        echo "Submit";
        echo "</button>";
        echo "</form>";
        
        echo "<br>";
        echo "<br>";
        
        $conn->close();
        ?>
        
        </div>
    </body>
</html>