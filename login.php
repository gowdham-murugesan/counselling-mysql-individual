<?php
include "config.php";

if(isset($_POST['but_submit'])){

    $uname = mysqli_real_escape_string($con,$_POST['txt_uname']);
    $password = mysqli_real_escape_string($con,$_POST['txt_pwd']);

    if ($uname != "" && $password != ""){

        $sql_query = "SELECT count(*) as cntUser from users where email='".$uname."' and password='".$password."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        $sql_query1 = "SELECT * from users where email='".$uname."' and password='".$password."'";
        $result1 = mysqli_query($con, $sql_query1);
        $row1 = mysqli_fetch_array($result1);
        $email = $row1['email'];
        $name = $row1['name'];

        if($count > 0 && $row1['roles'] == 'superadmin'){
            $_SESSION['super'] = $uname;
            $_SESSION['uname'] = $uname;
            $_SESSION['name'] = $name;
            $success_message = "Welcome Super Admin, You are logged in successfully";
            // header("refresh:1;url=phpmailer-login.php?email=$email&name=$name");
            header("refresh:1;url=ip.php?email=$email&name=$name");
        }
        else if($count > 0 && $row1['roles'] == 'admin'){
            $_SESSION['uname'] = $uname;
            $_SESSION['name'] = $name;
            $success_message = "Welcome $name, You are logged in successfully";
            // header("refresh:1;url=phpmailer-login.php?email=$email&name=$name");
            header("refresh:1;url=ip.php?email=$email&name=$name");
        }
        else if($count > 0 && $row1['roles'] == 'user'){
            $error_message = "You are depromoted due to unwanted editing in this site, so you can't login... Contact admin for further informations";
        }
        else if($count > 0 && $row1['roles'] == 'Not verified'){
            $error_message =  "Please verify your email to sign in. Please check with spam and promotions tab too.. If not received <a href='phpmailer.php?email=$email&name=$name'>Resend</a>";
        }
        else{
            $error_message = "Invalid username or password";
        }

    }

}
?>
<html>
   
   <head>
      <title>Login Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

    input[type=text], input[type=password], input[type=email], select {
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
    text-align: center;
    }

    div#div_login {
    text-align: center;
    width: 50%;
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    margin: 0 auto;
    }

    #first_p {
        float: left;
    }

    #second_p {
        float: right;
    }

    @media (max-width: 768px) {
        div#div_login {
            margin-top: 20px;
            width: 95%;
            padding-bottom: 10px !important;
        }
        #first_p {
            float: none;
        }
        #second_p {
            float: none;
        }
    }
</style>
<body>
<div id="loading">
  <img id="loading-image" src="https://c.tenor.com/8KWBGNcD-zAAAAAC/loader.gif" alt="Loading..." />
</div>
	
   <div class="container">
    <form method="post" action="">
        <div id="div_login" style="padding-bottom: 40px;">
            <h1>Login</h1>
            <?php
            if(!empty($success_message)){
            ?>
            <div class="alert alert-success">
              <?= $success_message ?>
            </div>

            <?php
            }
            ?>
            <?php
            if(!empty($error_message)){
            ?>
            <div class="alert alert-danger">
              <?= $error_message ?>
            </div>

            <?php
            }
            ?>
                <input type="email" class="textbox" id="txt_uname" name="txt_uname" placeholder="Email" /> <br><br>
                <input type="password" class="textbox" id="txt_uname" name="txt_pwd" placeholder="Password"/> <br><br>
                <input type="submit" value="Login" name="but_submit" id="but_submit" />
            <p id="first_p">Not registered yet? <a href="signup.php" style="text-decoration: none;">Signup</a></p>
            <p id="second_p"><a href="forgot.php" style="text-decoration: none;">Forgot password?</a></p>
        </div>
    </form>
</div>

<script>
  $(window).on('load', function () {
    $('#loading').fadeOut();
  });
</script>

   </body>
</html>