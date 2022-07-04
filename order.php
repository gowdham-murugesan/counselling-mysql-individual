<?php
		include "db.php";

		$conn = mysqli_connect($servername, $user, $password, $database);
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}

		$id = $_GET['id'];
        $order = $_GET['order'];
        $email = $_COOKIE['uname'];

        if($order=='up')
        {
            mysqli_query($conn,"SET @b=$id;");
            mysqli_query($conn,"SET @c=(SELECT id from counselling WHERE email = '$email' AND id < $id ORDER BY id DESC LIMIT 1);");
            mysqli_query($conn,"UPDATE counselling SET id=IF(id=@b, @c, @b) where id in(@b,@c);");
            mysqli_query($conn,"SET @a:=0;");
            mysqli_query($conn,"UPDATE counselling SET id=@a:=@a+1 order by id;");
        }

        if($order=='down')
        {
            mysqli_query($conn,"SET @b=$id;");
            mysqli_query($conn,"SET @c=(SELECT id from counselling WHERE email = '$email' AND id > $id ORDER BY id ASC LIMIT 1);");
            mysqli_query($conn,"UPDATE counselling SET id=IF(id=@b, @c, @b) where id in(@b,@c);");
            mysqli_query($conn,"SET @a:=0;");
            mysqli_query($conn,"UPDATE counselling SET id=@a:=@a+1 order by id;");
        }

		if($order)
        {
            mysqli_close($conn); // Close connection
            header("location:crud.php#$id"); // redirects to all records page
            exit;	
        }
        else
        {
            echo "Error updating record"; // display error message if not delete
        }
        ?>