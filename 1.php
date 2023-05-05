<?php<?php
   $hostname='localhost';
   $username='root';
   $password='';
   $dbname='store_db';

   $conn = new mysqli($hostname,$username,$password,$dbname);
   $sql="SELECT *FROM spend_product";
   $query=$conn->query($sql);
   $sql1="SELECT *FROM product";
   $query1=$conn->query($sql1);
   while($data1=$query1->fetch_assoc()){
$product_id=$data1['product_id'];
$product_name=$data1['product_name'];
$data_list[$product_id]=$product_name;

   }



   ?>
   <html>
   <head>
    
    <title>calculate spend product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   </head>
   <body>
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
  $sl=0;
  $total=0;
  while ($row=$query->fetch_array()){
    $spend_product_name=$row['spend_product_name'];
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
    
   </body>
   </html>