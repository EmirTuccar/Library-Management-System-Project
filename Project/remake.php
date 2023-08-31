<?php

include "db.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if($_SERVER["REQUEST_METHOD"] === "GET") {
    $book_id = $_GET["Book_ID"];
  
    // Prepare a SQL statement to get the book data
    $stmt = $mysqli->prepare("SELECT * FROM books WHERE Book_ID = ?");
    
    // Bind the book id parameter
    $stmt->bind_param("i", $book_id);
  
    // Execute the query
    $stmt->execute();
  
    // Get the results
    $result = $stmt->get_result();
  
    // Fetch the book data
    if($result->num_rows > 0) {
      $book = $result->fetch_assoc();
    }
  
    $stmt->close();
} else if($_SERVER["REQUEST_METHOD"] === "POST") {
    $book_id = $_POST["Book_ID"];
    $title = $_POST["Title"]       ?? NULL;
    $isbn_No = $_POST["ISBN_No"]   ?? NULL;
    $locationn = $_POST["Locationn"] ?? NULL;
    $publisher = $_POST["Publisher"] ?? NULL;
    $author = $_POST["Author"]       ?? NULL;
    $category = $_POST["Category"]   ?? NULL;
    $photo = $_POST["Photo"]         ?? NULL;
    $status = $_POST["Statuss"]         ?? NULL;

    $stmt = $mysqli->prepare("UPDATE books SET Title = ?, ISBN_No = ?, Locationn = ?, Publisher = ?, Author = ?, Category = ?, Photo = ?, Statuss = ? WHERE Book_ID = ?");
    $stmt->bind_param("sissssssi", $title, $isbn_No, $locationn, $publisher, $author, $category, $photo, $status, $book_id);

    if ($stmt->execute() === TRUE) {
      echo "Record updated successfully";

      // If the book status was changed to 'Usable', update the reservation table
      if ($status === 'Usable') {
        $stmt2 = $mysqli->prepare("UPDATE reservation SET Reserved_ID = NULL, Reserved_Time = NULL, end_time = NULL WHERE Book_ID = ?");
        $stmt2->bind_param("i", $book_id);

        if ($stmt2->execute() === TRUE) {
          echo "Book reservation details reset successfully";
        } else {
          echo "Error during execution: " . $stmt2->error;
        }

        $stmt2->close();
      }
    } else {
      echo "Error during execution: " . $stmt->error;
      echo "DB Error: " . $mysqli->error;
    }
    
    $stmt->close();

    header("location:BookList.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
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
              <h5 class="modal-title" id="exampleModalLabel">Edit Book</h5>
              
            </div>
            
            <div class="modal-body">
                <form action= "remake.php" method= "post">
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Book ID:</label>
                        <input type="number" class="form-control" name="Book_ID" value="<?= htmlspecialchars($book["Book_ID"], ENT_QUOTES) ?>" readonly>
                      </div>
                    <div class="mb-3">
                      <label for="recipient-name" class="col-form-label">Book Name:</label>
                      <input type="text" class="form-control" name="Title" value="<?= htmlspecialchars($book["Title"], ENT_QUOTES) ?>">
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Category:
                      </label>
                      <select class="form-select" aria-label="Default select example" name="Category">
                        <option>Book Type</option>
                        <option value="Fantasy" <?= $book["Category"] == 'Fantasy' ? 'selected' : '' ?>>Fantasy</option>
                        <option value="Drama" <?= $book["Category"] == 'Drama' ? 'selected' : '' ?>>Drama</option>
                        <option value="Action" <?= $book["Category"] == 'Action' ? 'selected' : '' ?>>Action</option>
                        <option value="Romance" <?= $book["Category"] == 'Romance' ? 'selected' : '' ?>>Romance</option>
                        <option value="Academic" <?= $book["Category"] == 'Academic' ? 'selected' : '' ?>>Academic</option>
                        <option value="Comics" <?= $book["Category"] == 'Comics' ? 'selected' : '' ?>>Comics</option>
                        <option value="Science" <?= $book["Category"] == 'Science' ? 'selected' : '' ?>>Science</option>
                        <option value="Philosophy" <?= $book["Category"] == 'Philosophy' ? 'selected' : '' ?>>Philosophy</option>
                      </select>

                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Location:
                      </label>
                      <select class="form-select" aria-label="Default select example" name="Locationn">
                        <option value="A" <?= $book["Locationn"] == 'A' ? 'selected' : '' ?>>A</option>
                        <option value="B" <?= $book["Locationn"] == 'B' ? 'selected' : '' ?>>B</option>
                        <option value="C" <?= $book["Locationn"] == 'C' ? 'selected' : '' ?>>C</option>
                        <option value="D" <?= $book["Locationn"] == 'D' ? 'selected' : '' ?>>D</option>
                        <option value="E" <?= $book["Locationn"] == 'E' ? 'selected' : '' ?>>E</option>
                      </select>
                    </div>
                    
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">ISBN No:</label>
                      <input type="number" class="form-control" name="ISBN_No" value="<?= htmlspecialchars($book["ISBN_No"], ENT_QUOTES) ?>">
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Publisher:</label>
                      <input type="text" class="form-control" name="Publisher" value="<?= htmlspecialchars($book["Publisher"], ENT_QUOTES) ?>">
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Author:</label>
                      <input type="text" class="form-control" name="Author" value="<?= htmlspecialchars($book["Author"], ENT_QUOTES) ?>">
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Upload File:</label>
                      <td><input type="text" class="form-control" name="Photo" value="<?= htmlspecialchars($book["Photo"], ENT_QUOTES) ?>"></td>
                    </div>
                    <div class="mb-3">
                      <label for="message-text" class="col-form-label">Location:
                      </label>
                      <select class="form-select" aria-label="Default select example" name="Statuss">
                        <option value="Usable" <?= $book["Statuss"] == 'Usable' ? 'selected' : '' ?>>Usable</option>
                        <option value="Borrowed" <?= $book["Statuss"] == 'Borrowed' ? 'selected' : '' ?>>Borrowed</option>
                        <option value="Reserved" <?= $book["Statuss"] == 'Reserved' ? 'selected' : '' ?>>Reserved</option>
                      </select>

                    </div>
                    <div class="modal-footer">
                      <a class="btn btn-secondary" href="BookList.php" >Close</a>
                      <button type="submit" class="btn btn-primary" name="submit">Save changes</button>

                      </div>
                  </form>
            </div>
            
          </div>
        </div>
      </div>
</body>
</html>