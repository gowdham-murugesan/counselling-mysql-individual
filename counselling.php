<?php
include "config.php";

// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: login.php');
}

// logout
if(isset($_POST['but_logout'])){
  session_destroy();
  echo "<script>
  window.location.href='./login.php';
  alert('Successfully logged out');
  </script>";
}
?>

<?php
  include "db.php";
  $mysqli = new mysqli($servername, $user, $password, $database);
    
  // Checking for connections
  if ($mysqli->connect_error) {
      die('Connect Error (' . 
      $mysqli->connect_errno . ') '.
      $mysqli->connect_error);
  }

  $email = $_SESSION['uname'];
    
  // SQL query to select data from database
  $mysqli->query("SET @row_number = 0;");
  $sql = "SELECT (@row_number:=@row_number + 1) AS Serial, id, Choice_Order, College_Code, College_Name, Branch_Code, Branch_Name, Closing_Cutoff, Closing_Rank FROM counselling WHERE email = '$email' ORDER BY id;";
  $result = $mysqli->query($sql);
  $mysqli->close(); 
  ?>
<!DOCTYPE html>
<html>
<head>
<title>Choice List</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="assets/icon1.png" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
  * {
    box-sizing: border-box;
    font-weight: bold;
    font-size: 10pt;
    font-family: verdana;
  }

  html {
    scroll-behavior: smooth;
  }

  body {
    margin: 0;
    padding: 0;
  }

  .margin-8px {
    margin: 0 8px;
  }

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

  #customers {
    border-collapse: collapse;
    width: 100%;
  }

  #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
    line-height: 20px;
  }

  @media screen and (max-width: 400px) and (min-width: 360px) {
    #customers td, #customers th, #customers td > span {
    font-size: 6pt;
    line-height: 14px;
    }
    .button {
      width: 60px !important;
      font-size: 6pt;
      line-height: 14px;
    }
  }

  @media screen and (max-width: 360px) {
    #customers td, #customers th, .button, #customers td > span {
    font-size: 5pt;
    line-height: 10px;
    }
    .button {
      font-size: 5pt;
      line-height: 10px;
    }
  }

  @media screen and (max-width: 500px) and (min-width: 400px) {
    #customers td, #customers th, .button, #customers td > span {
    font-size: 7pt;
    line-height: 14px;
  }
  }

  #customers tr:nth-child(even){background-color: #f2f2f2;}

  #customers td:nth-child(1){width:10%; color: darkblue;}

  #customers td:nth-child(2){width:10%; color: darkviolet;}

  #customers td:nth-child(3){width:50%; color: green;}

  #customers td:nth-child(4){width:20%; color: crimson;}

  #customers td:nth-child(5){width:10%; color: darkslategrey;}

  #customers tr:hover {background-color: rgba(130, 226, 173, 0.05);}

  #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    background-color: rgb(168 64 64);
    color: white;
  }

  #myInput {
    background-image: url('https://www.w3schools.com/css/searchicon.png');
    background-position: 10px 10px;
    background-repeat: no-repeat;
    width: 100%;
    font-size: 16px;
    padding: 12px 20px 12px 40px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
  }

  h1, h2{
    text-align: center;
    color: darkred;
    font-size: 15pt;
  }

  .footer {
    text-align: center;
  position: sticky;
  bottom: 0px;
  background-color: gray;
  color: white;
  padding: 8px;
  }

  .fa {
    padding: 5px;
    font-size: 20px;
    width: 30px;
    text-align: center;
    text-decoration: none;
  }

  .fa-envelope {
    background: #dd4b39;
    color: white;
  }

  .fa-linkedin {
    background: #007bb5;
    color: white;
  }

  .fa-facebook {
    background: #3B5998;
    color: white;
  }

  .button {
  display: inline-block;
  width: 75px;
  padding: 5px 0px;
  text-align: center;
  border-radius: 5px;
  color: white;
  text-decoration: none;
  margin-top: 10px;
  margin-right: 10px;
  }

  @media (max-width:768px) {
    .button {
    padding: 5px 0px;
    margin-top: 10px;
    margin-right: 0;
    }
    .edit {
      margin-bottom: -5px;
    }
  }

  .icons {
    margin-right: 10px;
  }


  /* Navbar */

  /* NAVBAR STYLING STARTS */

    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 4px 40px 0px 40px;
      background-color: teal;
      color: #fff;
    }

    .navbar-checked {
      margin-bottom: 234px;
    }

    .navbar a {
      text-decoration: none;
    }

    .navbar li {
      list-style: none;
    }

    .nav-links a {
      color: #fff;
    }

    /* LOGO */
    .logo {
      font-size: 32px;
    }

    /* NAVBAR MENU */
    .menu {
      display: flex;
      gap: 1em;
      font-size: 18px;
      z-index: 1;
    }

    .menu li:hover {
      background-color: #4c9e9e;
      border-radius: 5px;
    }

    .menu li {
      padding: 12px 0;
    }

    .menu li a {
      font-size: 18px;
      padding: 12px;
    }

    .active-link {
      background-color: #4c9e9e;
      border-radius: 5px;
    }

    /* DROPDOWN MENU */
    .account {
      position: relative;
    }

    .dropdown {
      background-color: rgb(1, 139, 139);
      padding: 1em 0;
      position: absolute;
      /*WITH RESPECT TO PARENT*/
      display: none;
      border-radius: 8px;
      top: 48px;
      z-index: 1;
    }

    .dropdown li+li {
      margin-top: 10px;
    }

    .dropdown li {
      padding: 0.5em 1em;
      width: 12em;
      text-align: center;
    }

    .dropdown li:hover {
      background-color: #4c9e9e;
    }

    .dropdown li input {
      background: transparent;
      border: none;
      color: white;
      font-size: 11px;
      cursor: pointer;
    }

    .account:hover .dropdown {
      display: block;
    }

    /*RESPONSIVE NAVBAR MENU STARTS*/
    /* CHECKBOX HACK */
    input[type=checkbox] {
      display: none;
    }

    /*HAMBURGER MENU*/
    .hamburger {
      display: none;
      font-size: 24px;
      user-select: none;
    }

    #movetop {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 30px;
    z-index: 99;
    border: none;
    outline: none;
    background-color: #d94646;
    color: white;
    cursor: pointer;
    padding: 12px;
    border-radius: 2rem;
  }

  #movetop i {
      font-size: 24px;
      padding: 0 !important;
  }
  
  #movetop:hover {
    background-color: #555;
  }

    /* APPLYING MEDIA QUERIES */
    @media (max-width: 768px) {
      .menu {
        display: none;
        position: absolute;
        background-color: teal;
        top: 88px;
        right: 0;
        left: 0;
        text-align: center;
        padding: 16px 0;
      }

      .menu li:hover {
        display: inline-block;
        background-color: #4c9e9e;
        transition: 0.3s ease;
        padding: 12px;
      }

      .menu li+li {
        margin-top: 12px;
      }

      .menu li a {
      font-size: 14px;
      }

      input[type=checkbox]:checked~.menu {
        display: block;
      }

      .hamburger {
        display: block;
      }

      .dropdown {
        top: 50px;
        transform: translateX(-8%);
      }

      .dropdown li:hover {
        background-color: #4c9e9e;
      }

      .navbar {
        padding: 4px 40px 0px 20px;
      }
    }
</style>
</head>
<body>

<div id="loading">
  <img id="loading-image" src="https://c.tenor.com/8KWBGNcD-zAAAAAC/loader.gif" alt="Loading..." />
</div>

<!-- Move to Top -->
<button onclick="topFunction()" id="movetop" title="Go to top"><i class="fa fa-chevron-up w3-hover-opacity"></i></button>

<nav class="navbar" id="navbar">
    <!-- LOGO -->
    <div class="logo"><img src="assets/download bg.png" alt="LOGO" width="180px" style="filter: brightness(0) invert(1);">
    </div>
    <!-- NAVIGATION MENU -->
    <ul class="nav-links">
      <!-- USING CHECKBOX HACK -->
      <input type="checkbox" id="checkbox_toggle" onclick="checkbox();"/>
      <label for="checkbox_toggle" class="hamburger" id="checkbox-label">&#9776;</label>
      <!-- NAVIGATION MENUS -->
      <div class="menu">
        <li><a href="./counselling.php">Home</a></li>
        <li><a href="./crud.php" target="_blank">Edit</a></li>
        <li><a href="https://gowdham.herokuapp.com/" target="_blank">About us</a></li>
        <li><a href="https://gowdham.herokuapp.com/" target="_blank">Contact</a></li>
        <li class="account">
          <a><?php echo $_SESSION['name']?><i class="fa fa-chevron-down" style="padding: 0;"></i></a>
          <ul class="dropdown">
            <li>
              <a href="change.php" style="font-size: 11px; padding: 6px;">Change password</a>
            </li>
            <li>
              <form method='post' action="">
                <input type="submit" value="Logout" name="but_logout">
              </form>
            </li>
          </ul>
        </li>
      </div>
    </ul>
  </nav>

<div class="margin-8px">
  <h1 style="padding-top: 20px; padding-bottom: 20px; background: #9fddcc; border-radius: 5px;"><?php echo $_SESSION['name']?>'s TNEA Counselling Choice Filling Order</h1>
  <!-- <h2 style="color: rgb(139, 102, 0); margin-top: -10px;">For and By GOWDHAM M</h2> -->

  <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Choice Order, College Code, College Name, Branch Name..." title="Type in a name">
  <div style="text-align: right; margin-bottom: 10px;">
    
    <form method='post' action="">
    <a href="crud.php" class="button" style="background-color: green; width: 100px; padding: 10px 5px;" target="_blank">Edit</a>
              <!-- <input type="submit" value="Logout" name="but_logout" class="button" style="background-color: red; width: 100px; padding: 8px 4px; cursor: pointer;"> -->
          </form>
  </div>
  <table id="customers">
    <tr style="position: sticky; top: -1px;">
      <th>Choice Order</th>
      <th>College Code</th>
      <th>College Name</th>
      <th>Branch Name</th>
      <th>2020 Closing Cutoff (Rank) for BC</th>
    </tr>
              <!-- PHP CODE TO FETCH DATA FROM ROWS-->
              <?php   // LOOP TILL END OF DATA 
                  while($rows=$result->fetch_assoc())
                  {
              ?>
              <tr id=<?php echo $rows['id'];?>>
                  <!--FETCHING DATA FROM EACH 
                      ROW OF EVERY COLUMN-->
                  <td><?php echo $rows['Serial'];?></td>
                  <td><?php echo $rows['College_Code'];?></td>
                  <td><?php echo $rows['College_Name'];?></td>
                  <td><?php echo $rows['Branch_Name'];?><br><span style="color: green;">(<?php echo $rows['Branch_Code'];?>)</span></td>
                  <td><?php echo $rows['Closing_Cutoff'];?><br><span style="color: #e42c81;">(<?php echo $rows['Closing_Rank'];?>)</span></td>
              </tr>
              <?php
                  }
              ?>
          </table>
          <div class="footer">
    <span>Gowdham M | Reach me at <a href="mailto:gowdhammurugesh24@gmail.com" target="_blank" class="fa fa-envelope"></a> <a href="https://www.linkedin.com/in/gowdham-murugesan/" target="_blank" class="fa fa-linkedin"></a> <a href="fb://profile/100008861406990" target="_blank" class="fa fa-facebook" id="phonescreen"></a> <a href="https://www.facebook.com/gowdhammurugesh24/" target="_blank" class="fa fa-facebook" id="laptopscreen"></a></span>
  </div>
</div>

<script>
    $(document).ready(function() {
    $("[href]").each(function() {
        if (this.href == window.location.href) {
            $(this).addClass("active-link");
        }
    });
  });

  $(function(){
    $("#checkbox_toggle").change(function() {
      $("#navbar").toggleClass("navbar-checked", this.checked);
    }).change();
  });

  function checkbox() {
    var checkBox = document.getElementById("checkbox_toggle");

    if (checkBox.checked == true){
      document.getElementById("checkbox-label").innerHTML = "&#10006;"
    } else {
      document.getElementById("checkbox-label").innerHTML = "&#9776;"
    }
  }
</script>

<script>
  $(window).on('load', function () {
    $('#loading').fadeOut();
  });

  //Scroll to Top

  //Get the button
  var mybutton = document.getElementById("movetop");

  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      mybutton.style.display = "block";
  } else {
      mybutton.style.display = "none";
  }
  }

  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
  }
</script>

<script>
  if(screen.width < 600) {
    document.getElementById("laptopscreen").style.display = "none";
  }
  else {
    document.getElementById("phonescreen").style.display = "none";
  }
</script>
                              
<script>
  var list = document.getElementsByClassName("serial");
  for (var i = 1; i <= list.length; i++) {  
    list[i-1].innerHTML = i;
}
</script>

<script>
  function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("customers");
    tr = table.getElementsByTagName("tr");
  
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      td1 = tr[i].getElementsByTagName("td")[1];
      td2 = tr[i].getElementsByTagName("td")[2];
      td3 = tr[i].getElementsByTagName("td")[3];
      td4 = tr[i].getElementsByTagName("td")[4];
      if (td || td1 || td2 || td3 || td4) {
        txtValue = td.textContent || td.innerText;
        txtValue1 = td1.textContent || td1.innerText;
        txtValue2 = td2.textContent || td2.innerText;
        txtValue3 = td3.textContent || td3.innerText;
        txtValue4 = td4.textContent || td4.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1 || txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1 || txtValue3.toUpperCase().indexOf(filter) > -1 || txtValue4.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
</script>

</body>
</html>