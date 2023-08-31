<?php 
session_start();
if($_SESSION["sess_type"] == 'staff'){
    include "topbar.php";
} else {
    include "topbar2.php";
}
if(!$_SESSION["sess_user"]){
    header("location:login.php");
} else {
?>
<?php
$user = $_SESSION['sess_id'];
echo $user;


include "db.php";

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

$statusFilters = array("usable", "borrowed", "reserved");
$selectedStatuses = array();

if (isset($_POST["submit"])) {
  // Create a DateTime object for the current date/time
  $now = new DateTime();

  // Format it for MySQL's datetime type
  $Reserved_Time = $now->format('Y-m-d H:i:s');

  // Add 2 days to the current date/time
  $now->modify('+2 days');

  // Format it for MySQL's datetime type
  $end_time = $now->format('Y-m-d H:i:s');

  $book_id = $_POST["Book_ID"];
  $new_status = 'Reserved'; // This would change depending on the new status

  // Update the books table
  $stmt_books = $mysqli->prepare("UPDATE books SET Statuss=? WHERE Book_ID=?");
  $stmt_books->bind_param("si", $new_status, $book_id);
  
  if ($stmt_books->execute() === TRUE) {
    echo "Book status updated successfully";
  } else {
    echo "Error updating book status: " . $stmt_books->error;
  }

  $stmt_books->close();

  // Update the reservation table
  $stmt_reverse = $mysqli->prepare("UPDATE reservation SET Reserved_ID = ?, Reserved_Time = ?, end_time = ? WHERE Book_ID = ?");

  $stmt_reverse->bind_param('issi', $user, $Reserved_Time, $end_time, $book_id);

  if ($stmt_reverse->execute() === TRUE) {
    echo "Book reserved successfully";
  } else {
    echo "Error reserving book: " . $stmt_reverse->error;
  }

  $stmt_reverse->close();
}

foreach ($statusFilters as $status) {
  if (isset($_POST[$status])) {
    $selectedStatuses[] = $status;
  }
}

$query = "SELECT * FROM books INNER JOIN reservation ON books.Book_ID = reservation.Book_ID";

if (!empty($selectedStatuses)) {
  $statusConditions = implode("', '", $selectedStatuses);
  $query .= " WHERE Statuss IN ('$statusConditions')";
}

$result = $mysqli->query($query);

if (!$result) {
  die('Invalid query: ' . $mysqli->error);
}

$books = $result->fetch_all(MYSQLI_ASSOC);

// The rest of your HTML and PHP code
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>USER</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
    integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
    integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="css/main.css">
</head>

<body>
  <!-- SECTION -->
  <div class="section">
    <!-- container -->
    <div class="container">
      <!-- row -->
      <div class="row">
        <div id="filter" class="col-md-3">
          <h3 class="filter-title">Listing Type</h3>
          <div class="checkbox-filter">
            <form action="usermain.php" method="post">
              <?php foreach ($statusFilters as $status) { ?>
              <div class="checkbox">
                <input type="checkbox" id="category-<?=$status?>" name="<?=$status?>" class="status-filter" <?php if (in_array($status, $selectedStatuses)) echo "checked"; ?>>
                <label for="category-<?=$status?>">
                  <span></span>
                  <?=ucfirst($status)?>
                </label>
              </div>
              <?php } ?>
              <button type="submit" name="submit" class="btn btn-primary">Filter</button>
            </form>
          </div>
        </div>

        <!-- STORE -->
        <div id="store" class="col">
          <!-- store products -->
          <div class="result">
            <?php foreach ($books as $book) { ?>
            <div class="comp buy" action="usermain.php" method="post">
              <div class="col-sm-3 col-md-6">
                <div class="product">
                  <div class="product-body">
                    <h3 class="product-name"><a href="#"><?=$book["Title"]?></a></h3>
                    <h4 class="product-price">Status: <?=$book["Statuss"]?></h4>

                    <div class="product-btns">
                      <button class="add-to-wishlist"><a href="fav.html"><i class="fa fa-star"></i></a><span
                          class="tooltipp">add to favorites</span></button>
                      <button class="add-to-wishlist"><a href="messages.html"><i class="fas fa-envelope"></i></a><span
                          class="tooltipp">Contact Seller</span></button>
                      <button class="add-to-wishlist"><a href=""><i class="fas fa-info"></i></a><span
                          class="tooltipp">Product Info</span></button>
                    </div>
                    
                    <form action="usermain.php" method="post">
                      <button type="button" class="btn btn-danger"><i class="fa fa-shopping-cart"></i> Buy it Now</button>
                      <input type="hidden" name="Book_ID" value="<?= $book["Book_ID"] ?>">
                      <button type="submit" class="btn btn-success" name="submit"><i class="fa fa-shopping-cart"></i> Reserve</button>
                    </form>
                    
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
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
