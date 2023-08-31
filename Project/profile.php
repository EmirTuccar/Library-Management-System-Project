<?php 

session_start();
if($_SESSION["sess_type"] == 'staff'){
	include"topbar.php";
  } else {
	include"topbar2.php";
  }
if(!$_SESSION["sess_user"]){
	header("location:login.php");
} else {
?>
<?php
include "db.php";
$user = $_SESSION['sess_user'];
$servername='localhost';
    $username='root';
    $password='root';
    $dbname = "databsefinal";
    $conn = new mysqli($servername, $username, $password,$dbname);
$sql = "SELECT first_name, last_name, user_name, email, phone FROM users WHERE user_name = '".$user."'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$first = $row["first_name"];
$last = $row["last_name"];
$email = $row["email"];
$phone = $row["phone"];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <div class="container">
		<div class="main-body">
			<div class="row">
				<div class="col-lg-4">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
                                <br>
								<img src="https://w7.pngwing.com/pngs/24/650/png-transparent-computer-icons-service-avatar-user-guest-house-gaulish-language-purple-service-logo-thumbnail.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
							</div>
                            
							<hr class="my-4">
                            <br><br>
							<ul class="list-group list-group-flush">
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h3 class="mb-0"><i class="fas fa-user"></i> Name:</h3>
									<span class="text-secondary"><?php echo $first, " ",$last ?></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h3 class="mb-0"><i class="fas fa-user"></i> Userame:</h3>
									<span class="text-secondary"><?php echo $user ?></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h3 class="mb-0"><i class="fas fa-envelope"></i> E-mail:</h3>
									<span class="text-secondary"><?php echo $email ?></span>
								</li>
								<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
									<h3 class="mb-0"><i class="fas fa-phone"></i> Phone:</h3>
									<span class="text-secondary"><?php echo $phone ?></span>
								</li>

							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

</body>
</html>
<?php
}
?>