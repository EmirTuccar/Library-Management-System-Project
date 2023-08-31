<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "db.php";

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
} 

$book_id = $_GET["Book_ID"] ?? NULL;

if(!$book_id){
    header("location: Mylisting.php");
    exit();
}

// begin transaction
$mysqli->begin_transaction();

try {
    // delete related records in author table
    $stmt_delete_author = $mysqli->prepare("DELETE FROM author WHERE Book_ID = ?");
    $stmt_delete_author->bind_param("i", $book_id);
    $stmt_delete_author->execute();
    $stmt_delete_author->close();

    $stmt_delete_publisher = $mysqli->prepare("DELETE FROM publisher WHERE Book_ID = ?");
    $stmt_delete_publisher->bind_param("i", $book_id);
    $stmt_delete_publisher->execute();
    $stmt_delete_publisher->close();

    $stmt_delete_reserve = $mysqli->prepare("DELETE FROM reservation WHERE Book_ID = ?");
    $stmt_delete_reserve->bind_param("i", $book_id);
    $stmt_delete_reserve->execute();
    $stmt_delete_reserve->close();


    // delete record in books table
    $stmt_delete_book = $mysqli->prepare("DELETE FROM books WHERE Book_ID = ?");
    $stmt_delete_book->bind_param("i", $book_id);
    $stmt_delete_book->execute();
    $stmt_delete_book->close();
    
   
    

    // commit transaction
    $mysqli->commit();
    
    echo "Record deleted successfully";
    header("location:BookList.php");
    exit();

} catch(Exception $e) {
    // An exception has been thrown
    // We must rollback the transaction
    $mysqli->rollback();
    
    echo "Error: " . $e->getMessage();
}
?>
