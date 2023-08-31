<?php
include "db.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_POST["submit"])){

	if(!empty($_POST['first']) && !empty($_POST['last']) && !empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['user_type'])) {
		$first=$_POST['first'];
		$last=$_POST['last'];
		$user=$_POST['user'];
		$pass=$_POST['pass'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$user_type=$_POST['user_type'];

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid email or phone format";
		}
		else{
		

		
		$stmt = $mysqli->prepare("INSERT INTO users (first_name,last_name,user_name,passwordd,email,phone,user_type) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssss", $first, $last, $user, $pass, $email, $phone, $user_type);
		
		
			
		}
		
		if($stmt->execute()){
			header("Location: login.php");
		} else {
			echo "Error: " . $stmt->error;
		}
		

		}
		
		else {
		echo "That username already exists! Please try again with another.";
		}

	} else {
		echo "All fields are required!";
	}

?>


















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEBİS</title>
    <link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Register</h3>
			</div>
			<div class="card-body">
				<form method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="firstname" id="txtfirstname" name="first" >
						
					</div>

                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="lastname" id="txtlastname" name="last">
						
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username" id="txtUserName" name="user">
						
					</div>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" id="txtPassword" name="pass">
						
					</div>

                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="E-mail" id="txtemail" name="email">						
					</div>

                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-phone"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="phone" id="txtphone" name="phone">
						<span class="text-danger"><?php if (isset($phone_error)) echo $phone_error; ?></span>
						
					</div>
					
					<div>
					<input type="radio" name="user_type" id="contact_user" value="user" />
					<label for="contact_user">USER</label>

					<input type="radio" name="user_type" id="contact_staff" value="staff" />
					<label for="contact_staff">STAFF</label>
					</div>
					


					<div class="form-group">
					<input type="submit" class="btn float-right login_btn" value="Register" name="submit" />
					</div>
				</form>

				

			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links text-success mw-100" >
					Do you have an account? <a href="login.php">Sign In</a>
				</div>
		
			</div>
		</div>
	</div>
</div>

</html>