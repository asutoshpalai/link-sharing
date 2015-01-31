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

if (!((isset($_POST['submit'])) && (isset($_POST['link'])) ))
    die('Improper data');
$link = urlencode( $_POST['link']);

$conn = new mysqli($host, $username, $password,$dbname);
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}
$sql = "SELECT userid FROM users WHERE username='{$_SESSION['username']}';";
$result = $conn->query($sql);
if($result->num_rows == 0)
            {
                $conti = false;
                $error_message = "Invalid credentials";
            }
$row = $result->fetch_assoc();
$uid = $row['userid'];
$sql = "INSERT INTO links (userid, link ) VALUES ({$uid}, '{$link}' );";
if ($conn->query($sql) === true) {
    $last_id = $conn->insert_id;
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
            echo "<p>Goto <a href=\"index.php\">Home</a></p>";
            }

else {
    ?>
        <p>Link <a href="<?php echo $link?>" ><?php echo $link?></a> added sucessfully!!</p>
        <p>Goto <a href="index.php">Home</a></p>
        <?php
}
?>
        </div>
    </body>
</html>