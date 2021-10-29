<?php
include "config.php";
$email = $_GET['key'];
$token = $_GET['token'];

$con->query("UPDATE users SET roles = 'admin' WHERE email = '$email' and token = '$token';");
echo "<script>
			window.location.href='./login.php';
			alert('Verified successfully, Please login');
			</script>";
?>