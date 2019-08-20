<?php
echo "<a class='headerLink' ";
echo "href='forumIndex.php'>";
echo "<div class='header'>";
echo "Greenhouse Forums";
echo "</div>";
echo "<div class='navbar'>";
echo "</a>";
echo "<a href='search.php'>";
echo "Search";
echo "</a>";
echo "&emsp;";
echo "<a href='members.php'>";
echo "Members";
echo "</a>";
echo "&emsp;";

//logged in...
if(isset($_SESSION['username']))
{
    echo "<a href='editProfile.php'>";
    echo "Edit Profile";
    echo "</a>";
    echo "&emsp;";
    echo "Logged in as: " . $_SESSION['username'];
    echo "&emsp;";
    echo "<a href='logout.php'>";
    echo "Logout";
    echo "</a>";
}
//not logged in...
else
{
    echo "<a href='register.php'>";
    echo "Register";
    echo "</a>";
    echo "&emsp;";
    echo "<a href='login.php'>";
    echo "Login";
    echo "</a>";
}

echo "</div>";

echo "<br>";
echo "<br>";
?>