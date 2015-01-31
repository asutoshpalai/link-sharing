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
        <title>Logout</title>
        <?php include("head.php");?>
    </head>
    <body>
        <div id="main">
        <?php
if($loged)
{
    session_destroy();
    unset($_SESSION['username']);
    ?>
        <h2>Sucessfully Logged out</h2>
        <p>Goto <a href="index.php">Home</a></p>
        <?php
    
          }
else
{
    ?>
    <h2 class="error">You are not Logged in</h2>
        <p>Goto <a href="index.php">Home</a></p>
        <?php
    
          }
?>
        </div>
    </body>
</html>