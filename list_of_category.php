<?php
   require('connection.php');
   session_start();
   if(!empty($_SESSION['user_first_name']) && !empty($_SESSION['user_last_name'])) {
    $user_first_name= $_SESSION['user_first_name'];
    $user_last_name= $_SESSION['user_last_name'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>list of category</title>
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
$sql="SELECT* FROM category";
$query =$conn->query($sql);
echo"<table class='table table-success table-striped table-hover'><tr><th>Category</th><th>Date</th><th>Action</th></tr>";
  while($data=mysqli_fetch_assoc($query)){
        $category_id=$data['category_id'];
        $category_name=$data['category_name'];
        $category_entrydate=$data['category_entrydate'];
echo "<tr>
        <td>$category_name</td>
       <td>$category_entrydate</td>
       <td><a href='edit_category.php?id=$category_id' class='btn btn-success'>Edit</a></td>
       <td><a href='#' class='btn btn-danger'>delete</a>
       </td>
</tr>";
}
echo "</table>";

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
} else {
    header('location:login.php');
}
?>