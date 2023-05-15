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
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>sTore management System</title>
 	




</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		position: absolute;
		right:0;
		width:40%;
		height: calc(100%);
		background:white;
		display: flex;
		align-items: center;
	}
	#login-left{
		position: absolute;
		left:0;
		width:60%;
		height: calc(100%);
		background: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.75)),url(./images/store.jpg);
  background-size: contain;
		display: flex;
		align-items: center;
	}
	#login-right .card{
		margin: auto
	}
	
</style>

<body>


  <main id="main" class=" bg-dark">
  		<div id="login-left">
  			<div class="logo">
  				<span class="fa fa-coins"></span>
  			</div>
  		</div>
  		<div id="login-right">
  			<div class="card col-md-8">
  				<div class="card-body">
                  <form action="<?php echo $_SERVER ['PHP_SELF'];?>" method="POST">
        User's Email:<br>
        <input type="email" name="user_email"><br><br>
        User's Password:<br>
        <input type="password" name="user_password"><br><br>
        <input type="submit" value="submit">
    </form>
  				</div>
  			</div>
  		</div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else if(resp == 2){
					location.href ='voting.php';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>