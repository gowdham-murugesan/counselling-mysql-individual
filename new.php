<?php 
include "config.php";
$email = $_GET['key'];
$token = $_GET['token'];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>New Password</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<?php 
$error_message = "";$success_message = "";

// Register user
if(isset($_POST['btnsignup'])){
   $password = trim($_POST['password']);
   $confirmpassword = trim($_POST['confirmpassword']);

   $isValid = true;

   // Check fields are empty or not
   if($password == '' || $confirmpassword == ''){
     $isValid = false;
     $error_message = "Please fill all fields.";
   }

   // Check if confirm password matching or not
   if($isValid && ($password != $confirmpassword) ){
     $isValid = false;
     $error_message = "Confirm password not matching";
   }

   // Insert records
   if($isValid){
     $con->query("UPDATE users SET password = '$password' WHERE email = '$email' and token = '$token';");

     $success_message = "Hi!!! Password changed successfully...";
    //  header( "refresh:3;url=login.php" );
    header("refresh:3;url=login.php");
   }
}
?>

<style>
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
    <div class='container'>
      <div class='row'>

      <form method='post' action=''>

            <h1>New Password</h1> <br>

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
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" id="password" required="required" maxlength="80">

            <label for="pwd">Confirm Password:</label>
            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" onkeyup='' required="required" maxlength="80">

            <input type="submit" name="btnsignup" class="btn btn-default"/>
            
            </form>

     </div>
    </div>
  </body>
</html>