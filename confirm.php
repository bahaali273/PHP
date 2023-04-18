<?php include "header.php"; ?>
<?php
$con= new mysqli("localhost","root","","res");
//add to bill table
$st1=$con->prepare("insert into bill(email)values(?)");
$st1->bind_param("s",$_SESSION["email"]);
$st1->execute();
// get the last bill no
$st2=$con->prepare("select max(bell_no) as bno from bill where email=?");
$st2->bind_param("s",$_SESSION["email"]);
$st2->execute();
$rs2=$st2->get_result();
$row2=$rs2->fetch_assoc();
//get the cart items

$st3=$con->prepare("select* from cart where email=?");
$st3->bind_param("s",$_SESSION["email"]);
$st3->execute();
$rs3=$st3->get_result();

while ($row3=$rs3->fetch_assoc())
{
    //save into bill details
    $st4=$con->prepare("insert into bill_det values (?,?,?)");
    $st4->bind_param("iii",$row2["bno"],$row3["itemid"],$row3["qty"]);
    $st4->execute();
}
    $st5=$con->prepare("delete from cart where email=?");
    $st5->bind_param("s",$_SESSION["email"]);
    $st5->execute();
    echo "<center><h2>Thank you, we have resrved your order</h2>";
?>

      <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

  <!-- Identify your business so that you can collect the payments. -->
  <input type="hidden" name="business" value="b-dhoyazan2003@gmail.com">

  <!-- Specify a Buy Now button. -->
  <input type="hidden" name="cmd" value="_xclick">

  <!-- Specify details about the item that buyers will purchase. -->
  <input type="hidden" name="item_name" value="Meals">
  <input type="hidden" name="amount" value="<?php echo $_SESSION["total"]; ?>">
  <input type="hidden" name="currency_code" value="USD">

  <!-- Display the payment button. -->
  <input type="image" name="submit" border="0"
  src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png"
  alt="Buy Now">
  <img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

</form>

<?php include "footer.php"; ?>
