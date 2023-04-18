<?php include "header.php"; ?>


<center>
    <form action="signup.php" method="post">
        
        <input type="email" name="email" placeholder="E-Mail"
               class="form-control" style="width:35%" required /><br/>
        <input type="password" name="password" placeholder="Password"
               class="form-control" style="width:35%" required /><br/>
        <input type="password" name="confirm" placeholder="Confirm"
               class="form-control" style="width:35%" required /><br/>
        <input type="text" name="name" placeholder="Name"
               class="form-control" style="width:35%" required/><br/>
        <input type="number" name="phone" placeholder="Phone"
               class="form-control" style="width:35%" required/><br/>
        <input type="submit" name="s" value="Sign Up"
               class="btn btn-danger"/>
        
    </form>
    
</center>

<?php 

    if(isset($_POST["s"]))
    {
        if($_POST["password"]==$_POST["confirm"])
        {
            $con=new mysqli("localhost","root","","res");
            $st=$con->prepare("select email from users where email=?");
            $st->bind_param("s", $_POST["email"]);
            $st->execute();
            $rs=$st->get_result();
            if($rs->num_rows>0)
                echo "<script>alert('E-Mail Exist');</script>";
            else {
                
            $st=$con->prepare("insert into users(email,password,name,mobile) values(?,?,?,?)");
            $st->bind_param("ssss", $_POST["email"],$_POST["password"],
                    $_POST["name"],$_POST["phone"]);
            $st->execute();
            $_SESSION["email"]=$_POST["email"];
            echo "<script>window.location='menu.php';</script>"; 
            }
            
        }
        else
           echo "<script>alert('Password Not Match');</script>"; 
    }
    
?>


<?php include "footer.php"; ?>












