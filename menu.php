<?php include "header.php"; ?>


<div class="container-fluid text-center">
    <div class="row">
        
        <div class="col-sm-2">
            <ul id="side_menu">
            <?php   
       $con=new mysqli("localhost","root","","offers");
       $st=$con->prepare("select distinct category from items");
       $st->execute();
       $rs=$st->get_result();
       while($row=$rs->fetch_assoc())
       {
           echo '<li><a href="?cat='.$row["category"].'">'.$row["category"].'</a></li>';
       }
       
            ?>
            </ul>
            
        </div>
        <?php
        $cat="Pizza";
        if(isset($_GET["cat"]))
           $cat=$_GET["cat"]; 
         $con=new mysqli("localhost","root","","offers");
       $st=$con->prepare("select * from items where category =?");
       $st->bind_param("s",$cat);
       $st->execute();
       $rs=$st->get_result();
           while($row=$rs->fetch_assoc())
       {
           echo '        <div class="col-sm-1">
            <div class="thumbnail">
                <img src="images/'.$row["photo"].'"
                     height="200px"width="200px"/>
                <p>'.$row["name"].'</p>
                <p>'.$row["price"].'</p>
                <a href="add_item.php?itemid='.$row["id"].'">Add</a>
            </div>
            
            
        </div>';
       }
        
        ?>
        <div class="col-sm-6">
            <table border="1" width="100%">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Sub Total</th>
                    <th>Delete</th>
                </tr>
                <?php 
                         $con=new mysqli("localhost","root","","offers");
             $st=$con->prepare("select id,name,price,qty from items inner join cart on items.id=cart.itemid where email=?");
             $st->bind_param("s",$_SESSION["email"]);
             $st->execute();
             $rs=$st->get_result();
             $total=0;
             while ($row=$rs->fetch_assoc())
             {
                 echo "<tr>";
                 echo "<td>".$row["name"]."</td>";
                 echo "<td>".$row["price"]."</td>";
                 echo "<td>".$row["qty"]."</td>";
                 echo "<td>".$row["qty"]*$row["price"]."</td>";
                 echo"<td><a href='delete_item.php?itemid=".$row["id"]."'><img src='images/delete.png' height='16px' width='16px'/></a></td>";
                 $total+=$row["qty"]*$row["price"];
             }
                ?>
            </table>
            <h3><?php echo $total;
                    $_SESSION["total"]=$total;
                    ?></h3>
            <form action="confirm.php"method="post">
                <input type="submit"value="Confirm Order"class="btn btn-danger"/>
            </form>
        </div>
        
        
        
        
    </div>
    
</div>
<?php include "footer.php"; ?>

