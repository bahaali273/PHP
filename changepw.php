<?php include "header.php"; ?>

<center>
    <form action="changepw.php" method="post">
       
        <input type="password" name="old_password" placeholder="Old Password"
               class="form-control" style="width:35%"/><br/>
        <input type="password" name="new_password" placeholder="New Password"
               class="form-control" style="width:35%"/><br/>
        <input type="password" name="con_password" placeholder="Confirm Password"
               class="form-control" style="width:35%"/><br/>
       
        <input type="submit" name="s" value="Change"
               class="btn btn-danger"/>
        
    </form>
    
</center>

<?php 

   if(isset($_POST["s"])) 
   {
       $con=new mysqli("localhost","root","","res");
       $st=$con->prepare("select * from users where email=? and password=?");
       $st->bind_param("ss", $_SESSION["email"],$_POST["old_password"]);
       $st->execute();
       $rs=$st->get_result();
       if($rs->num_rows==0)
           echo "<script>alert('Wrong Old Password');</script>";
       else
       {
           if($_POST["new_password"]==$_POST["con_password"])
           {
               $st=$con->prepare("update users set password=? where email=?");
               $st->bind_param("ss", $_POST["new_password"],$_SESSION["email"]);
               $st->execute();
               echo "<script>window.location='login.php'</script>";
           }
       }
   }

?>


<?php include "footer.php"; ?>





