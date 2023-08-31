<?php
include "db.php";

if(isset($_POST["submit"])){
    if(!empty($_POST['user']) && !empty($_POST['pass'])) {
        $user=$_POST['user'];
        $pass=$_POST['pass'];

        // Create a prepared statement
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE user_name = ? AND passwordd = ?");
        $stmt->bind_param("ss", $user, $pass);
        
        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if a user was found
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            
            session_start();
            $_SESSION['sess_user'] = $row['user_name'];
            $_SESSION['sess_type'] = $row['user_type'];
            $_SESSION['sess_id'] = $row['uid'];


            /* Redirect browser */
            header("Location: profile.php");
        } else {
            echo "Invalid username or password!";
        }
    } else {
        echo "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In</h3>
			</div>
			<div class="card-body">
				<form action="" method="POST">
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
                    <div class="form-group">
                        <label id="login-message" class="wrong-login-message display-none "></label>
                    </div>
					<div class="form-group">
                        <input type="submit" role="button" class="btn float-right login_btn" value="Login" name="submit" />
						<!--<a href="usermain.html"><input type="submit" value="Register" class="btn float-right login_btn"  ></a>
						<input type="submit" value="Register" class="btn float-right login_btn" onclick = "SignUp()" >-->
					</div>
				</form>
                

			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links text-success mw-100" >
					Don't have an account?<a href="register.php">Sign Up</a>
				</div>
		
			</div>
		</div>
	</div>
</div>

</html>