<?php
require('connection.php');
session_start();

if(!empty($_SESSION['user_first_name']) && !empty($_SESSION['user_last_name'])) {
  $user_first_name = $_SESSION['user_first_name'];
  $user_last_name = $_SESSION['user_last_name'];
  
  $product_id = "";
  $product_name = "";
  $product_category = "";
  $product_code = "";
  
  if(isset($_GET['id'])){
     $getid = $_GET['id'];

     $stmt = $conn->prepare("SELECT * FROM product WHERE product_id = ?");
     $stmt->bind_param("i", $getid);
     $stmt->execute();
     $result = $stmt->get_result();
     if($result->num_rows === 1){
        $data = $result->fetch_assoc();
     
        $product_id = $data['product_id'];
        $product_name = $data['product_name'];
        $product_category = $data['product_category'];
        $product_code = $data['product_code'];
     }
     $stmt->close();
  }

  if(isset($_GET['product_name']) && isset($_GET['product_category']) && isset($_GET['product_code'])){
     $new_product_name = $_GET['product_name'];
     $new_product_category = $_GET['product_category'];
     $new_product_code = $_GET['product_code'];
     $new_product_id = $_GET['product_id'];
     
     $stmt = $conn->prepare("UPDATE product SET product_name = ?, product_category = ?, product_code = ? WHERE product_id = ?");
     
     if(!$stmt) {
        echo "Error: " . $conn->error;
        exit();
     }
     
     $stmt->bind_param("sssi", $new_product_name, $new_product_category, $new_product_code, $new_product_id);
     
     if($stmt->execute()){
        echo 'Update successful!';
     } else{
        echo 'Error updating record: '.$stmt->error;
     }
     $stmt->close();
  }
  
  // Get all categories
  $category_stmt = $conn->prepare("SELECT category_name FROM category");
  $category_stmt->execute();
  $category_result = $category_stmt->get_result();
  $category_list = array();
  while($category_row = $category_result->fetch_assoc()){
    array_push($category_list, $category_row['category_name']);
  }
  $category_stmt->close();
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Edit Product</title>
   </head>
   <body>
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET">
         Product Name:<br>
         <input type="text" name="product_name" value="<?php if(!empty($product_name)) echo htmlspecialchars($product_name);?>"><br><br>
         Category:<br>
         <select name="product_category">
         <?php foreach($category_list as $category){ ?>
          <option value="<?php echo $category; ?>" <?php if($product_category === $category) echo 'selected'; ?>><?php echo $category; ?></option>
         <?php } ?>
         </select>
         <br><br>
         Product Code:<br>
         <input type="text" name="product_code" value="<?php if(!empty($product_code)) echo htmlspecialchars($product_code);?>"><br><br>
         <input type="text" name="product_id" value="<?php if(!empty($product_id)) echo htmlspecialchars($product_id);?>" hidden>
         <input type="submit" value="Submit">

      </form>
   </body>
</html>
<?php
   } else {
      header('location:login.php');
   }
?>
