<?php
include_once "dbconfig.php";
session_start();
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// username and password sent from form 
 	$myusername = mysqli_real_escape_string($conn,$_POST["username"]);
	$mypassword = mysqli_real_escape_string($conn,$_POST["password"]); 

	$sql = "SELECT EmpID FROM employees WHERE EmpRole='Manager' AND EmpLogin='$myusername' AND EmpPass = '$mypassword'";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	//$active = $row['active'];

	$count = mysqli_num_rows($result);

	// If result matched $myusername and $mypassword, table row must be 1 row
	if ($count == 1) {
		//session_register("myusername");
		$_SESSION["login_geeta"] = $myusername;
 
		header("Location: manager-dashboard.php");
	}
	else {
		$error = "Invalid Username or Password";
	}
}

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<?php include_once "manager-inc-head.php"; ?>
</head>

<body style="background-color:pink;">

<div style="margin-left:auto; margin-right:auto; text-align:center; margin-top:20px;"><a href="index.php"><button type="button" class="btn btn-success btn-md">BANKWALAH &nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-piggy-bank"></span>&nbsp;&nbsp;&nbsp; PORTALS</button></a></div>

<div class="card" style="margin-top:20px; margin-bottom:20px; background-color:azure; border-radius:5%;">
	<img src="img/geeta.jpg" alt="Avatar" class="card-image" style="max-width:200px;">
	<h3>LOGIN PORTAL</h3>
	<p class="card-title">Geeta ♦ Manager</p>
	
		<form action="" method="post">
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
			<input id="email" type="text" class="form-control" name="username" placeholder="Username" required>
		</div>
		<div class="input-group">
			<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
			<input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
		</div>

		<?php if (isset($error)) { echo "<span style=\"color:red; font-size:10px;\">".$error."</span>";} ?>
		<div style="margin-top:20px;"><input type="submit" name="submit" value="LOGIN"><input type="reset" name="reset" value="RESET" style="margin-left:20px;"></div>
	</form>
	
	<p style="margin-top:20px; font-size:12px;">Password can be changed after you login.</p>
</div>

<?php $conn->close(); ?></body>
</html>