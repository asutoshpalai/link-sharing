<?php 
include ("include.php");
session_start();
if(!isset($_SESSION['username']))
{
    $loged = false;
    header("Location: index.php");
    echo "Invalid Location";
    return;
}
else $loged= true;

$conti = true;
$error_message ="";

if (!((isset($_POST['submit'])) && (isset($_POST['linkid'])) ))
    die('Improper data');
$linkid = htmlspecialchars( $_POST['linkid']);

$conn = new mysqli($host, $username, $password,$dbname);
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}
$sql = "DELETE FROM links WHERE linkid = {$linkid};";
$result = $conn->query($sql);
if ($conn->query($sql) === true) {
    ;
} else {
    $error_message .=  "\n<br>\nError: " . $sql . "<br>" . $conn->error;
    $conti=false;
}



?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Link</title>
        <?php include("head.php");?>
    </head>
    <body>
        <div id="main">
         <?php       if(!$conti)
        {
            echo "<p class=\"error\" > {$error_message}</p>\n";
            echo "<p>Goto <a href=\"userpage.php\">User Page</a></p>";
            }

else {
    ?>
        <p>Link deleted sucessfully!!</p>
        <p>Goto <a href="userpage.php">UserPage</a></p>
        <?php
}
?>
        </div>
    </body>
</html>