<?php
require('connection.php'); 
require('myfunction.php'); 
session_start();
if(!empty($_SESSION['user_first_name']) && !empty($_SESSION['user_last_name'])) {
    $user_first_name= $_SESSION['user_first_name'];
    $user_first_name=$_SESSION['user_last_name'];

if(isset($_GET['id'])){
    $getid = $_GET['id'];
    $sql = "SELECT * FROM store_product WHERE store_product_id=$getid";
    $query = $conn->query($sql);
    $data = mysqli_fetch_assoc($query);
    $store_product_id = $data['store_product_id'];
    $store_product_name = $data['store_product_name'];
    $store_product_quent = $data['store_product_quent'];
    $store_product_entry_date = $data['store_product_entry_date'];
} 

if(isset($_GET['store_product_name'])){
    $new_store_product_name = $_GET['store_product_name'];
    $new_store_product_quent = $_GET['store_product_quent'];
    $new_store_product_entry_date = $_GET['store_product_entry_date'];
    $new_store_product_id = $_GET['store_product_id'];

    $sql1 = "UPDATE store_product SET store_product_name='$new_store_product_name',
    store_product_quent='$new_store_product_quent',
    store_product_entry_date='$new_store_product_entry_date' WHERE store_product_id =$new_store_product_id ";
    
    if($conn->query($sql1) == TRUE){
        echo 'Update successful!';
    } else{
        echo "Error updating record".$conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>edit Store product</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
        Product:<br>
        <select name="store_product_name">
            <?php
            $sql = "SELECT * FROM product";
            $query = $conn->query($sql);

            while($data = mysqli_fetch_array($query)){
                $data_id = $data['product_id'];
                $data_name = $data['product_name'];

                echo "<option value='$data_id'";
                if(isset($store_product_name) && $store_product_name == $data_id){
                    echo "selected";
                }
                echo ">$data_name</option>";
            }  
            ?>
        </select><br><br>
       
        Product Quantity:<br>
        <input type="number" name="store_product_quent" value="<?php echo isset($store_product_quent) ? $store_product_quent : ''; ?>"><br><br>
        Store Entry Date:<br>
        <input type="date" name="store_product_entry_date" value="<?php echo isset($store_product_entry_date) ? $store_product_entry_date : ''; ?>"><br><br>
        <input type="hidden" name="store_product_id" value="<?php echo isset($store_product_id) ? $store_product_id : ''; ?>">
        <input type="submit" value="Submit">
    </form>
</body>
</html>
<?php
} else {
    header('location:login.php');
}
?>

