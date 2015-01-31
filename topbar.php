<?php
if(isset($_SESSION['username']))
    $loged = true;
else
    $loged = false;
?>


<div id="topbar">
    
    <span class="navspan" ><a href="index.php">Home</a></span>
    <?php 
        if($loged)
             {
            ?>
         <div id="userinfo">
            <span class="userspan">Username: <span id="username"><?php echo $_SESSION['username'];?></span></span>
                
        <span class="userspan"><a href="userpage.php">UserPage</a></span>
        <span class="userspan"><a href="logout.php">Logout</a></span>
        </div>
        
            <?php 
            }
            else {
                ?>
           
        <form class="userspan" id="frm" method="post" action="login.php" >
            <input  type="text" name="username" placeholder="username" required maxlength="20">
            <input type="password" name="password" placeholder="password" required maxlength="20">
            <input type="submit" name="submit" value="Submit" >
            </form>
        <span class="userspan" >Dont't have a ID? <a id="register" href="register.php" >Register</a></span>
            <?php
                
            }
?>
</div>