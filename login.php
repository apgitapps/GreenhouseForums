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
        
        <?php include 'navbar.php'; ?>
            
        <table>
            <th>
                <a href='login.php'>
                    Login
                </a>
            </th>
        </table>
            
        <br>
        <br>
        
        <form method='GET' action='loginCheck.php'>
            <label>
                Username: 
                <input type='text' maxlength='20' name='username' value='' required>
            </label>
            
            <br>
            <br>
            
            <label>
                Password: 
                <input name='password' type='password' maxlength='20' value='' required>
            </label>
            
            <br>
            <br>
            
            <button style='display:inline-block'>
                Login
            </button>
        </form>
        
        <br>
        <br>
        
        </div>
        
        <?php
        if(isset($_SESSION['message']))
        { 
            echo "<script>";
            echo "alert('" . $_SESSION['message'] . "')";
            echo "</script>";
            unset($_SESSION['message']); 
        }
        ?>
        
    </body>
</html>