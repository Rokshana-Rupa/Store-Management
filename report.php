<?php
require('connection.php');
session_start();
if (!empty($_SESSION['user_first_name']) && !empty($_SESSION['user_last_name'])) {
    $user_first_name = $_SESSION['user_first_name'];
    $user_last_name = $_SESSION['user_last_name'];
    $sql3 = "SELECT * FROM product";
    $query3 = $conn->query($sql3);
    $data_list = array();
    while ($data3 = mysqli_fetch_assoc($query3)) {
        $product_id = $data3['product_id'];
        $product_name = $data3['product_name'];
        $data_list[$product_id] = $product_name;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add users</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
        select product name:
        <select name="product_name">
            <?php
            $sql = "SELECT * FROM product";
            $query = $conn->query($sql);
            while ($data = mysqli_fetch_assoc($query)) {
                $product_id = $data['product_id'];
                $product_name = $data['product_name'];
            ?>
            <option value="<?php echo $product_id; ?>"><?php echo $product_name; ?></option>
            <?php
            }
            ?>
        </select>
        <input type="submit" value="Generate Report">
    </form>
    <h1>store product</h1>
    <?php
    if (isset($_GET['product_name'])) {
        $product_name = $_GET['product_name'];
        $sql1 = "SELECT * FROM store_product WHERE store_product_name = '$product_name'";
        $query1 = $conn->query($sql1);
        while ($data1 = mysqli_fetch_array($query1)) {
            $store_product_quent = $data1['store_product_quent'];
            $store_product_name = $data1['store_product_name'];
            $store_product_entry_date = $data1['store_product_entry_date'];
            echo "<h2>" . $data_list[$store_product_name] . "</h2>";
            echo "<table border='1'><tr><td>Store Date</td><td>Amount<td></tr>";
            echo "<tr><td>$store_product_entry_date</td><td>$store_product_quent<td></tr>";
            echo "</table>";
        }
    }
    ?>
    <h1>spend product</h1>
    <?php
    if (isset($_GET['product_name'])) {
        $product_name = $_GET['product_name'];
        $sql4 = "SELECT * FROM spend_product WHERE spend_product_name = '$product_name'";
        $query4 = $conn->query($sql4);
        while ($data4 = mysqli_fetch_array($query4)) {
            $spend_product_quent = $data4['spend_product_quent'];
            $spend_product_name = $data4['spend_product_name'];
            $spend_product_entry_date = $data4['spend_product_entry_date'];
            echo "<h2>" . $data_list[$spend_product_name] . "</h2>";
            echo "<table border='1'><tr><td>Spend Date</td><td>Amount<td></tr>";
            echo "<tr><td>$spend_product_entry_date</td><td>$spend_product_quent<td></tr>";
            echo "</table>";
        }
    }
    ?>
</body>
</html>
<?php
}
?>
