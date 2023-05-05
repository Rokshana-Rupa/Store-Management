<?php
require('connection.php');
session_start();
if(!empty($_SESSION['user_first_name']) && !empty($_SESSION['user_last_name'])) {
    $user_first_name = $_SESSION['user_first_name'];
    $user_last_name = $_SESSION['user_last_name'];
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM store_product WHERE store_product_id = $id";
        $query = $conn->query($sql);
        if($query) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>List of spend product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>

<body>
    <div class="container bg-light">
        <div class="container_foulid border-bottom border-success">
            <!-- topbar -->
            <?php include('topbar.php'); ?>
        </div>
        <!-- end of top bar -->
        <div class="container-foulid">
            <div class="row">
                <div class="col-sm-3 bg-light p-0 m-0">
                    <!-- left bar -->
                    <?php include('leftbar.php'); ?>
                </div>
                <!--end of left bar-->
                <div class="col-sm-9 border start border-success">
                    <!--right bar-->
                    <div class="container p-4 m-4">
                    <?php
                        $sql = "SELECT * FROM spend_product";
                        $query = $conn->query($sql);
                        echo "<table class='table table-success table-striped table-hover'><tr><th>Product Name</th><th>Quantity</th><th>Entry Date</th><th>Action</th></tr>";
                        $data_list = array();
                        $sql = "SELECT * FROM store_product";
                        $result = $conn->query($sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            $data_list[$row['store_product_id']] = $row['store_product_name'];
                        }
                        while ($data = mysqli_fetch_assoc($query)) {
                            $spend_product_id = $data['spend_product_id'];
                            $store_product_id = $data['store_product_id'];
                            $spend_product_quent = $data['spend_product_quent'];
                            $spend_product_entry_date = $data['spend_product_entry_date'];

                            echo "<tr>
                            <td>" . $data_list[$store_product_id] . "</td>
                            <td>$spend_product_quent</td>
                            <td>$spend_product_entry_date</td>
                            <td><a href='edit_spend_product.php?id=$spend_product_id' class='btn btn-success'>Edit</a></td>
                            <td>

        <td><a href='delete_store_product.php?id=$store_product_id' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a></td>
      </tr>";


    echo "</table>";

    ?>
                        </div>
                        <!--end of container-->

                    </div>
                    <!--end of right bar-->
                </div>
                <!-- end of row -->
            </div>
            <!-- end of container -->
            <div class="container_foulid">

            </div>
        </div>
        
    

</body>

</html>
<?php
} else {
    header('location:login.php');
}
?>
