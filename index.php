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
        <title>Link Sharing System</title>
        <?php include("head.php");?>
    </head>
    <body>
        <?php 
include("topbar.php");
?>
        <div id="main">
            <h1>Home</h1>
            <p>Hi and Welcome to my links sharing sites.</p>
            <p>This provides a superb interface to share and check out links from others</p>
            
        <?php
            $conn = new mysqli($host, $username, $password,$dbname);
            if (mysqli_connect_error()) {
                die("Database connection failed: " . mysqli_connect_error());
            }
            
            $sql = "SELECT linkid, link, userid, datetime, votes FROM links ORDER BY votes DESC, datetime DESC";
            $result = $conn->query($sql);
            if($result->num_rows > 0)
            {
                echo "<table id=\"links\">\n";
                echo "<tr id=\"tdes\"> <th>User</th> <th>Link</th> <th>Time</th> <th colspan=\"2\">Votes</th>\n</tr>\n";
                
                while($row = $result->fetch_assoc()) {
                    
                    $sqli = "SELECT username FROM users WHERE userid = {$row['userid']}";
                    $r = $conn->query($sqli);
                    if($r->num_rows == 0)
                        continue;
                    $ro = $r->fetch_assoc();
                    $usr = $ro['username'];
                    //echo "id: " . $row['id'] . " first name " . $row['firstname'] . " last name " . $row['lastname'] <br>;
                    ?>
            
            
                    <tr class="linktr">
                    <th class = "username"><?php echo $usr?></th><td class="link"><a href="<?php echo $row['link']?>"><?php echo $row['link']?></a></td>
                    <td class = "time"><?php echo $row['datetime']?></td><td id="v<?php echo $row['linkid']?>" class = "votes"><?php echo $row['votes']?></td><td> <button class="votebut" onclick="votelnk ('<?php echo $row['linkid']?>')">Vote</button> </td>
            </tr>
    
    
            <?php
                }
                echo "</table>";
            }
            else
                echo "<p class=\"error\">No links</p>";
            $conn->close();
        ?>
            
            </div>
        <script>
            
            
                    //start of vote code
            function votelnk (lid) {
                $.ajax({
    url : "ajaxserver.php",
    type: "POST",
    data : {
        submit:"vote",
        linkid:lid
    },
    dataType: 'json',
     success: function (data) 
{
    console.log(data);
   if(data.result == true)
   {
       console.log('#v' + lid);
       $('#v' + lid).html(data.votes);
       
   }
    else
    {
        console.log("failed");
    }
    
       
   
  },
    error: function (jqXHR, textStatus, errorThrown)
    {
        console.log("Error");
        console.log(textStatus);
         console.log(errorThrown);
        
 
    }
});
                console.log(lid);
            }
        </script>
    </body>
</html>