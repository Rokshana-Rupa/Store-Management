<?php
include("db.php");
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total = $quantity * $price;
    
    $query = "INSERT INTO purchase(name, product, quantity, price, total) VALUES('$name', '$product', '$quantity', '$price', '$total')";
    
    if(mysqli_query($con, $query)){
        echo "Purchase added successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Purchase Product</title>
</head>
<body>
	<form method="POST">
		<label>Name:</label>
		<input type="text" name="name" required><br><br>
		<label>Product:</label>
		<select name="product" required>
			<option value="">--Select Product--</option>
			<?php
			$query = "SELECT * FROM store_product";
			$result = mysqli_query($con, $query);
			while($row = mysqli_fetch_assoc($result)){
				echo "<option value='".$row['name']."'>".$row['name']."</option>";
			}
			?>
		</select><br><br>
		<label>Quantity:</label>
		<input type="number" name="quantity" required><br><br>
		<label>Price:</label>
		<input type="number" name="price" required><br><br>
		<input type="submit" name="submit" value="Purchase">
	</form>
</body>
</html>
