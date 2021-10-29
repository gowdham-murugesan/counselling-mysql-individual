<?php
if(session_id() == '') {
  session_start();
}

$host = "sql6.freemysqlhosting.net"; /* Host name */
$user = "sql6434984"; /* User */
$password = "vA3VgpXckB"; /* Password */
$dbname = "sql6434984"; /* Database name */

// $host = "localhost"; /* Host name */
// $user = "root"; /* User */
// $password = "santhosh"; /* Password */
// $dbname = "mbsg"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
?>