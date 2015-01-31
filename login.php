<?php 
include ("include.php");
$uname = "";
$pword = "";
$conti = true;
$error_message ="";

if (!((isset($_POST['submit'])) && (isset($_POST['submit'])) && (isset($_POST['submit'])) ))
    die('Improper data');
$uname =  htmlspecialchars($_POST['username']);
$pword = htmlspecialchars ($_POST['password']);

$conn = new mysqli($host, $username, $password,$dbname);
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}

$sql = "SELECT username, userid FROM users WHERE username='{$uname}';";
            $result = $conn->query($sql);
            if($result->num_rows == 0)
            {
                $conti = false;
                $error_message = "Invalid credentials";
            }
else{
$row = $result->fetch_assoc();
$uid = $row['userid'];
$sql = "SELECT password FROM users WHERE userid='{$uid}'";
            $result = $conn->query($sql);     
$row = $result->fetch_assoc();
$pass = $row['password'];

if ($pass != $pword)
{
    $conti = false;
    $error_message = "Invalid credentials";
}
    
}

if ($conti)
{
    session_start();
    $_SESSION['username'] = $uname;
    //echo "Login sucessfull";
    header ("Location: userpage.php");
}

?>

<html>
    <head>
        <title>Login Page</title>
        <?php include("head.php");?>
    </head>
    <body>
        <div id="main">
        <?php
        if(!$conti)
        {
            echo "<p class=\"error\" > {$error_message}</p>\n";
            echo "<p>Goto <a href=\"index.php\">Home</a></p>";
            }
else {
    ?>
      <p>Login Sucessful</p>
        <p>Goto <a href="userpage.php">UserPage</a></p>
        <?php
}

$conn->close();
?>
        </div> 
    </body>
</html>

