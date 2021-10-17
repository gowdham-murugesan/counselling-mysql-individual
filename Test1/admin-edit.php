<?php

include "config.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$qry = mysqli_query($con,"select * from users where id='$id'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $roles = $_POST['roles'];
	
    $edit = mysqli_query($con,"UPDATE users set roles='$roles' where id='$id'");
	
    if($edit)
    {
        mysqli_close($con); // Close connection
        header("location:admin.php"); // redirects to all records page
        exit;
    }
    else
    {
        echo mysqli_error();
    }    	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Users</title>
</head>
<body>
    <h3>Update Users</h3>

    <form method="POST">
    <input list="roles" type="text" name="roles" placeholder="Select role" Required>
    <datalist id="roles">
        <option value="user">
        <option value="admin">
    </datalist>
    <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
