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
$user = $_SESSION['sess_user'];
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include "db.php";



if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
} 

$sorgu = $mysqli->query("SELECT * FROM books 
LEFT JOIN reservation ON books.Book_ID = reservation.Book_ID
LEFT JOIN users ON users.uid = reservation.Reserved_ID");


if(!$sorgu) {
  die('Invalid query: ' . $mysqli->error);
}


$books = $sorgu->fetch_all(MYSQLI_ASSOC);









?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/reserve.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>BID</title>
</head>

<body>

  <div class="col">
    <div class="e-tabs mb-3 px-3">
  
    </div>
    <div class="row flex-lg-nowrap">
      <div class="col mb-3">
        <div class="e-panel card">
          <div class="card-body">
            <div class="card-title">
            </div>
            <div class="e-table">
              <div class="table-responsive table-lg mt-3">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="align-top">
                     
                      </th>
                      <th>Photo</th>
                      <th>Category</th>
                      <th>Book</th>
                      <th class="max-width">Name</th>
                      <th>Stock Situation</th>
                      <th>Reserve Time</th>
                      <th>End Time</th>
                    </tr>
                  </thead>
                  <tbody>


                


                    <?php foreach ($books as $satirNo => $book){ 
                      
                      ?>
                      <tr>
                        <td class="align-middle">
                  
                        </td>
                        <td class="align-middle text-center">
                          <a class="align-middle text-center" href="#"><img src=images/<?=$book["Photo"]?> style="width: 35px; height: 35px; border-radius: 35px"></a>
                        </td>
                        <td class="text-nowrap align-middle"><?=$book["Category"]?></td>
                        <td class="text-nowrap align-middle"><span><?=$book["Title"]?></span></td>
                        <td class="text-nowrap align-middle"><?=$book["user_name"] ?? NULL?></td>
                        <td class="text-nowrap align-middle"><span><?=$book["Statuss"]?></span></td>
                        <td class="text-nowrap align-middle"><span><?=$book["Reserved_Time"] ?? NULL?></span></td>
                        <td class="text-nowrap align-middle"><span><?=$book["end_time"] ?? NULL ?></span></td>
                        </td>
                      </tr>

                    <? } ?>





                      <tr>


                    



                      <td class="align-middle">
                        
                    
                      </td>
                      <td class="align-middle text-center">
                        <a class="align-middle text-center" href="#"><img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcS4Cj-F4SNBtwiQg5tHZPYVv7VF6Bj0Nw-gheh8AiKvsMd2blYh" style="width: 35px; height: 35px; border-radius: 35px"></a>
                      </td>
                      <td class="text-nowrap align-middle">ACTION</td>
                      <td class="text-nowrap align-middle"><span>Angels and Demons</span></td>
                      <td class="text-nowrap align-middle">Büşra Nur Yaylaoğlu</td>
                      <td class="text-nowrap align-middle"><span>Available</span></td>
                      <td class="text-nowrap align-middle"><span>12:30 - 10 Mar 2022</span></td>
                      <td class="text-nowrap align-middle"><span>11:10 - 11 Mar 2022</span></td>
                      </td>
                    </tr>

                    <tr>
                      <td class="align-middle">
                     
                      </td>
                      <td class="align-middle text-center">
                        <a class="align-middle text-center" href="#"><img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcS4Cj-F4SNBtwiQg5tHZPYVv7VF6Bj0Nw-gheh8AiKvsMd2blYh" style="width: 35px; height: 35px; border-radius: 35px"></a>
                      </td>
                      <td class="text-nowrap align-middle">SCIENCE</td>
                      <td class="text-nowrap align-middle"><span>The Theory of Relativity</span></td>
                      <td class="text-nowrap align-middle">Büşra Nur Yaylaoğlu</td>
                      
                      <td class="text-nowrap align-middle"><span>Reserved</span></td>
                      <td class="text-nowrap align-middle"><span>12:12 - 12 Mar 2022</span></td>
                      <td class="text-nowrap align-middle"><span>15:37 - 14 Mar 2022</span></td>
                    </tr>
                    <tr>
                      <td class="align-middle">
                      
                      </td>
                      <td class="align-middle text-center">
                        <a class="align-middle text-center" href="#"><img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcS4Cj-F4SNBtwiQg5tHZPYVv7VF6Bj0Nw-gheh8AiKvsMd2blYh" style="width: 35px; height: 35px; border-radius: 35px"></a>
                      </td>
                      <td class="text-nowrap align-middle">PHILOSOPHY</td>
                      <td class="text-nowrap align-middle"><span>Apology</span></td>
                      <td class="text-nowrap align-middle">Şule Nigar İşcioğlu</td>
                      
                      <td class="text-nowrap align-middle"><span>Reserved</span></td>
                      <td class="text-nowrap align-middle"><span>07:28 - 15 Mar 2022</span></td>
                      <td class="text-nowrap align-middle"><span>16:45 - 15 Mar 2022</span></td>
                    </tr>
                    <tr>
                      <td class="align-middle">
                    
                      </td>
                      <td class="align-middle text-center">
                        <a class="align-middle text-center" href="#"><img src="https://www.hozcomics.com/975-large_default/essegesse-tommiks-01.jpg" style="width: 35px; height: 35px; border-radius: 35px"></a>
                      </td>
                      <td class="text-nowrap align-middle">COMICS</td>
                      <td class="text-nowrap align-middle"><span>Tommiks</span></td>
                      <td class="text-nowrap align-middle">Emir Zekeriya Tüccar</td>
                      <td class="text-nowrap align-middle"><span>Available</span></td>
                      <td class="text-nowrap align-middle"><span>19:00 - 15 Mar 2022</span></td>
                      <td class="text-nowrap align-middle"><span>12:53 - 17 Mar 2022</span></td>
                    </tr>
                    <tr>
                        </div>
                      </td>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
            </div>
          </div>
        </div>
      </div>
    </div>
            </div>
          </div>
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