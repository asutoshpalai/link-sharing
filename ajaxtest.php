<?php  /*
include ("include.php");
session_start();
if(isset($_SESSION['username']))
    $loged = true;
else
    $loged = false; */
?> 
<html>
    <head>
        <title>Ajax TEST</title>
        <?php include("head.php");?>
        <script src="jquery-1.11.2.js" type="text/javascript"></script>
        <script>
            function addlink(){
                    var d = {
                    link:"www.about.me",
submit: "submit"
                }
                $.ajax({
    url : "ajaxserver.php",
    type: "POST",
    data : d,
    dataType: 'json',
     success: function (data) 
{
    $('#main').html(data);
    console.log(data);
  },
    error: function (jqXHR, textStatus, errorThrown)
    {
 
    }
});
            }
                addlink();
                
        </script>
    </head>
    <body>
        <?php 
include("topbar.php");
?>
        <div id="main">
            <h1>Home</h1>
            <p>Hi and Welcome to my links sharing sites.</p>
            <p>This provides a superb interface to share and check out links from others</p>
            
        <?php /*
            $conn = new mysqli($host, $username, $password,$dbname);
            if (mysqli_connect_error()) {
                die("Database connection failed: " . mysqli_connect_error());
            }
            
            $sql = "SELECT link, userid, datetime FROM links ORDER BY datetime DESC";
            $result = $conn->query($sql);
            if($result->num_rows > 0)
            {
                echo "<table id=\"links\">\n";
                echo "<tr id=\"tdes\"> <th>User</th> <th>Link</th> <th>Time</th>\n</tr>\n";
                
                while($row = $result->fetch_assoc()) {
                    
                    $sqli = "SELECT username FROM users WHERE userid = {$row['userid']}";
                    $r = $conn->query($sqli);
                    if($r->num_rows == 0)
                        continue;
                    $ro = $r->fetch_assoc();
                    $usr = $ro['username'];
                    //echo "id: " . $row['id'] . " first name " . $row['firstname'] . " last name " . $row['lastname'] <br>;
                    echo "<tr class=\"linktr\">\n";
                    echo "<th class = \"username\">{$usr}</th><td class=\"link\"><a href=\"{$row['link']}\">{$row['link']}</a></td>
                    <td class = \"time\">{$row['datetime']}</td> \n</tr>\n";
                }
                echo "</table>";
            }
            else
                echo "<p class=\"error\">No links</p>";
            $conn->close();
        */?>
            
            </div> 
           
    </body>
</html>