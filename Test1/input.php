<?php
include "config.php";

// Check user login or not
if(!isset($_SESSION['uname'])){
    header('Location: login.php');
}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Choice List - INPUT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="./counsellingcode.js"></script>
	<script src="./counsellingrank.js"></script>
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

		input[type=text], input[type=number], select {
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

		div {
		border-radius: 5px;
		background-color: #f2f2f2;
		padding: 20px;
		}

		::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
		color: black;
		opacity: 1; /* Firefox */
		}

		:-ms-input-placeholder { /* Internet Explorer 10-11 */
		color: black;
		}

		::-ms-input-placeholder { /* Microsoft Edge */
		color: black;
		}

		#p_Branch_Code, #p_Branch_Name, #p_Closing_Cutoff, #p_Closing_Rank {
			display: none;
		}
	</style>
</head>

<body>
<div id="loading">
  <img id="loading-image" src="https://c.tenor.com/8KWBGNcD-zAAAAAC/loader.gif" alt="Loading..." />
</div>
		<h1>Storing Form data in Database</h1>
<div>
		<form action="" method="post">
			
			
<p id="p_College_Code">
				<label for="College_Code">College Code :</label>
				<input type="number" name="College_Code" id="College_Code" placeholder="Enter College Code..." autocomplete="off" oninput="Code(); Cutoff(); return false;">
			</p>



			
			
<p id="p_College_Name">
				<label for="College_Name">College Name :</label>
				<select name="College_Name" id="College_Name" autocomplete="off" onchange="College(); Cutoff(); return false;">
					<option value="" disabled selected hidden>Select College Name...</option>
				</select>
			</p>



			
			
<p id="p_Branch_Code">
				<label for="Branch_Code">Branch Code :</label>
				<select name="Branch_Code" id="Branch_Code" onchange="Branch(); Cutoff(); return false;">
					<option value="" disabled selected hidden>Select Branch Code...</option>
				</select>
			</p>



			
			
<p id="p_Branch_Name">
				<label for="Branch_Name">Branch Name :</label>
				<select name="Branch_Name" id="Branch_Name" onchange="BranchName(); Cutoff(); return false;">
					<option value="" disabled selected hidden>Select Branch Name...</option>
				</select>
			</p>


			
			
			
<p id="p_Closing_Cutoff">
				<label for="Closing_Cutoff">Closing Cutoff :</label>
				<input type="text" name="Closing_Cutoff" id="Closing_Cutoff" autocomplete="off" value="197">
			</p>


			
			
			
<p id="p_Closing_Rank">
				<label for="Closing_Rank">Closing Rank :</label>
				<input type="text" name="Closing_Rank" id="Closing_Rank" autocomplete="off" value="105">
			</p>


			
			<input type="submit" value="Submit" name="SubmitButton">
		</form>
	</div>

		<?php
		include "db.php";
		
		if(isset($_POST['SubmitButton'])){

		// servername => localhost
		// username => root
		// password => empty
		// database name => staff
		$conn = mysqli_connect($servername, $user, $password, $database);
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}

		$email = $_SESSION['uname'];
		
		// Taking all 5 values from the form data(input)
		$College_Code = $_REQUEST['College_Code'];
		$College_Name = $_REQUEST['College_Name'];
		$Branch_Code = $_REQUEST['Branch_Code'];
		$Branch_Name = $_REQUEST['Branch_Name'];
		$Closing_Cutoff = $_REQUEST['Closing_Cutoff'];
		$Closing_Rank = $_POST['Closing_Rank'];
		
		// Performing insert query execution
		// here our table name is college
		$conn->query("ALTER TABLE counselling AUTO_INCREMENT = 1");
		$sql = "INSERT INTO counselling (College_Code, College_Name, Branch_Code, Branch_Name, Closing_Cutoff, Closing_Rank, email)
				VALUES ('$College_Code', '$College_Name', '$Branch_Code', '$Branch_Name', '$Closing_Cutoff', '$Closing_Rank', '$email')";		
		
		if(mysqli_query($conn, $sql)){

			$conn->query("SET @count = (SELECT COUNT(*) FROM counselling);");
            $conn->query("UPDATE counselling SET id = @count WHERE id = 0;");
			$conn->query("SET @a:=0;");
			$conn->query("UPDATE counselling SET id=@a:=@a+1 order by id;");

			// echo "<h3>Data stored in database successfully."
			// 	. " Please browse your localhost php my admin"
			// 	. " to view the updated data</h3>";

			// echo nl2br("\nCollege_Code : $College_Code\n College_Name : $College_Name\n "
			// 	. "Branch_Name : $Branch_Name\n Closing_Cutoff : $Closing_Cutoff");

			echo "<script>
			window.location.href='./crud.php';
			alert('Successfully added');
			</script>";
		} else{
			echo "ERROR: Hush! Sorry $sql. "
				. mysqli_error($conn);
		}
		
		// Close connection
		mysqli_close($conn);
	}
		?>

	<script>
	$(window).on('load', function () {
		$('#loading').fadeOut();
	});
	</script>
	
	<script>
			var testarray = [...new Set(counsellingcode.map(item => item.con))];
			testarray.sort();

			var selectTag = document.getElementById("College_Name");
			testarray.forEach(function(item, index, array) {
			var opt = document.createElement("option");
			opt.text = item;
			opt.value = item;
			selectTag.add(opt);
			});

			function College() {
				var college = document.getElementById('College_Name').value;
				let collegecode = counsellingcode.filter(obj => {
				return obj.con === college;
			})
				var collegecode1 = collegecode[0].coc;
				document.getElementById('College_Code').value = collegecode1;

				var sel = document.getElementById('Branch_Name');
				for (i = sel.length - 1; i > 0; i--) {
					sel.remove(i);
				}
				var sel = document.getElementById('Branch_Code');
				for (i = sel.length - 1; i > 0; i--) {
					sel.remove(i);
				}

				var selectTag1 = document.getElementById("Branch_Name");
				collegecode.forEach(function(item, index, array) {
				var opt1 = document.createElement("option");
				opt1.text = item.brn;
				opt1.value = item.brn;
				selectTag1.add(opt1);
				});
				var selectTag2 = document.getElementById("Branch_Code");
				collegecode.forEach(function(item, index, array) {
				var opt2 = document.createElement("option");
				opt2.text = item.brc;
				opt2.value = item.brc;
				selectTag2.add(opt2);
				});
				document.getElementById("p_Branch_Code").style.display = "block";
				document.getElementById("p_Branch_Name").style.display = "block";
			}

			function Code() {
				var code = document.getElementById('College_Code').value;
				code = parseInt(code);
				let code1 = counsellingcode.filter(obj1 => {
				return obj1.coc === code;
			})
				var collegecode2 = code1[0].con;
				document.getElementById('College_Name').value = collegecode2;

				var sel = document.getElementById('Branch_Name');
				for (i = sel.length - 1; i > 0; i--) {
					sel.remove(i);
				}
				var sel = document.getElementById('Branch_Code');
				for (i = sel.length - 1; i > 0; i--) {
					sel.remove(i);
				}

				var selectTag1 = document.getElementById("Branch_Name");
				code1.forEach(function(item, index, array) {
				var opt1 = document.createElement("option");
				opt1.text = item.brn;
				opt1.value = item.brn;
				selectTag1.add(opt1);
				});
				var selectTag2 = document.getElementById("Branch_Code");
				code1.forEach(function(item, index, array) {
				var opt2 = document.createElement("option");
				opt2.text = item.brc;
				opt2.value = item.brc;
				selectTag2.add(opt2);
				});
				document.getElementById("p_Branch_Code").style.display = "block";
				document.getElementById("p_Branch_Name").style.display = "block";
			}

			function Branch() {
				var branchCode = document.getElementById('Branch_Code').value;
				let branchCode1 = counsellingcode.filter(obj1 => {
				return obj1.brc === branchCode;
			})
				var branchCode2 = branchCode1[0].brn;
				document.getElementById('Branch_Name').value = branchCode2;
				document.getElementById("p_Closing_Cutoff").style.display = "block";
				document.getElementById("p_Closing_Rank").style.display = "block";
			}

			function BranchName() {
				var branchName = document.getElementById('Branch_Name').value;
				let branchName1 = counsellingcode.filter(obj1 => {
				return obj1.brn === branchName;
			})
				var branchName2 = branchName1[0].brc;
				document.getElementById('Branch_Code').value = branchName2;
				document.getElementById("p_Closing_Cutoff").style.display = "block";
				document.getElementById("p_Closing_Rank").style.display = "block";
			}

			function Cutoff() {
				var college = document.getElementById('College_Name').value;
				var code = document.getElementById('College_Code').value;
				var branch = document.getElementById('Branch_Name').value;
				let collegecutoff = counsellingcode.filter(obj => {
					return obj.con == college &&
					       obj.coc == code &&
						   obj.brn == branch;
				});
				var collegecutoff2 = collegecutoff[0].BC;
				document.getElementById('Closing_Cutoff').value = collegecutoff2;

				let collegerank = counsellingrank.filter(obj => {
					return obj.con == college &&
					       obj.coc == code &&
						   obj.brn == branch;
				});
				console.log(collegerank);
				var collegerank2 = collegerank[0].BC;
				console.log(collegerank2);
				document.getElementById('Closing_Rank').value = collegerank2;
			}
	</script>
</body>

</html>