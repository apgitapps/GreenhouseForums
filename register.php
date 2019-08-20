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
                <a href='register.php'>
                    Register
                </a>
            </th>
        </table>
            
        <br>
        <br>
        
        <form method='POST' action='registerCheck.php'>
            <label>
                Username: 
                <input name='username' maxlength='20' value='' required>
            </label>
            
            <br>
            <br>
            
            <label>
                Password: 
                <input name='password1' maxlength='20' type='password' value='' required>
            </label>
            
            <br>
            <br>
            
            <label>
                Re-enter Password: 
                <input name='password2' maxlength='20' type='password' value='' required>
            </label>
            
            <br>
            <br>
            
            <label>
                Medical Card ID: 
                <input type='text' name='medCardID' maxlength='6' value='' required>
            </label>
            
            <br>
            <br>
            
            <label>
                Are you a Dispensary?
            </label>
            
            <input id='radioNo' type="radio" name="type" onclick="deactivate()" checked>
            <label for='radioNo'>
                No
            </label>
            
            <input id='radioYes' type="radio" name="type" onclick="activate()">
            <label for='radioYes'>
                Yes
            </label>
            
            <label id='spacer'>
            </label>
            
            <label id ='bIDlabel' hidden>Business License ID: 
                <input type='text' id='bIDinput' name='bizLicenseID' maxlength='6' value='' hidden>
            </label>
            
            <script>
                //show fields for business ID and make required...
                function activate()
                {
                    document.getElementById("bIDlabel").hidden = false;
                    document.getElementById("bIDinput").required = true;
                    document.getElementById("bIDinput").hidden = false;
                    document.getElementById("bIDinput").value = '';
                    document.getElementById("spacer").innerHTML = '<br><br>';
                }
                
                //hide fields for business ID and make unrequired...
                function deactivate()
                {                    
                    document.getElementById("bIDlabel").hidden = true;
                    document.getElementById("bIDinput").required = false;
                    document.getElementById("bIDinput").hidden = true;
                    document.getElementById("bIDinput").value = '';
                    document.getElementById("spacer").innerHTML = '';
                }
            </script>
            
            <br>
            <br>
            
            <button style='display:inline'>Register</button>
        </form>
        
        <br>
        <br>
            
        </div>
        
        <?php
        if(isset($_SESSION['message']))
        { 
            echo "<script>";
            echo "confirm('" . $_SESSION['message'] . "')";
            echo "</script>";
            unset($_SESSION['message']); 
        }
        ?>
        
    </body>
</html>