<?php include "header.php"; ?>


<center>
    <form action="login.php" method="post">
        
        <input type="email" name="email" placeholder="E-Mail"
               class="form-control" style="width:35%" /><br/>
        <input type="password" name="password" placeholder="Password"
               class="form-control" style="width:35%"/><br/>
       
        <input type="submit" name="s" value="Login"
               class="btn btn-danger"/>
        
    </form>
    
</center>

<?php 

    if(isset($_POST["s"]))
    {
         $con=new mysqli("localhost","root","","res");
         $st=$con->prepare("select email from users where email=? and password=?");
         $st->bind_param("ss", $_POST["email"],$_POST["password"]);
         $st->execute();
         $rs=$st->get_result();
         if($rs->num_rows==0)
             echo "<script>alert('Login Fail');</script>";
         else
         {
             $_SESSION["email"]=$_POST["email"];
             echo "<script>window.location='menu.php';</script>"; 
         }
    }

?>

<?php include "footer.php"; ?>



