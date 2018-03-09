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
  $name = trim($_POST['first_name']);
  $name = strip_tags($name);
  $name = htmlspecialchars($name);
  $last_name = trim($_POST['last_name']);
  $last_name = strip_tags($last_name);
  $last_name = htmlspecialchars($last_name);
  $gender = trim($_POST['gender']);
  $gender = strip_tags($gender);
  $gender = htmlspecialchars($gender);
  $birthday = trim($_POST['birthday']);
  $birthday = strip_tags($birthday);
  $birthday = htmlspecialchars($birthday);

  $user_email = trim($_POST['user_email']);
  $user_email = strip_tags($user_email);
  $user_email = htmlspecialchars($user_email);

  $user_pass = trim($_POST['user_pass']);
  $user_pass = strip_tags($user_pass);
  $user_pass = htmlspecialchars($user_pass);

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
  if ( !filter_var($user_email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {
   // check whether the email exist or not
   $query = "SELECT user_email FROM users WHERE user_email='$email'";
   $result = mysqli_query($conn, $query);
   $count = mysqli_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }
  // password validation
  if (empty($user_pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($user_pass) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }

  // password encrypt using SHA256();
  $password = $user_pass;

  // if there's no error, continue to signup
  if( !$error ) {

   $query = "INSERT INTO users (first_name ,last_name ,gender ,birthday ,user_email ,user_pass) VALUES('$name','$last_name','$gender' ,'$birthday' ,'$user_email' ,'$user_pass') ";
   $res = mysqli_query($conn, $query);

   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($user_email);
    unset($user_pass);
header("location: index.php");
exit;
  } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, please try again...";
   }

  }
 }
?>


<!DOCTYPE html>
<html>
<head>
       <title>Login form</title>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">


       <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>




       <style type="text/css">
       body{
        color: #FFFFFF;
        background-color: #eaecef;
       }

form{
background-color: #FFFFFF;
color: #CB2356;
  width: 50%;
  padding: 15px;
  margin: 0 auto;
  margin-top: 40px;
  margin-bottom: 20px;
  border: 2px solid black;
  border-radius: 10px;
}
.btn{
  background-color: #E23D80;
  border-color: black;
}.btn:hover{
  background-color: #CB2356;
  border-color: black;
}
#img{
  margin: 0 auto;
}
.chang{
  color: #FFFFFF;
}.chang:hover{
  color: #FFFFFF;
  text-decoration: none;
}
.navbar-dark .navbar-brand{
  color: #E23D80;
}.navbar-dark .navbar-brand:hover{
  color: #FFFFFF;
}
       </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
   <a class="navbar-brand"><i class="fab fa-leanpub fa-2x" style="color:#E23D80"></i></a>
      <a class="navbar-brand"><i class="fab fa-leanpub fa-2x" style="color:#E23D80"></i></a>


 <a class="navbar-brand" href="register.php" style="font-size: 26px;">

    The Big Library
  </a>
  <a class="navbar-brand"><i class="fab fa-leanpub fa-2x" style="color:#E23D80"></i></a>
  <a class="navbar-brand"><i class="fab fa-leanpub fa-2x" style="color:#E23D80"></i></a>


</nav>



<section>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">


             <h2>Sign Up.</h2>

             <hr />




            <?php
   if ( isset($errMSG) ) {

    ?>


             <div class="alert">

 <?php echo $errMSG; ?>

             </div>

 <?php
   }
   ?>
  <div class="form-row">

    <div class="form-group col-md-6">
      <label for="first_name">First name</label>
      <input type="text" class="form-control" id="validationCustom01" placeholder="First Name" name="first_name" value="<?php echo $name ?>" required />

      <span class="text-danger"><?php echo $nameError; ?></span>

    </div>
    <div class="form-group col-md-6">
      <label for="last_name">Last name</label>
      <input type="text" class="form-control" id="validationCustom02" placeholder="Last Name" name="last_name" value="<?php echo $last_name ?>" />
    </div>

     <div class="form-group col-md-6">
      <label for="gender">Gender</label>
  <select class="custom-select" name="gender" value="<?php echo $name ?>" />

    <option selected value="male">Male</option>
    <option selected value="female">Female</option>
    <option selected value="others">Others</option>
  </select>


    </div>

  <div class="form-group col-md-6">
      <label for="birthday">Birthdate</label>
      <input type="date" class="form-control" id="validationCustom03" name="birthday" value="<?php echo $birthday ?>" />
    </div>
  </div>
   <div class="form-row">
    <div class="form-group col-md-6">
      <label for="emailAddress">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="user_email" required value="<?php echo $user_email ?>" />

      <span class="text-danger"><?php echo $emailError; ?></span>

    </div>

    <div class="form-group col-md-6">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password" name="user_pass"  maxlength="15" required />

      <span class="text-danger"><?php echo $passError; ?></span>


    </div>
  </div>

  <button type="submit" class="btn btn-primary" style="padding-left: 30%; text-align: center; padding-right: 30%;" name="btn-signup">Register</button>

<button class="btn btn-primary"><a href="index.php" class="chang">Login</button>


</form>
</section>








   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>

<?php ob_end_flush(); ?>
