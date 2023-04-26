<?php
require('connection.php'); 
require('myfunction.php'); 
session_start();
if(!empty($_SESSION['user_first_name']) && !empty($_SESSION['user_last_name'])) {
    $user_first_name= $_SESSION['user_first_name'];
    $user_first_name=$_SESSION['user_last_name'];


if(isset($_GET['id'])){
    $getid = $_GET['id'];
    $sql = "SELECT * FROM spend_product WHERE spend_product_id=$getid";
    $query = $conn->query($sql);
    $data = mysqli_fetch_assoc($query);
    $spend_product_id = $data['spend_product_id'];
    $spend_product_name = $data['spend_product_name'];
    $spend_product_quent = $data['spend_product_quent'];
    $spend_product_entry_date = $data['spend_product_entry_date'];
} 

if(isset($_GET['spend_product_name'])){
    $new_spend_product_name = $_GET['spend_product_name'];
    $new_spend_product_quent = $_GET['spend_product_quent'];
    $new_spend_product_entry_date = $_GET['spend_product_entry_date'];
    $new_spend_product_id = $_GET['spend_product_id'];

    $stmt = $conn->prepare("UPDATE spend_product SET spend_product_name=?, spend_product_quent=?, spend_product_entry_date=? WHERE spend_product_id=?");
    $stmt->bind_param("sisi", $new_spend_product_name, $new_spend_product_quent, $new_spend_product_entry_date, $new_spend_product_id);

    if($stmt->execute()){
        echo 'Update successful!';
    } else{
        echo "Error updating record: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit spend product</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
        Product:<br>
        <select name="spend_product_name">
            <?php
            $sql = "SELECT * FROM product";
            $query = $conn->query($sql);

            while($data = mysqli_fetch_array($query)){
                $data_id = $data['product_id'];
                $data_name = $data['product_name'];

                echo "<option value='$data_id'";
                if(isset($spend_product_name) && $spend_product_name == $data_id){
                    echo "selected";
                }
                echo ">$data_name</option>";
            }  
            ?>
        </select><br><br>
       
        Product Quantity:<br>
        <input type="number" name="spend_product_quent" value="<?php echo isset($spend_product_quent) ? $spend_product_quent : ''; ?>"><br><br>
        Store Entry Date:<br>
        <input type="date" name="spend_product_entry_date" value="<?php echo isset($spend_product_entry_date) ? $spend_product_entry_date : ''; ?>"><br><br>
        <input type="hidden" name="spend_product_id" value="<?php echo isset($spend_product_id) ? $spend_product_id : ''; ?>">
        <input type="submit" value="Submit">
    </form>
</body>
</html>
<?php
} else {
    header('location:login.php');
}
?>
