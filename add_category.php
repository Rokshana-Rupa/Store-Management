<?php
   $hostname = 'localhost';
   $username = 'root';
   $password = '';
   $dbname = 'store_db';

   $conn = new mysqli($hostname, $username, $password, $dbname);
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }

   session_start();
   if (!empty($_SESSION['user_first_name']) && !empty($_SESSION['user_last_name'])) {
       $user_first_name = $_SESSION['user_first_name'];
       $user_last_name = $_SESSION['user_last_name'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>add Category</title>
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
                    if (isset($_GET['category_name'])) {
                        $category_name = $_GET['category_name'];
                        $category_entrydate = $_GET['category_entrydate'];

                        $sql = "INSERT INTO category (category_name,category_entrydate) VALUES('$category_name', '$category_entrydate')";

                        if ($conn->query($sql) === TRUE) {
                            echo 'Data inserted successfully!';
                        } else {
                            echo 'Error inserting data: ' . $conn->error;
                        }
                    }
                    ?>

                    <form action="add_category.php" method="GET">
                        category:<br>
                        <input type="text" name="category_name"><br><br>
                        category entry date:<br>
                        <input type="date" name="category_entrydate"><br><br>
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
</html>
<?php
} else {
    header('Location: login.php');
    exit();
}
?>
