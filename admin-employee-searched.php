<?php include_once "admin-session.php"; ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<?php include_once "admin-inc-head.php"; ?>
</head>

<body onscroll="navStick()">

<?php include_once "admin-inc-header.php"; ?>
<?php include_once "admin-inc-nav.php"; ?>

<div class="content">

	<div class="row">
		<div class="col-sm-8 mainbody-adm">

<h2>Employees Search List</h2>


<?php
require_once "dbconfig.php";

$fields = array('EmpName', 'EmpFName', 'EmpDOB', 'EmpPhone', 'EmpEmail', 'EmpID');
$conditions = array();
// loop through the defined fields
foreach($fields as $field){
	// if the field is set and not empty
	if(isset($_POST[$field]) && $_POST[$field] != '') {
		// create a new condition while escaping the value inputed by the user (SQL Injection)
		$conditions[] = "`$field` LIKE '%" . mysqli_real_escape_string($conn,$_POST[$field]) . "%'";
	}
}
// builds the query
$query = "SELECT employees.EmpID, employees.EmpName, employees.EmpFName, employees.EmpPhone, employees.EmpEmail, employees.EmpRole, branches.BrID, branches.BrLoc FROM employees INNER JOIN branches ON employees.EmpBrID=branches.BrID";
// if there are conditions defined
if(count($conditions) > 0) {
// append the conditions
$query .= " WHERE " . implode (' AND ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
}
$query .= " ORDER BY EmpID ASC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
	echo "<div class=\"table-responsive\">
<table class=\"table table-striped table-bordered\">
	<tr>
		<th>ID</th>
		<th>Employee Name</th>
		<th>Father's Name</th>
		<th>Phone</th>
		<th>Email</th>
		<th>Role</th>
		<th>Branch Location</th>
	</tr>";
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<tr>
		<td>".$row["EmpID"]."</td>
		<td><a href=\"admin-employee-view.php?id=".$row["EmpID"]."\">".$row["EmpName"]."</a></td>
		<td>".$row["EmpFName"]."</td>
		<td>".$row["EmpPhone"]."</td>
		<td>".$row["EmpEmail"]."</td>
		<td>".$row["EmpRole"]."</td>
		<td><a href=\"admin-branch-view.php?id=".$row["BrID"]."\">".$row["BrLoc"]."</a></td>
	</tr>";
    }
	echo "</table></div>";
}
else {
	echo "<div class=\"alert alert-danger\">Nothing found.</div>";
}




?>

		</div>
		<div class="col-sm-4 mainside-adm"><?php include_once "admin-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-adm"><?php include_once "admin-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>