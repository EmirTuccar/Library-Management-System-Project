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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include "db.php";



if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
} 

$sorgu = $mysqli->query("SELECT DISTINCT books.Title, books.Category, books.Photo, Publisher.Publisher_name, Publisher.Publisher_address, books.Statuss, author.Author_name, author.Country, author.Decade FROM books 
INNER JOIN author ON author.Author_name = books.Author
INNER JOIN publisher ON publisher.Publisher_name = books.Publisher");


if(!$sorgu) {
  die('Invalid query: ' . $mysqli->error);
}


$books = $sorgu->fetch_all(MYSQLI_ASSOC);



$booksByAuthor = [];

foreach ($books as $book) {
    
    $booksByAuthor[$book['Author_name']][] = $book;
}






?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    
    <title>My Purchases</title>

  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="css/MyPurchase.css">
</head>
<body>



    

<?php foreach ($booksByAuthor as $author => $books){ ?>  

<div class="container bootdey">
    <div class="panel panel-default panel-order">
        
        <div class="panel-heading">
            
                <div>
                    
                    <img class="lol" src="images\writer.jpg"/>
                    <div class= "btn-group-vertical">
                    <strong class="xd"><?=$author?></strong>
                    <p class= "gy">Country: <?=$book["Country"]?></p>
                    <p class= "gy">Decade: <?=$book["Decade"]?></p>
                    </div>
                    <div class= "btn-group-vertical pull-right">
                    <div>
                        <a class ="btn btn-success" href= "add_author.php?Author_name=<?=$book["Author_name"]?>">
                        Add Author 
                        </a>
                    </div>
                        
                    </div>
                    <div class= "btn-group-vertical pull-right">
                    
                        
                    </div>
                    
                </div>

                
            
            
        </div>

        

        <div class="panel-body">
            
        <?php foreach ($books as $book) { ?>

            <div class="row">
                <div class="col-md-1"><img class="sg" src="<?php echo $book["Photo"]; ?>" /></div>

                <div class="col-md-11">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <a class="btn btn-success pull-right" href="add_publisher.php?Publisher_name=<?=$book["Publisher_name"]?>">Add Publisher</a>
                            
                            <span><h4><strong><?=$book["Title"]?></strong></span> <span class="label label-info"><?=$book["Category"]?></span></h4><h5>
                            Publisher Name: <?=$book["Publisher_name"]?>,  Publisher Address: <?=$book["Publisher_address"]?>, Status: <?=$book["Statuss"]?></h5>
                        </div>
                        
                    </div>
                        
                    
                </div>
                
            </div>

            

            
            <?php } ?>
            
        </div>
        
    </div>
    
</div>

<?php } ?>


    <div class="container bootdey">
        <div class="panel panel-default panel-order">
            <div class="panel-heading">
                <div>
                    <img class="lol" src="images\hawking.jpg"/>
                    <strong class="xd">Stephen Hawking</strong>
                </div>
                
            </div>
    
            <div class="panel-body">
                
                <div class="row">
                    <div class="col-md-1"><img class="sg" src="images\kafka.jpg"/></div>
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right"><a class="btn btn-success" href="#">Show Detail</a></div>
                                <span><h4><strong>A Brief History of Time</strong></span> <span class="label label-info">Science</span></h4><h5>
                                Publisher: Emir Yayıncılık,  Cost: $100,00<br /></h5>
                            </div>
                            
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-1"><img class="sg" src="images\kafka.jpg"/></div>
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right"><a class="btn btn-success" href="#">Show Detail</a></div>
                                <span><h4><strong>The Grand Design</strong></span> <span class="label label-info">Science</span></h4><h5>
                                Publisher: Emir Yayıncılık,  Cost: $100,00<br /></h5>
                            </div>
                            
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-1"><img class="sg" src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTClpxO9QaVGUo8iWl5nykuvYIJcKNViqC4LRTYPIAjtpzLxdIr"/></div>
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right"><a class="btn btn-success" href="#">Show Detail</a></div>
                                <span><h4><strong>What Is Inside a Black Hole?</strong></span> <span class="label label-info">Science</span></h4><h5>
                                Publisher: Emir Yayıncılık,  Cost: $100,00<br /></h5>
                            </div>
                            
                        </div>
                    </div>
                </div>
    
                
            </div>
            <div class="panel-footer"></div>
        </div>
        
    </div>
    <div class="container bootdey">
        <div class="panel panel-default panel-order">
            <div class="panel-heading">
                <div>
                    <img class="lol" src="images\kafka.jpg"/>
                    <strong class="xd">Franz Kafka</strong>
                </div>
                
            </div>
    
            <div class="panel-body">
                
                <div class="row">
                    <div class="col-md-1"><img class="sg" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSOxesnFmjSMTkSOEyb3-wH8Wgs4azNqo8VOulL5YGj&s"/></div>
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right"><a class="btn btn-success" href="#">Show Detail</a></div>
                                <span><h4><strong>The Metamorphosis</strong></span> <span class="label label-info">Fantasy</span></h4><h5>
                                Publisher: Emir Yayıncılık,  Cost: $100,00<br /></h5>
                            </div>
                            
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-1"><img class="sg" src="images\kafka.jpg"/></div>
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right"><a class="btn btn-success" href="#">Show Detail</a></div>
                                <span><h4><strong>The Castle</strong></span> <span class="label label-info">Action</span></h4><h5>
                                Publisher: Emir Yayıncılık,  Cost: $100,00<br /></h5>
                            </div>
                            
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-1"><img class="sg" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRUJHQ2TdKCA-BLdBfP42KF5NsmqOr1DyoheeRg2bpLInDqHgNBXJj0pTPe&s=5"/></div>
                    <div class="col-md-11">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right"><a class="btn btn-success" href="#">Show Detail</a></div>
                                <span><h4><strong>Der Verschollene</strong></span> <span class="label label-info">Drama</span></h4><h5>
                                Publisher: Emir Yayıncılık,  Cost: $100,00<br /></h5>
                            </div>
                            
                        </div>
                    </div>
                </div>
    
                
            </div>
            <div class="panel-footer"></div>
        </div>
        
    </div>
    </body>
    </html>
    <?php
}
?>