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
?>


<html>
    <head>
        <title>Your userpage... <?php echo $_SESSION['username']?></title>
        <?php include("head.php");?>
    </head>
    <body>
        <?php include("topbar.php") ?>
         <div id="main">
             
             <h1>User Page</h1>
            <p>Welcome <span id="username"><?php echo $_SESSION['username'];?></span></p><br><br>
             
             <div>
                 <form id="addlink" >
                     <label for="link">Insert Link</label>
                     <input type="text" id="linktoadd" name="link" maxlength="200" required>
                     <input type="submit" name="submit" value="Insert">
                     <input type="reset" id="reset">
                 </form>
                 <div class="error" id="linkerror"></div>
             </div>
             <br><br>
            <p>Your links are:</p>
            
            
        <?php
            $conn = new mysqli($host, $username, $password,$dbname);
            if (mysqli_connect_error()) {
                die("Database connection failed: " . mysqli_connect_error());
            }
            $conn = new mysqli($host, $username, $password,$dbname);
            if (mysqli_connect_error()) {
                die("Database connection failed: " . mysqli_connect_error());
            }
$sqli = "SELECT userid FROM users WHERE username = '{$_SESSION['username']}'";
$result= $conn->query($sqli);
$row = $result->fetch_assoc();
$uid = $row['userid'];

            $sql = "SELECT linkid, link, userid, datetime, votes FROM links where userid='{$uid}' order by votes desc,  datetime desc";
            $result = $conn->query($sql);
            if($result->num_rows > 0)
            {
                echo "<table id=\"links\">\n";
                echo "<tr id=\"tdes\"> <th>Link</th>\n<th>Entry date</th>\n<th>Votes</th>\n<th>Delete</th>\n</tr>\n";
                
                while($row = $result->fetch_assoc()) {
                    
                    ?>
                    <tr class="linktr" id="<?php echo $row['linkid']?>">
                   <td class="link"><a href="<?php echo $row['link'] ?>"><?php echo $row['link']?></a></td>
                    <td class = "time"><?php echo $row['datetime']?></td>
                        <td class = "votes"><?php echo $row['votes']?></td>
                        <td class="delclass"> <button class="delbut" onclick="dellnk ('<?php echo $row['linkid']?>')">Delete</button></td>
                    </tr>
             <?php
                }
                echo "</table>";
            }
            else
                echo "<p class=\"error\">No links</p>";
            
        ?>
             
        </div>
        <script>
            
            $('#reset').click(function () {
                $('#linkerror').html('');
        $('#linktoadd').val(''); }
                             );
            
            
            //for new link submission
            $("#addlink").submit(function(event ){
                
                  var d = {
                    link: $('#linktoadd').val(),
submit: "submit"
                }
                  console.log(d);
                $.ajax({
    url : "addlinkajax.php",
    type: "POST",
    data : d,
    dataType: 'json',
     success: function (data) 
{
    if(data.hasOwnProperty('error'))
    {
        $('#linkerror').html(data.error);
    }
    else {
    var str = '  <tr class="linktr"> \
                   <td class="link"><a href="' + data['link']  + '">' + data['link']+ '</a></td> \
                    <td class = "time">' + data['datetime'] + '</td> \
<td class = "votes">'+ data['votes'] + ' </td>\
 <td class="delclass"> <button class="delbut" onclick="dellnk (\''+ data['linkid'] + '\')">Delete</button></td> \
                    </tr>';
    $('#tdes').after(str);
        $('#linkerror').html('');
        $('#linktoadd').val('');
    }
   
  },
    error: function (jqXHR, textStatus, errorThrown)
    {
        console.log("Error");
        console.log(textStatus);
         console.log(errorThrown);
        
 
    }
});
                 event.preventDefault();
});
            //end of add link code
            
            
            
            
            
            //start of delete code
            function dellnk (lid) {
                $.ajax({
    url : "ajaxserver.php",
    type: "POST",
    data : {
        submit:"delete",
        linkid:lid},
    dataType: 'json',
     success: function (data) 
{
    console.log(data);
   if(data.result == true)
   {
       $('#' + lid).remove();
       
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