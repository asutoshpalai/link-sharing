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

if (!(isset($_POST['submit'])))
    die('Improper data');

 header('Content-Type: application/json');

$conn = new mysqli($host, $username, $password,$dbname);
if (mysqli_connect_error()) {
    die("Database connection failed: " . mysqli_connect_error());
}

error_log("here");
if($_POST['submit'] == 'delete')
{
    
    if(!isset($_POST['linkid']))
        die("Improper data");
$linkid = htmlspecialchars( $_POST['linkid']);


$sql = "DELETE FROM links WHERE linkid = {$linkid};";

if ($conn->query($sql) === true) {
    ;
} else {
    $error_message .=  "\n<br>\nError: " . $sql . "<br>" . $conn->error;
    $conti=false;
}


if($conti)
    $res['result'] = true;
else
    $res['result'] =false;

echo json_encode($res);
    
}


/* start of voting code 
*/

else if($_POST['submit'] == 'vote')
{
    
    
    if(!isset($_POST['linkid']))
        die("Improper data");
$linkid = htmlspecialchars( $_POST['linkid']);
$votes = -1;

$sql = "UPDATE links SET votes = votes +1 WHERE linkid = {$linkid};";

if ($conn->query($sql) === true) {
   ;
} else {
    $error_message .=  "\n<br>\nError: " . $sql . "<br>" . $conn->error;
    $conti=false;
}

 $sqli = "SELECT votes FROM links WHERE linkid= {$linkid};";
$result = $conn->query($sqli);

    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $res['votes'] = $row['votes'];
    }

if($conti)
    $res['result'] = true;
else
    $res['result'] =false;

echo json_encode($res);
  
    
}




?>
