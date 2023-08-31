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
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/MyListing.css">
</head>
<body>



<div class="container padding-bottom-3x mb-1">
    <div class="table-responsive shopping-cart">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">Book Name</th>
                    <th class="text-center">Location</th>
                    <th class="text-center">Category</th>
                    <th class="text-center">Situation</th>
                    <th class="text-center"><a class="btn btn-sm btn-outline-danger" id="clear1" href="#">Clear All</a>
                        <script>
                            var buton = document.querySelector("#clear1");
                            buton.onclick=function(){
                        
                            const myobj1 = document.getElementById("item1");
                            const myobj2 = document.getElementById("item2");
                            const myobj3 = document.getElementById("item3");
                            const myobj4 = document.getElementById("item4");
                            if(myobj1 != 'undefined' && myobj1 != null){
                                myobj1.remove();}
                            if(myobj2 != 'undefined' && myobj2 != null){
                                myobj2.remove();}
                            if(myobj3 != 'undefined' && myobj3 != null){
                                myobj3.remove();}  
                            if(myobj4 != 'undefined' && myobj4 != null){
                                myobj4.remove();}
                            }
                        
                                               
                        </script>
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                


                <?php foreach ($books as $satirNo => $book){ ?>

                    <tr id="item1">
                    <td>
                        <div class="product-item">
                            <a class="product-thumb" href="#"><img src=<?=$book["Photo"]?> alt="Product"></a>
                            <div class="product-info">
                                <h4 class="product-title"><a href="#"><?=$book["Title"]?></a></h4><span><em>Author: </em><?=$book["Author"]?></span><span><em>Publisher: </em><?=$book["Publisher"]?></span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium"><h3><?=$book["Locationn"]?></h3></td>
                    <td class="text-center text-lg text-medium"><h3><?=$book["Category"]?></h3></td>
                    <td class="text-center text-lg text-medium"><h3><?=$book["Statuss"]?></h3></td>
                    <td class="buttons" ><a class="xd"><i class="dde">
                        <div class="sd">
                        
                        <a class="btn btn-danger" id="btndel1" href="delete.php?Book_ID=<?=$book["Book_ID"]?>">Delete</a><br>
                        <a class="btn btn-warning" id="btnedit" href="remake.php?Book_ID=<?=$book["Book_ID"]?>">Edit</a>
                        <script>
                            var buton = document.querySelector("#btndel1");
                            buton.onclick=function(){

                            
                            const myobj = document.getElementById("item1");
                            myobj.remove();
                            }  
                            </script>
                        </div>
                        
                    </i></a></td>
                </tr>
                            <? } ?>



                <tr id="item2">
                    <td>
                        <div class="product-item">
                            <a class="product-thumb" href="#"><img src="images\masal.jpg" alt="Product"></a>
                            <div class="product-info">
                                <h4 class="product-title"><a href="#">La Fontaine's Fables</a></h4><span><em>Cost: </em> $123.99</span><span><em>Publisher: </em> Emir Yayıncılık</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium"><h3>1</h3></td>
                    <td class="text-center text-lg text-medium"><h3>Fantasy</h3></td>
                    <td class="text-center text-lg text-medium"><h3>Buy</h3></td>
                    <td class="buttons" ><a class="xd"><i class="dde">
                        <div class="sd">
                        
                        <a class="btn btn-danger" id="btndel2" href="#">Delete</a><br>
                        <a class="btn btn-warning" id="btnedit2" href="#">Edit</a>
                        
                        <script>
                            var buton = document.querySelector("#btndel2");
                            buton.onclick=function(){

                            
                            const myobj = document.getElementById("item2");
                            myobj.remove();
                            }                    
                        </script>
                    </div>
                    </i></a></td>
                </tr>
                <tr id="item3">
                    <td>
                        <div class="product-item">
                            <a class="product-thumb" href="#"><img src="images\memnu.jpg" alt="Product"></a>
                            <div class="product-info">
                                <h4 class="product-title"><a href="#">Aşk-ı Memnu</a></h4><span><em>Cost: </em> $100,00</span><span><em>Publisher: </em> Emir Yayıncılık</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium"><h3>1</h3></td>
                    <td class="text-center text-lg text-medium"><h3>Romance</h3></td>
                    <td class="text-center text-lg text-medium"><h3>Reserve</h3></td>
                    <td class="buttons" ><a class="xd"><i class="dde">
                        <div class="sd">
                        
                        <a class="btn btn-danger" id="btndel3" href="#">Delete</a><br>
                        <a class="btn btn-warning" id="btnedit3" href="#">Edit</a>
                        <script>
                            var buton = document.querySelector("#btndel3");
                            buton.onclick=function(){

                            
                            const myobj = document.getElementById("item3");
                            myobj.remove();
                            }  
                            </script>
                        </div>
                    </i></a></td>
                </tr>
                <tr id="item4">
                    <td>
                        <div class="product-item">
                            <a class="product-thumb" href="#"><img src="images\fizik.jpg" alt="Product"></a>
                            <div class="product-info">
                                <h4 class="product-title"><a href="#">Astrophysics</a></h4><span><em>Cost: </em> $1000,00</span><span><em>Publisher: </em> Şule Yayıncılık</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center text-lg text-medium"><h3>1</h3></td>
                    <td class="text-center text-lg text-medium"><h3>Science</h3></td>
                    <td class="text-center text-lg text-medium"><h3>Buy</h3></td>
                    <td class="buttons" ><a class="xd"><i class="dde">
                        <div class="sd">
                        
                        <a class="btn btn-danger" id="btndel4" href="#">Delete</a><br>
                        
                        <a class="btn btn-warning" id="btnedit4" href="#">Edit</a>
                        <script>
                            var buton = document.querySelector("#btndel4");
                            buton.onclick=function(){

                            
                            const myobj = document.getElementById("item4");
                            myobj.remove();
                            }                    
                        </script>
                    </div>
                    </i></a></td>
                </tr>
            </tbody>
        </table>
    </div>
    
</div>
</body>
</html>
<?php
}
?>