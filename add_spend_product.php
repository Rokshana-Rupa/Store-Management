<?php
require('connection.php');
require('myfunction.php');
session_start();

// Alter the table
$sql = "ALTER TABLE spend_product MODIFY id INT AUTO_INCREMENT PRIMARY KEY";
$conn->query($sql);

if (!empty($_SESSION['user_first_name']) && !empty($_SESSION['user_last_name'])) {
    $user_first_name = $_SESSION['user_first_name'];
    $user_last_name = $_SESSION['user_last_name'];

    if (isset($_GET['spend_product_name'])) {
        $spend_product_name = $_GET['spend_product_name'];
        $spend_product_quent = $_GET['spend_product_quent'];
        $spend_product_entry_date = $_GET['spend_product_entry_date'];
        
        // Insert the new record into the spend_product table
        $sql = "INSERT INTO spend_product (spend_product_name, spend_product_quent, spend_product_entry_date)
                VALUES ('$spend_product_name', '$spend_product_quent', '$spend_product_entry_date')";
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Spend product</title>
    <title>add product</title>
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
      if(isset($_GET['product_name'])){
       $product_name      = $_GET['product_name'];
       $product_category  = $_GET['product_category'];
       $product_code      = $_GET['product_code'];
       $product_entry_date = $_GET['product_entry_date'];

      $sql="INSERT INTO product(product_name, product_category,product_code,product_entry_date)
      VALUES('$product_name','$product_category','$product_code','$product_entry_date')";

       if($conn->query($sql) == TRUE){
          echo 'data inserted!';

       }else{

        echo 'data is not inserted!';
       }
}
?>

<?php
  $sql="SELECT* FROM category ";
  $query=$conn->query($sql);


?>
   <form action="<?php echo $_SERVER ['PHP_SELF'];?>" method="GET">
        Product:<br>
        <select name="spend_product_name">
            <?php
            data_list('product', 'product_id', 'product_name');
            ?>
        </select><br><br>
        Spend Product Quantity:<br>
        <input type="text" name="spend_product_quent"><br><br>
        Spend Entry Date:<br>
        <input type="date" name="spend_product_entry_date"><br><br>
        <input type="submit" value="submit" class="btn btn-success">
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
</html>
<?php
} else {
    header('location:login.php');
}
?>
