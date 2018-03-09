<?php

 ob_start();

 session_start(); // start a new session or continues the previous

 if( isset($_SESSION['user'])!="" ){

  header("Location: home.php"); // redirects to home.php

 }

 include_once 'dbconnect.php';

 $error = false;

 if ( isset($_POST['btn-signup']) ) {



  // sanitize user input to prevent sql injection

  $name = trim($_POST['name']);

  $name = strip_tags($name);

  $name = htmlspecialchars($name);



  $email = trim($_POST['email']);

  $email = strip_tags($email);

  $email = htmlspecialchars($email);



  $pass = trim($_POST['pass']);

  $pass = strip_tags($pass);

  $pass = htmlspecialchars($pass);



  // basic name validation

  if (empty($name)) {

   $error = true;

   $nameError = "Please enter your full name.";

  } else if (strlen($name) < 3) {

   $error = true;

   $nameError = "Name must have atleat 3 characters.";

  } else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {

   $error = true;

   $nameError = "Name must contain alphabets and space.";

  }



  //basic email validation

  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

   $error = true;

   $emailError = "Please enter valid email address.";

  } else {

   // check whether the email exist or not

   $query = "SELECT userEmail FROM users WHERE userEmail='$email'";

   $result = mysqli_query($conn, $query);

   $count = mysqli_num_rows($result);

   if($count!=0){

    $error = true;

    $emailError = "Provided Email is already in use.";

   }

  }

  // password validation

  if (empty($pass)){

   $error = true;

   $passError = "Please enter password.";

  } else if(strlen($pass) < 6) {

   $error = true;

   $passError = "Password must have atleast 6 characters.";

  }



  // password encrypt using SHA256();

  $password = hash('sha256', $pass);



  // if there's no error, continue to signup

  if( !$error ) {



   $query = "INSERT INTO users(userName,userEmail,userPass) VALUES('$name','$email','$password')";

   $res = mysqli_query($conn, $query);



   if ($res) {

    $errTyp = "success";

    $errMSG = "Successfully registered, you may login now";

    unset($name);

    unset($email);

    unset($pass);

   } else {

    $errTyp = "danger";

    $errMSG = "Something went wrong, try again later...";

   }



  }



 }

?>


<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

     <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

     <title>Welcome - <?php echo $userRow['user_name']; ?></title>

    <style rel="stylesheet" href="stylesheet.css"> </style>






    <title>The Big library</title>
  </head>
  <body>





<!-- Image and text -->
<nav class="navbar navbar-dark bg-dark">
   <a class="navbar-brand" href="home.php" style="font-size: 26px;"> <i class="fab fa-leanpub fa-2x" style="color:#E23D80"></i> <span>The Big Library</span> </a>
      <a class="navbar-brand"></a>



 <a class="navbar-brand" >


  </a>



</nav>


  <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Sign in <i class="fas fa-sign-in-alt"></i> </h1>


 <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

             <hr/>


            <?php
   if ( isset($errMSG) ) {
echo $errMSG; ?>



                <?php
   }
   ?>







<input type="email" name="user_email" class="form-control" placeholder="Your Email" value="<?php echo $user_email; ?>" maxlength="40">



 <span class="text-danger"><?php echo $emailError; ?></span>






  <input type="password" name="user_pass" class="form-control" placeholder="Your Password" maxlength="15">



<span class="text-danger"><?php echo $passError; ?></span>


 <hr />
 <button type="submit" name="btn-login" class="btn btn-outline-info">Sign In.</button>
             <hr />
             <a href="register.php">Sign Up Here <i class="fas fa-user-plus"></i></a>
    </form>

        </div>
      </section>

<div class="container">
<ul class="nav nav-tabs" id="myTab" role="tablist"">
  <li class="nav-item">
    <a class="nav-link " id="home-tab" data-toggle="tab" href="#all" role="tab" aria-controls="home" aria-selected="ALL">All</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#book" role="tab" aria-controls="profile" aria-selected="false">Book</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#dvd" role="tab" aria-controls="contact" aria-selected="false">Dvd</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#cd" role="tab" aria-controls="contact" aria-selected="false">Cd</a>
  </li>
</ul>
</div>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="home-tab">

    <?php
$sql1 = "SELECT * FROM media";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) {
  echo '
  <main role="main" class="main">
    <div class="album py-5 " style="background-color: #ccc;">
        <div class="container">
    <div class="row">
          ';
    while($row1 = $result1->fetch_assoc()) {
      echo '

       <div class="col-md-4">
             <div class="card">
          <img class="card-img-top" src='.$row1["image"].' alt="Card image cap" width="40px">
          <div class="card-body">
            <h5 class="card-title"> Title : '.$row1["title"].'</h5>
            <p class="card-text">"'.$row1["description"].'"</p>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"> Iteme-number : '.$row1["fk_author_id"].'</li>
            <li class="list-group-item"> Type : '.$row1["type"].'</li>
            <li class="list-group-item"> ISBN : '.$row1["ISBN"].'</li>
          </ul>

        </div>
            </div>
            ';
    }
       echo "
           </div>
          </div>
        </div>
      </main>";
 } else {
    echo "0 results";
}
?>
  </div>
  <div class="tab-pane fade" id="book" role="tabpanel" aria-labelledby="profile-tab">
        <?php
          $sql2 = "SELECT * FROM media WHERE type='book'";
          $result2 = $conn->query($sql2);
          if ($result2->num_rows > 0) {
            echo '
            <main role="main" class="main">
              <div class="album py-5 " style="background-color: #ccc;">
                  <div class="container">
              <div class="row">
                    ';
              while($row2 = $result2->fetch_assoc()) {
                echo '

                 <div class="col-md-4">
                       <div class="card">
                    <img class="card-img-top" src='.$row2["image"].' alt="Card image cap" width="40px">
                    <div class="card-body">
                      <h5 class="card-title"> Title : '.$row2["title"].'</h5>
                      <p class="card-text">"'.$row2["description"].'"</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item"> Iteme-number : '.$row2["fk_author_id"].'</li>
                      <li class="list-group-item"> Type : '.$row2["type"].'</li>
                      <li class="list-group-item"> ISBN : '.$row2["ISBN"].'</li>
                    </ul>

                  </div>
                      </div>
                      ';
              }
                 echo "
                     </div>
                    </div>
                  </div>
                </main>";
           } else {
              echo "0 results";
          }

          ?>

  </div>
  <div class="tab-pane fade" id="cd" role="tabpanel" aria-labelledby="contact-tab">
        <?php
          $sql3 = "SELECT * FROM media WHERE type='cd'";
          $result3 = $conn->query($sql3);
          if ($result3->num_rows > 0) {
            echo '
            <main role="main" class="main">
              <div class="album py-5 " style="background-color: #ccc;">
                  <div class="container">
              <div class="row">
                    ';
              while($row3 = $result3->fetch_assoc()) {
                echo '

                 <div class="col-md-4">
                       <div class="card">
                    <img class="card-img-top" src='.$row3["image"].' alt="Card image cap" width="40px">
                    <div class="card-body">
                      <h5 class="card-title"> Title : '.$row3["title"].'</h5>
                      <p class="card-text">"'.$row3["description"].'"</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item"> Iteme-number : '.$row3["fk_author_id"].'</li>
                      <li class="list-group-item"> Type : '.$row3["type"].'</li>
                      <li class="list-group-item"> ISBN : '.$row3["ISBN"].'</li>
                    </ul>

                  </div>
                      </div>
                      ';
              }
                 echo "
                     </div>
                    </div>
                  </div>
                </main>";
           } else {
              echo "0 results";
          }
          ?>
  </div>
  <div class="tab-pane fade" id="dvd" role="tabpanel" aria-labelledby="contact-tab">
     <?php
          $sql4 = "SELECT * FROM media WHERE type='dvd'";
          $result4 = $conn->query($sql4);
          if ($result4->num_rows > 0) {
            echo '
            <main role="main" class="main">
              <div class="album py-5 " style="background-color: #ccc;">
                  <div class="container">
              <div class="row">
                    ';
              while($row4 = $result4->fetch_assoc()) {
                echo '

                 <div class="col-md-4">
                       <div class="card">
                    <img class="card-img-top" src='.$row4["image"].' alt="Card image cap" width="40px">
                    <div class="card-body">
                      <h5 class="card-title"> Title : '.$row4["title"].'</h5>
                      <p class="card-text">"'.$row4["description"].'"</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item"> Iteme-number : '.$row4["fk_author_id"].'</li>
                      <li class="list-group-item"> Type : '.$row4["type"].'</li>
                      <li class="list-group-item"> ISBN : '.$row4["ISBN"].'</li>
                    </ul>

                  </div>
                      </div>
                      ';
              }
                 echo "
                     </div>
                    </div>
                  </div>
                </main>";
           } else {
              echo "0 results";
          }
          ?>
   </div>
</div>
 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
</body>
</html>
