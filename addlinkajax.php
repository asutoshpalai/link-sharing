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
 header('Content-Type: application/json');

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



       if(!$conti)
        {
           if(strpos($error_message,'Duplicate') !== false)
               $error_message = 'Duplicate entry';
            $ret['error'] = $error_message;
    echo json_encode($ret);
            }
            
else {
    $sql = "SELECT linkid, link, datetime, votes FROM links where linkid='{$last_id}'";
            $result = $conn->query($sql);
            if($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
                $res['linkid'] =  $row['linkid'];
                $res['link'] =  $row['link'];
                $res['datetime'] =  $row['datetime'];
                $res['votes'] = $row['votes'];
                echo json_encode($res);
                
            }
    }


?>
