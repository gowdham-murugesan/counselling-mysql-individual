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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<style>
  * {
    box-sizing: border-box;
    font-weight: bold;
    font-size: 10pt;
    font-family: verdana;
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
    margin: 2px 2px;
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

</style>
</head>
<body>

<div id="loading">
  <img id="loading-image" src="https://c.tenor.com/8KWBGNcD-zAAAAAC/loader.gif" alt="Loading..." />
</div>

<h1>TNEA Counselling Choice Filling Order</h1>
<h2 style="color: rgb(139, 102, 0); margin-top: -10px;">For and By GOWDHAM M</h2>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Choice Order, College Code, College Name, Branch Name..." title="Type in a name">
<div style="text-align: right; margin-bottom: 10px;">
  <a href="crud.php" target="_blank" class="button" style="background-color: green; width: 100px; padding: 10px 5px;">Edit</a>
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
            <tr id="row<?php echo $rows['id'];?>">
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
                <td><?php echo $rows['Serial'];?></td>
                <td><?php echo $rows['College_Code'];?></td>
                <td><?php echo $rows['College_Name'];?></td>
                <td><?php echo $rows['Branch_Name'];?><br><span style="color: green;">(<?php echo $rows['Branch_Code'];?>)</span></td>
                <td><?php echo $rows['Closing_Cutoff'];?><br><span style="color: #e42c81;">(<?php echo $rows['Closing_Rank'];?>)</span></td>
            </tr>

            <script>
              var rank = <?php echo $rows['Closing_Rank'];?>;
              var id = <?php echo $rows['id'];?>;
              var rowid = "row" + id;
              if(rank < 12000) {
                document.getElementById(rowid).style.backgroundColor = "#ff000050";
              }
              else if(rank > 18000) {
                document.getElementById(rowid).style.backgroundColor = "lightgreen";
              }
              else {
                document.getElementById(rowid).style.backgroundColor = "yellow";
              }
            </script>

            <?php
                }
             ?>
        </table>
        <div class="footer">
  <span>Gowdham M | Reach me at <a href="mailto:gowdhammurugesh24@gmail.com" target="_blank" class="fa fa-envelope"></a> <a href="https://www.linkedin.com/in/gowdham-murugesan/" target="_blank" class="fa fa-linkedin"></a> <a href="fb://profile/100008861406990" target="_blank" class="fa fa-facebook" id="phonescreen"></a> <a href="https://www.facebook.com/gowdhammurugesh24/" target="_blank" class="fa fa-facebook" id="laptopscreen"></a></span>
</div>

<script>
  if(screen.width < 600) {
    document.getElementById("laptopscreen").style.display = "none";
  }
  else {
    document.getElementById("phonescreen").style.display = "none";
  }
</script>
                              
<script>
  $(window).on('load', function () {
    $('#loading').fadeOut();
  });
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