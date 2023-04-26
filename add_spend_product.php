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
</head>
<body>
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
        <input type="submit" value="submit">
    </form>
</body>
</html>
<?php
} else {
    header('location:login.php');
}
?>
