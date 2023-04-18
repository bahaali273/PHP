  <?php
  session_start();
  $con=new mysqli("localhost","root","","res");
  $st=$con->prepare("delete from cart where email=? and itemid=?");
  $st->bind_param("si", $_SESSION["email"],$_GET["itemid"]);
  $st->execute();

echo "<script>window.location='menu.php';</script>";
