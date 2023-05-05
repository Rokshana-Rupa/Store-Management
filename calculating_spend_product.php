<?php
   $hostname = 'localhost';
   $username = 'root';
   $password = '';
   $dbname = 'store_db'; 
   session_start();
   if (!empty($_SESSION['user_first_name']) && !empty($_SESSION['user_last_name'])) {
      $user_first_name = $_SESSION['user_first_name'];
      $user_last_name = $_SESSION['user_last_name'];
   }

   $conn = new mysqli($hostname, $username, $password, $dbname);
   $sql = "SELECT * FROM spend_product";
   $query = $conn->query($sql);
   $sql1 = "SELECT * FROM product";
   $query1 = $conn->query($sql1);
   $data_list = [];
   while ($data1 = $query1->fetch_assoc()) {
      $product_id = $data1['product_id'];
      $product_name = $data1['product_name'];
      $data_list[$product_id] = $product_name;
   }
?>

<html>
   <head>
      <title>Calculate Spend Product</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
   </head>
   <body>
      <div class="container bg-light">
         <div class="container_foulid border-bottom border-info">
            <!-- Top Bar -->
            <?php include('topbar.php'); ?>
         </div><!-- End of Top Bar -->
         <div class="container-foulid">
            <div class="row">
               <div class="col-sm-3 bg-light p-0 m-0"><!-- Left Bar -->
                  <?php include('leftbar.php'); ?>   
               </div><!-- End of Left Bar -->
               <div class="col-sm-9 border start border-info"><!-- Right Bar -->
                  <div class="container">
                     <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                           <table class="table table-striped">
                              <thead>
                                 <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Date</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    $sl = 0;
                                    $total = 0;
                                    while ($row = $query->fetch_array()) {
                                       $spend_product_name = $row['spend_product_name'];
                                      

              $spend_product_quent=$row['spend_product_quent'];
              $spend_product_entry_date=$row['spend_product_entry_date'];
              $sl++;
              $total +=$spend_product_quent;
          
            ?>
              <tr>
                <th scope="row"><?php echo  $spend_product_name;?></th>
                <td><?php echo  $data_list[$spend_product_name];?></td>
                <td><?php echo  $spend_product_quent;?></td>
                <td><?php echo  $spend_product_entry_date;?></td>
              </tr>
              <?php } ?>
              <tr>
              <td></td>
              <td>total</td>
              <td><?php echo $total ?></td>
              </tr>
            </tbody>
          </table>
            </div>
            <div class="col-sm-4">
            </div>
            </div>
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