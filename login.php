<?php
require('connection.php'); // assuming this file contains the database connection code
session_start();

if(isset($_POST['user_email']) && isset($_POST['user_password'])){
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']); // escape special characters
    $user_password = mysqli_real_escape_string($conn, $_POST['user_password']); // escape special characters

    // check if the email and password are not empty and meet certain criteria (e.g. valid email format)
    if(!empty($user_email) && filter_var($user_email, FILTER_VALIDATE_EMAIL) && !empty($user_password)){

        $sql = "SELECT * FROM users WHERE user_email='$user_email' AND user_password='$user_password'";
        $query = mysqli_query($conn, $sql);

        // check if the query executed successfully
        if($query){
            $result_count = mysqli_num_rows($query);
            if($result_count > 0){
                $data = mysqli_fetch_array($query);
                $user_first_name = $data['user_first_name'];
                $user_last_name = $data['user_last_name'];
                $_SESSION['user_first_name'] = $user_first_name;
                $_SESSION['user_last_name'] = $user_last_name;
                header('location:index.php');
            } else {
                echo 'Incorrect email or password';
            }
        } else {
            die('Error: ' . mysqli_error($conn));
        }
    } else {
        echo 'Invalid input';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="<?php echo $_SERVER ['PHP_SELF'];?>" method="POST">
        User's Email:<br>
        <input type="email" name="user_email"><br><br>
        User's Password:<br>
        <input type="password" name="user_password"><br><br>
        <input type="submit" value="submit">
    </form>
</body>
</html>
