<?php
session_start();

if(!isset($_SESSION["email"]))
    echo "<script>window.location='login.php';</script>";
else
{
    $q=1;
       $con=new mysqli("localhost","root","","res");
       /*her we will do add item code */
       
        $st=$con->prepare("select * from cart where email=? and itemid=?");
         $st->bind_param("si", $_SESSION["email"],$_GET["itemid"]);
         $st->execute();
         $rs=$st->get_result();
         if($rs->num_rows==0)
         {
       $st=$con->prepare("insert into cart values(?,?,?)");
       $st->bind_param("sii",$_SESSION["email"],$q,$_GET["itemid"]);
       $st->execute();
}

else
{
    $st=$con->prepare("update cart set qty=qty+1 where email=? and itemid=?");
       $st->bind_param("si",$_SESSION["email"],$_GET["itemid"]);
       $st->execute();
}





echo "<script>window.location='menu.php';</script>";
         }      