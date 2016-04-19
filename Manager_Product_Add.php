<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "supermarket";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	} 
	if(isset($_COOKIE['id']))
	{     
		//checks if this username was set (atleast once)
		$user_name =  $_COOKIE['id'];  
		if($user_name == "none" || $user_name != '103')
		{    
			//if he hasnt signed in, it ll go to another page just to prompt him to sign in. else continue
			header('location:validation.php');
		}
	}
	else header('location:validation.php');
	$mid = $_COOKIE['id'];
	$mname= "";
	$sql = "select * from employee where E_ID ='".$mid."' ";
	$result = $conn->query($sql);
	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc() )
		{
			$mname = $row['Name'];
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="man.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src='validateproduct.js' type='text/javascript'> </script>
    <script type="text/javascript">
		function init()
		{
			//to make the grey portion of sidebar extend till the bottom of the page
			side = document.getElementById("side");
			side.style.height = screen.height+50+"px";
		}
    </script>
</head>
<body onload="init()">
	<nav class="navbar navbar-default" >
		<div class="container-fluid" style="background-color:#030303;height:100px">
			<div class="navbar-header col-md-6 text-center">
				<h1 style="color:white;margin-top:30px">Welcome <?php echo $mname?> !</h1>
			</div>
			<ul class="nav navbar-nav " style=" margin-left:250px;padding-top:30px;color:#e0e0e0">
				<li><a href="Manager_Profile.php" style="color:white" >Profile</a></li>
				<li><a href="Manager_Portal.php"><i class="material-icons" style=" margin-right:10px;color:white">sms</i></a></li>
				<li><img src="pic.jpg" height="40px" width="50px" ></li>
				<li><a href="Manager_Signout.php" style="color:white" >Signout</a>
			</ul>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row">
			<div id ="side" class="col-md-3 text-center" style="left:-75px;margin-top:-21px;background-color:#e0e0e0;z-index:100;height:100%">
				<div class="list-group" style="margin-right:-15px;margin-left:2px">
					<a href="Manager_Employee_View.php" class="list-group-item "><h4>Employee</h4></a>
					<a href="Manager_Customer_View.php" class="list-group-item"><h4>Customer</h4></a>
					<a href="Manager_Accounts_Summary.php" class="list-group-item"><h4>Accounts</h4></a>
					<a href="Manager_Supply_ViewVendor.php" class="list-group-item"><h4>Supply</h4></a>
					<a href="Manager_Product_View.php" class="list-group-item active"><h4>Products</h4></a>
				</div>
			</div>
			<div class="col-md-9 container">
        <ul class="nav nav-tabs nav-justified" style="margin-left:-105px;margin-top:-21px;">
		<li><a href="Manager_Product_View.php">View</a></li>
        <li class="active"><a href="Manager_Product_Add.php" style="font:bold 20px;">Add an item</a></li>
        </ul>
				</div>
				<div class="tab-content">
					<div class="row">
						<br/><br/>
						<?php
							echo "<form  action='addproduct.php'  method='POST' onsubmit = 'return validate()'>";  
							echo "Enter Item_ID  <input type='text' name='Item_ID' id = 'Item_ID' placeholder='Item_ID'/><br/><br/>";
							echo "Enter Item_Name  <input type='text' name='Item_Name' id = 'Item_Name' placeholder='Item_Name'/><br/><br/>";
							echo "Select the category";
							$sql = "SELECT Cat_ID from category"; // Run your query
							$result = $conn->query($sql);
							echo "<select name='Cat_ID'>"; // Open your drop down box

							// Loop through the query results, outputing the options one by one
							while($row = $result->fetch_array())
							{
								$rows[] = $row;
							}

							foreach($rows as $row)
							{
								echo "<option value='" .$row['Cat_ID'] ."'>" . $row['Cat_ID'] ."</option>";
							}	
							echo "</select> <br/><br/>";// Close your drop down box
							echo "Enter Price  <input type='text' name='Price' id = 'Price' placeholder='Price'/><br/><br/>";
							echo "Enter Stock ID  <input type='text' name='Stock_ID' id = 'Stock_ID' placeholder='Stock ID'/><br/><br/>";
							echo "Enter Quantity  <input type='text' name='Quantity' id = 'Quantity' placeholder='Quantity'/><br/><br/>";
							echo "Enter Threshold  <input type='text' name='Threshold' id = 'Threshold' placeholder='Threshold'/><br/><br/>";
							echo "Enter Barcode  <input type='text' name='Barcode' id = 'Barcode' placeholder='Barcode'/><br/><br/>";
							echo "Enter Expiry Date  <input type='date' name='exp_date' id = 'exp_date' placeholder='Expiry Date'/><br/><br/>";
							echo "<input type='submit'>";
							echo "</form>";
							
							
							
							
						?>
							
					
							
						
				