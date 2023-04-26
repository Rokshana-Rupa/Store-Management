<?php
   require('connection.php'); 
   require('myfunction.php'); 
   session_start();
   if(!empty($_SESSION['user_first_name']) && !empty($_SESSION['user_last_name'])) {
    $user_first_name= $_SESSION['user_first_name'];
    $user_last_name= $_SESSION['user_last_name'];
   
 




?>
<!DOCTYPE html>
<html>
<head>
<title>Store product</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>
<body>
<div class="container bg-light">
    <div class="container_foulid border-bottom border-success">
        <!-- topbar -->
        <?php include('topbar.php');?>
    </div><!-- end of top bar -->
    <div class="container-foulid">
        <div class="row">
            <div class="col-sm-3 bg-light p-0 m-0"><!-- left bar -->
                <?php include('leftbar.php');?>   
            </div><!--end of left bar-->
            <div class="col-sm-9 border start border-success"><!--right bar-->
                <div class="container p-4 m-4">
                <?php
      if(isset($_GET['store_product_name'])){
       $store_product_name     = $_GET['store_product_name'];
       $store_product_quent  = $_GET['store_product_quent'];
       $store_product_entry_date     = $_GET['store_product_entry_date'];
       $sql="INSERT INTO store_product(store_product_name,store_product_quent,store_product_entry_date)
      VALUES('$store_product_name','$store_product_quent','$store_product_entry_date')";

       if($conn->query($sql) == TRUE){
          echo 'data inserted!';

       }else{

        echo 'data is not inserted!';
       }
}
?>

<?php
  


?>
    <form action="<?php echo $_SERVER ['PHP_SELF'];?>" method="GET">
        
        Product:<br>
        <select name="store_product_name">
            <?php
   data_list('product','product_id','product_name');
            
        ?>
        </select><br><br>
       
        Product Quantity:<br>
        <input type="text" name="store_product_quent"><br><br>
        store Entry Date:<br>
        <input type="date" name="store_product_entry_date"><br><br>
        <input type="submit" value="submit"class="btn btn-success">
</form>
                </div><!--end of container-->
            </div><!--end of right bar-->
        </div><!-- end of left bar-->
    </div>
    <div class="container_foulid">
        <?php include('bottombar.php');?> 
    </div>
</div><!--@end of container-->
    
</body>
</html><?php
} else {
    header('location:login.php');
}
?>
