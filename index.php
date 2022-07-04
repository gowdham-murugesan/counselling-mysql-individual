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

    .footer {
        width: 100%;
    text-align: center;
  position: fixed;
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

  .body h1 {
      text-align: center;
      font-size: 24px;
      color: darkred;
      background: #9fddcc;
      padding-top: 20px;
      padding-bottom: 20px;
  }

  /* Create two equal columns that floats next to each other */
    .column {
    float: left;
    width: 50%;
    padding: 10px;
    height: 300px; /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
    content: "";
    display: table;
    clear: both;
    }

    .second {
        padding-top: 56px;
    }

    .second h2 {
        font-size: 24px;
    }

    .second p {
        font-size: 16px;
        line-height: 1.8;
        margin-right: 96px;
    }

    .button {
  display: inline-block;
  border-radius: 4px;
  background-color: teal;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 0px 0px 12px 0px;
  width: 140px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}

    /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
    @media screen and (min-width: 480px) and (max-width: 1000px) {
    .column {
        width: 100%;
    }
    .second {
        margin-top: 100px;
        margin-left: 54px;
    }
    }
    @media screen and (max-width: 1000px) {
    .column {
        width: 100%;
    }
    .body h1 {
        font-size: 16px;
    }
    .second {
        padding-top: 0;
        margin-top: -72px;
    }
    .second h2 {
        font-size: 16px;
    }
    .second p {
        font-size: 10px;
        margin-right: auto;
    }
    .button {
        font-size: 24px;
        padding: 0px 0px 8px 0px;
        width: 120px;
    }
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
      cursor: pointer;
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
<!-- <button onclick="topFunction()" id="movetop" title="Go to top"><i class="fa fa-chevron-up w3-hover-opacity"></i></button> -->

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
        <li class="account">
          <a href="./login.php">Login</i></a>
        </li>
        <li class="account">
          <a href="./signup.php">Signup</i></a>
        </li>
      </div>
    </ul>
  </nav>

  <div class="body">
      <h1>Now TNEA Counselling is paperless, Then why not counselling preparation?</h1>

        <div class="row">
        <div class="column">
            <img src="./assets/home.png" alt="image" style="width: 100%;">
        </div>
        <div class="column second" >
            <h2>Prepare your Choice list here...</h2>
            <p>This Web application contains the list of all colleges with full details for TNEA counselling. You can create your preference order by just enter the college code or name, etc., You can also update your choice list by using CRUD (Create, Read, Update, Delete) opertaions.</p>
            <a href="counselling.php" class="button" style="vertical-align:middle"><span>Get Started</span></a>
        </div>
        </div>
  </div>

  <div class="footer">
    <span><span style="font-size: 12px;">Powered by</span> Gowdham M | Reach me at <a href="mailto:gowdhammurugesh24@gmail.com" target="_blank" class="fa fa-envelope"></a> <a href="https://www.linkedin.com/in/gowdham-murugesan/" target="_blank" class="fa fa-linkedin"></a> <a href="fb://profile/100008861406990" target="_blank" class="fa fa-facebook" id="phonescreen"></a> <a href="https://www.facebook.com/gowdhammurugesh24/" target="_blank" class="fa fa-facebook" id="laptopscreen"></a></span>
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

</body>
</html>