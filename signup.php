<?php 
include "config.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Signup Page</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<?php 
$error_message = "";$success_message = "";

// Register user
if(isset($_POST['btnsignup'])){
   $fname = trim($_POST['fname']);
   $email = trim($_POST['email']);
   $password = trim($_POST['password']);
   $confirmpassword = trim($_POST['confirmpassword']);

   $isValid = true;

   // Check fields are empty or not
   if($fname == '' || $email == '' || $password == '' || $confirmpassword == ''){
     $isValid = false;
     $error_message = "Please fill all fields.";
   }

   // Check if confirm password matching or not
   if($isValid && ($password != $confirmpassword) ){
     $isValid = false;
     $error_message = "Confirm password not matching";
   }

   // Check if Email-ID is valid or not
   if ($isValid && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $isValid = false;
     $error_message = "Invalid Email-ID.";
   }

   if($isValid){

     // Check if Email-ID already exists
     $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $result = $stmt->get_result();
     $stmt->close();
     if($result->num_rows > 0){
       $isValid = false;
       $error_message = "Email-ID is already existed.";
     }

   }

   // Insert records
   if($isValid){
     $con->query("ALTER TABLE users AUTO_INCREMENT = 1;");
     $insertSQL = "INSERT INTO users(name, email, password, roles) values(?,?,?,'Not verified')";
     $stmt = $con->prepare($insertSQL);
     $stmt->bind_param("sss",$fname,$email,$password);
     $stmt->execute();
     $stmt->close();

     $success_message = "Hi $fname!!! Account created successfully, Please verify your email by clicking the link sent to your email";
    //  header( "refresh:3;url=login.php" );
    header("refresh:3;url=phpmailer.php?email=$email&name=$fname");
   }
}
?>

<style>
    #loading {
    position: fixed;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    opacity: 0.7;
    background-color: #fff;
    z-index: 99;
  }

  #loading-image {
    z-index: 100;
  }

  input[type=text], input[type=password], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
  }

  input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  input[type=submit]:hover {
    background-color: #45a049;
  }

  div.container {
    width: 50% !important;
    margin-top: 20px;
    width: 90%;
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
  }

  .row {
      margin-right: 0px;
      margin-left: 0px;
      border-radius: 5px;
      background-color: #f2f2f2;
      padding: 20px;
      margin: 0 auto;
  }

  @media (max-width: 768px) {
      div.container {
          width: 80% !important;
      }
  }
</style>

  </head>
  <body>
  <div id="loading">
    <img id="loading-image" src="https://c.tenor.com/8KWBGNcD-zAAAAAC/loader.gif" alt="Loading..." />
  </div>
    <div class='container'>
      <div class='row'>

      <form method='post' action=''>

            <h1>Sign Up</h1> <br>

            <?php 
            // Display Error message
            if(!empty($error_message)){
            ?>
            <div class="alert alert-danger">
              <strong>Error!</strong> <?= $error_message ?>
            </div>

            <?php
            }
            ?>

            <?php 
            // Display Success message
            if(!empty($success_message)){
            ?>
            <div class="alert alert-success">
              <strong>Success!</strong> <?= $success_message ?>
            </div>

            <?php
            }
            ?>

            <label for="fname">Name:</label>
            <input type="text" class="form-control" name="fname" id="fname" required="required" maxlength="80">
            <br>
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email" id="email" required="required" maxlength="80">
            <br>
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" required="required" maxlength="80">

            <label for="pwd">Confirm Password:</label>
            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" onkeyup='' required="required" maxlength="80">

            <input type="submit" name="btnsignup" class="btn btn-default"/>

            <p>Registered already? <a href="login.php">Login</a></p>
            </form>

     </div>
    </div>
    <script>
      $(window).on('load', function () {
        $('#loading').fadeOut();
      });
    </script>
  </body>
</html>