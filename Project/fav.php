<?php

include "db.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST["submit"])){

  $book_ID = $_POST["Book_ID"]   ?? NULL ;
  $title = $_POST["Title"]       ?? NULL   ;
  $isbn_No = $_POST["ISBN_No"]   ?? NULL ;
  $locationn = $_POST["Locationn"] ?? NULL ;
  $publisher = $_POST["Publisher"] ?? NULL;
  $author = $_POST["Author"]       ?? NULL  ;
  $category = $_POST["Category"]   ?? NULL ;
  $status = $_POST["Statuss"]         ?? NULL    ;

  $klasör = "images/";
  $tmp_name = $_FILES["Photo"]["tmp_name"];
  $name = $_FILES["Photo"]["name"];
  $boyut = $_FILES["Photo"]["size"];
  $type = $_FILES["Photo"]["type"];
  $err = $_FILES["Photo"]["error"];

  if($err != 0) {
    die("File upload error!");
  }

  if($boyut > 1024*1024*3){
    echo "File size is too large";
    exit();
  }

  $upload_path = $klasör . $name;

  if(!move_uploaded_file($tmp_name, $upload_path)) {
    die("Failed to upload file");
  }

  $stmt = $mysqli->prepare("INSERT INTO books (Book_ID, Title, ISBN_No, Locationn, Publisher, Author, Category, Photo, Statuss) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("issssssss", $book_ID, $title, $isbn_No, $locationn, $publisher, $author, $category, $upload_path, $status);

  if($stmt->execute() === TRUE) {
    echo "New record created successfully in books table";
    $book_ID = $mysqli->insert_id; // get the last inserted ID
  } else {
    echo "Error: " . $stmt->error;
  }

  $reserved_id = NULL;
  $reserved_time = NULL;
  $end_time = NULL;

  $st = $mysqli->prepare("INSERT INTO reservation (Book_ID, Reserved_ID, Reserved_Time, end_time) VALUES (?, ?, ?, ?)");
  $st->bind_param("isss", $book_ID, $reserved_id, $reserved_time, $end_time);

  if ($st->execute() === TRUE) {
    echo "New record created successfully in reservation table";
  } else {
    echo "Error: " . $st->error;
  }


  
  
  $country = NULL;
  $decade = NULL;

  $sau = $mysqli->prepare("INSERT INTO author (Author_name, Country, Decade, Book_ID) VALUES (?, ?, ?,?)");
  $sau->bind_param("sssi", $author, $country, $decade, $book_ID);

  if ($sau->execute() === TRUE) {
    echo "New record created successfully in reservation table";
  } else {
    echo "Error: " . $sau->error;
  }

  
  $Publisher_address = NULL;

  $sap = $mysqli->prepare("INSERT INTO publisher (Publisher_name, Publisher_address, Book_ID) VALUES (?, ?,?)");
  $sap->bind_param("ssi", $publisher, $Publisher_address, $book_ID);

  if ($sap->execute() === TRUE) {
    echo "New record created successfully in reservation table";
  } else {
    echo "Error: " . $sap->error;
  }

  $sap->close();
  $sau->close();
  $stmt->close();
  $st->close();

  header("location:fav.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAV</title>
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
              <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
              
            </div>
            
            <div class="modal-body">
                <form action= "fav.php" method= "post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Book ID:</label>
                        <input type="number" class="form-control" name="Book_ID" readonly>
                      </div>
                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Book Name:</label>
                      <input type="text" class="form-control" name="Title">
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Category:
                      </label>
                      <select class="form-select" aria-label="Default select example" name="Category">
                        <option selected>Book Type</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Drama">Drama</option>
                        <option value="Action">Action</option>
                        <option value="Romance">Romance</option>
                        <option value="Academic">Academic</option>
                        <option value="Comics">Comics</option>
                        <option value="Science">Science</option>
                        <option value="Philosophy">Philosophy</option>
                      </select>
              
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Location:
                      </label>
                      <select class="form-select" aria-label="Default select example" name="Locationn">
                        
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        
                      </select>
                    </div>
                    
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">ISBN No:</label>
                      <input type="number" class="form-control" name="ISBN_No">
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Publisher:</label>
                      <input type="text" class="form-control" name="Publisher">
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Author:</label>
                      <input type="text" class="form-control" name="Author">
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Upload File:</label>
                      <td><input type="file" class="form-control" name="Photo"></td>
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Location:
                      </label>
                      <select class="form-select" aria-label="Default select example" name="  Statuss">
                        
                        <option value="Usable">Usable</option>
                        <option value="Borrowed">Borrowed</option>
                        <option value="Reserved">Reserved</option>
                      
                        
                      </select>
                    </div>
                    <div class="modal-footer">
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