<?php

include "db.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



if($_SERVER["REQUEST_METHOD"] === "GET") {
    $publisher_name = $_GET["Publisher_name"];
  
    // Prepare a SQL statement to get the book data
    $stmt = $mysqli->prepare("SELECT * FROM publisher WHERE Publisher_name = ?");
    
    // Bind the author name parameter
    $stmt->bind_param("s", $publisher_name);
  
    // Execute the query
    $stmt->execute();
  
    // Get the results
    $result = $stmt->get_result();
  
    // Fetch the book data
    if($result->num_rows > 0) {
      $publisher = $result->fetch_assoc();
    }
  
    $stmt->close();
} else if($_SERVER["REQUEST_METHOD"] === "POST") {
    $publisher_name = $_POST["Publisher_name"];
    $publisher_address = $_POST["Publisher_address"]   ?? NULL ;
    
    $stmt = $mysqli->prepare("UPDATE publisher SET Publisher_address = ? WHERE Publisher_name = ?");
    $stmt->bind_param("ss", $publisher_address, $publisher_name);

    if ($stmt->execute() === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error during execution: " . $stmt->error;
      echo "DB Error: " . $mysqli->error;
    }
    $stmt->close();

    header("location:MyPurchase.php");
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD PUBLISHER</title>
    <link rel="stylesheet" href="fav.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<style>
body{
    background-color: rgb(228, 223, 217);
}
</style>
<body>
    <div class= >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Publisher</h5>
              
            </div>
            
            <div class="modal-body">
                <form action= "add_publisher.php" method= "post">

                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Publisher Name:</label>
                      <input type="text" class="form-control" name="Publisher_name" value="<?= htmlspecialchars($publisher["Publisher_name"], ENT_QUOTES) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Publisher Address:</label>
                        <input type="text" class="form-control" name="Publisher_address" value="<?= htmlspecialchars($publisher["Publisher_address"], ENT_QUOTES) ?>">
                    </div>
                    <div>
                      <a class="btn btn-secondary" href="createlisting.php" >Close</a>
                      <button type="submit" class="btn btn-primary" name="submit">Save changes</button>

                      </div>
                  </form>
            </div>
            
          </div>
        </div>
      </div>
</body>
</html>