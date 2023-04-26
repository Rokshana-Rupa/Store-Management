<?php
require('connection.php');
session_start();
if(!empty($_SESSION['user_first_name']) && !empty($_SESSION['user_last_name'])) {
    $user_first_name= $_SESSION['user_first_name'];
   $user_first_name=$_SESSION['user_last_name'];
?>
<!DOCTYPE html>
<html>

<head>
    <title>list of user_last_name</title>
</head>

<body>
    <?php
    $sql = "SELECT * FROM users";
    $query = $conn->query($sql);
    echo "<table border='1'><tr><th>First Name</th><th>last_name</th><th>User Email</th><th>Action</th></tr>";
    while ($data = mysqli_fetch_assoc($query)) {
        $user_id= $data['user_id'];
        $user_first_name= $data['user_first_name'];
        $user_last_name = $data['user_last_name'];
        $user_email = $data['user_email'];

        echo "<tr>
        <td>$user_first_name</td>
        <td>$user_last_name </td>
        <td>$user_email</td>
       <td><a href='edit_users.php?id=$user_id'>Edit</a>
       </td>
</tr>";
    }
    echo "</table>";

    ?>

</body>

</html>
<?php
} else {
    header('location:login.php');
}
?>