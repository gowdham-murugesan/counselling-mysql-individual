<?php
		include "db.php";

		$conn = mysqli_connect($servername, $user, $password, $database);
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}

		$id = $_GET['id'];

		$del = mysqli_query($conn,"DELETE FROM counselling where Choice_Order='$id';");

        mysqli_query($conn,"SET @a:=0;");
        mysqli_query($conn,"UPDATE counselling SET id=@a:=@a+1 order by id;");

		if($del)
        {
            mysqli_close($conn); // Close connection
            header("location:crud.php#$id"); // redirects to all records page
            exit;	
        }
        else
        {
            echo "Error deleting record"; // display error message if not delete
        }
        ?>