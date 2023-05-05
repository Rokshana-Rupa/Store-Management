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
        <input type="submit" value="Generate Report" class="btn btn-success">
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
            echo "<table <table class='table table-success table-striped table-hover'><tr><td>Store Date</td><td>Amount<td></tr>";
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
            echo "<table <table class='table table-success table-striped table-hover'><tr><td>Spend Date</td><td>Amount<td></tr>";
            echo "<tr><td>$spend_product_entry_date</td><td>$spend_product_quent<td></tr>";
            echo "</table>";
        }
    }
    ?>
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
}
?>
