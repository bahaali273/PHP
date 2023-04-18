<?php include './header.php';?>
<center>
<form action="save_photo.php" method="post"
    enctype="multipart/form-data">
         
    Select a photo
    
    
    <input type="file"name="photo"/>
    <input type="submit" value="Upload"
           class="btn-danger"/>
</form>
</center>
<?php include './footer.php';?>

