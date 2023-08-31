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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include "db.php";



if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
} 

$sorgu = $mysqli->query("SELECT * FROM books");

if(!$sorgu) {
  die('Invalid query: ' . $mysqli->error);
}


$books = $sorgu->fetch_all(MYSQLI_ASSOC);








?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/create.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>

      <h1 class="text-center">Add New Book</h1>

      <div class="container">
          
           
           
          <!-- Button trigger modal -->
          <div>
            <a class ="btn btn-success" href= "fav.php">
            Add Book
            </a>
          </div>
          
           </div>
              <div class="container">
                  <table class="table">
                      <thead>
                          <th class = "xd" scope="col"><a>Book_ID</a></th>
                          <th class = "xd" scope="col"><a>Title</a></th>
                          <th class = "xd"  scope="col"><a>ISBN_No</a></th>
                          <th class = "xd"  scope="col"><a>Location</a></th>
                          <th class = "xd"  scope="col"><a>Publisher</a></th>
                          <th class = "xd"  scope="col"><a>Author</a></th>
                          <th class = "xd"  scope="col"><a>Category</a></th>
                          <th class = "xd"  scope="col"><a>Photo</a></th> 
                          <th class = "xd"  scope="col"><a>Status</a></th>
                          
                      </thead>
                        <thead>
                            <?php foreach ($books as $satirNo => $book){ ?>
                                <tr>
                                    <th class = "xd" scope="col"><?=$book["Book_ID"]?></th>
                                    <th class = "xd" scope="col"><?=$book["Title"]?></th>
                                    <th class = "xd" scope="col"><?=$book["ISBN_No"]?></th>
                                    <th class = "xd" scope="col"><?=$book["Locationn"]?></th>
                                    <th class = "xd" scope="col"><?=$book["Publisher"]?></th>
                                    <th class = "xd" scope="col"><?=$book["Author"]?></th>
                                    <th class = "xd" scope="col"><?=$book["Category"]?></th>
                                    <th class = "xd" scope="col"><?=$book["Photo"]?></th>
                                    <th class = "xd" scope="col"><?=$book["Statuss"]?></th>

                                    
                                </tr>

                            <? } ?>


                        </thead>
                    </table>
              </div>
              
              </div>
      </div>
        
        
</body>
</html>
<?php
}
?>