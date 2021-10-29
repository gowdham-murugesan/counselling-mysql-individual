<?php
		include "db.php";

		$conn = mysqli_connect($servername, $user, $password, $database);
		
		// Check connection
		if($conn === false){
			die("ERROR: Could not connect. "
				. mysqli_connect_error());
		}

		$id = $_GET['id'];

		$qry = mysqli_query($conn,"SELECT * FROM counselling where Choice_Order='$id';");

		$data = mysqli_fetch_array($qry);

		if(isset($_POST['SubmitButton'])){
		
		// Taking all 5 values from the form data(input)
		$College_Code = $_POST['College_Code'];
		$College_Name = $_POST['College_Name'];
		$Branch_Code = $_POST['Branch_Code'];
		$Branch_Name = $_POST['Branch_Name'];
		$Closing_Cutoff = $_POST['Closing_Cutoff'];
		$Closing_Rank = $_POST['Closing_Rank'];
		
		// Performing insert query execution
		// here our table name is college
		// $conn->query("ALTER TABLE sql6434984.counselling AUTO_INCREMENT = 1");
		$edit = mysqli_query($conn,"UPDATE counselling SET College_Code='$College_Code', College_Name='$College_Name', Branch_Code='$Branch_Code', Branch_Name='$Branch_Name', Closing_Cutoff='$Closing_Cutoff', Closing_Rank='$Closing_Rank' WHERE Choice_Order='$id'");
		
		if($edit)
		{
			mysqli_close($conn); // Close connection
			header("location:crud.php#$id"); // redirects to all records page
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
	</style>
</head>

<body>
<div id="loading">
  <img id="loading-image" src="https://c.tenor.com/8KWBGNcD-zAAAAAC/loader.gif" alt="Loading..." />
</div>
		<h1>Edit data in Database</h1>
<div>
		<form action="" method="post">
			
			
<p>
				<label for="College_Code">College Code :</label>
				<input type="number" name="College_Code" id="College_Code" value="<?php echo $data['College_Code'] ?>" autocomplete="off" oninput="Code(); Cutoff(); return false;">
			</p>



			
			
<p>
				<label for="College_Name">College Name :</label>
				<select name="College_Name" id="College_Name" autocomplete="off" onchange="College(); Cutoff(); return false;">
					<option value="<?php echo $data['College_Name'] ?>" selected hidden><?php echo $data['College_Name'] ?></option>
				</select>
			</p>



			
			
<p>
				<label for="Branch_Code">Branch Code :</label>
				<select name="Branch_Code" id="Branch_Code" onchange="Branch(); Cutoff(); return false;">
					<option value="<?php echo $data['Branch_Code'] ?>" selected hidden><?php echo $data['Branch_Code'] ?></option>
				</select>
			</p>



			
			
<p>
				<label for="Branch_Name">Branch Name :</label>
				<select name="Branch_Name" id="Branch_Name" onchange="BranchName(); Cutoff(); return false;">
					<option value="<?php echo $data['Branch_Name'] ?>" selected hidden><?php echo $data['Branch_Name'] ?></option>
				</select>
			</p>


			
			
			
<p>
				<label for="Closing_Cutoff">Closing Cutoff :</label>
				<input type="text" name="Closing_Cutoff" id="Closing_Cutoff" value="<?php echo $data['Closing_Cutoff'] ?>" autocomplete="off">
			</p>


			
			
			
<p>
				<label for="Closing_Rank">Closing Rank :</label>
				<input type="text" name="Closing_Rank" id="Closing_Rank" autocomplete="off" value="<?php echo $data['Closing_Rank'] ?>">
			</p>


			
			<input type="submit" value="Submit" name="SubmitButton">
		</form>
	</div>

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

			var college = "<?php echo $data['College_Name'] ?>";
				let collegecode = counsellingcode.filter(obj => {
				return obj.con === college;
				})

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

			function College() {
				var college = document.getElementById('College_Name').value;
				let collegecode = counsellingcode.filter(obj => {
				return obj.con === college;
				})
				var collegecode1 = collegecode[0].coc;
				document.getElementById('College_Code').value = collegecode1;

				var sel = document.getElementById('Branch_Name');
				for (i = sel.length - 1; i >= 0; i--) {
					sel.remove(i);
				}
				var sel = document.getElementById('Branch_Code');
				for (i = sel.length - 1; i >= 0; i--) {
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
				for (i = sel.length - 1; i >= 0; i--) {
					sel.remove(i);
				}
				var sel = document.getElementById('Branch_Code');
				for (i = sel.length - 1; i >= 0; i--) {
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
			}

			function Branch() {
				var branchCode = document.getElementById('Branch_Code').value;
				let branchCode1 = counsellingcode.filter(obj1 => {
				return obj1.brc === branchCode;
			})
				var branchCode2 = branchCode1[0].brn;
				document.getElementById('Branch_Name').value = branchCode2;
			}

			function BranchName() {
				var branchName = document.getElementById('Branch_Name').value;
				let branchName1 = counsellingcode.filter(obj1 => {
				return obj1.brn === branchName;
			})
				var branchName2 = branchName1[0].brc;
				document.getElementById('Branch_Code').value = branchName2;
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