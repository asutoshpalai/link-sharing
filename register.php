<?php  
include ("include.php");
session_start();
if(isset($_SESSION['username']))
    $loged = true;
else
    $loged = false;
?>
<html>
    <head>
        <title>Link Sharing System Registration</title>
        <?php include("head.php");?>
    </head>
    <body>
        <?php 
include("topbar.php");
?>
        <div id="main">
            <?php 
if(!isset($_POST['submit']))
{
    ?>
            <h1>Registeration</h1>
            <p>Enter your details below to get registered</p>
        <form id="reg" action="register.php" method="post">
            <label for="username">Username</label>
            <input type="text" name="username" maxlength="20"><br>
            <label for="password">Password</label>
            <input type="text" name="password" maxlength="20"><br>
            <input type="submit" name="submit" value="Submit">
            <input type="reset" >
        </form>
    <?php
}
else
{
    if (!((isset($_POST['submit'])) && (isset($_POST['username'])) && (isset($_POST['password']))  ))
    die('Improper data');
$uname =  htmlspecialchars($_POST['username']);
$pword = htmlspecialchars ($_POST['password']);

$conn = new mysqli($host, $username, $password,$dbname);
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO users (username, password ) VALUES ('{$uname}', '{$pword}' );";
    if ($conn->query($sql) === true) {
    $last_id = $conn->insert_id;
    session_start();
    $_SESSION['username'] = $uname;
    //echo "Login sucessfull";
        $conti=true;
     ?>
     <p>User <?php echo $uname?></a> added sucessfully!!</p>
        <p>Goto <a href="userpage.php">User Page</a></p>
<?php 
} else {
    $error_message .=  "\n<br>\nError: " . $sql . "<br>" . $conn->error;
    $conti=false;
         echo "<p class=\"error\" > {$error_message}</p>\n";
            echo "<p>Goto <a href=\"index.php\">Home</a></p>";
}
      
    
}

?>
            </div>
    </body>
</html>