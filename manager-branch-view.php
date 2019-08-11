<?php include_once "manager-session.php"; ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<?php include_once "manager-inc-head.php"; ?>
</head>

<body onscroll="navStick()">

<?php include_once "manager-inc-header.php"; ?>
<?php include_once "manager-inc-nav.php"; ?>

<div class="content">

	<div class="row">
		<div class="col-sm-8 mainbody-mgr">

<h2>Branch Details</h2>

<?php
require_once "dbconfig.php";

// for new branch
if (isset($_POST["submitnew"])) {
	$sql_brnew = "INSERT INTO branches (BrLoc, BrIFSC, BrOpenDate, BrPhone, BrEmail) VALUES ('$_POST[BrLoc]', '$_POST[BrIFSC]', '$_POST[BrOpenDate]', '$_POST[BrPhone]', '$_POST[BrEmail]')";
	if ($conn->query($sql_brnew) === TRUE) {
		echo "<div class=\"alert alert-success\">New branch created successfully.</div>";
		// getting BrID set to AUTO_INCREMENT
		$BrID = mysqli_insert_id($conn);
	}
	else {
		echo "<div class=\"alert alert-danger\">Error: " . $sql_brnew . "<br />" . $conn->error . "</div>";
	}
}

// for updating existing branch
if (isset($_POST["submitedit"])) {
	$sql = "UPDATE branches SET BrLoc = '$_POST[BrLoc]', BrIFSC = '$_POST[BrIFSC]', BrOpenDate = '$_POST[BrOpenDate]', BrPhone = '$_POST[BrPhone]', BrEmail = '$_POST[BrEmail]' WHERE BrID = $_POST[BrID]";
	if ($conn->query($sql) === TRUE) {
		echo "<div class=\"alert alert-success\">The branch details were updated successfully.</div>";
		$BrID = $_POST["BrID"];
	}
	else {
		echo "<div class=\"alert alert-danger\">Error: " . $sql . "<br />" . $conn->error . "</div>";
	}
}


/*------------------------------for view through link request starts-----------------------------------*/
if (isset($_GET["id"])) { $BrID = $_GET["id"];
/* setting check parameters starts */
$my_sql = mysqli_query($conn,"SELECT BrID FROM branches WHERE BrID=$_GET[id]");
$my_row = mysqli_fetch_array($my_sql,MYSQLI_ASSOC);
$my_ID = $my_row["BrID"];
}
/* setting check parameters end */
/*------------------------------for view through link request ends-----------------------------------*/


if (isset($_POST["submitnew"]) || isset($_POST["submitedit"]) || ($_GET["id"] == $my_ID)) {

$sql = "SELECT * FROM branches WHERE BrID=".$BrID;

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<div class=\"table-responsive\" id=\"printbranchrecord\">
<table class=\"table table-striped\">
	<tr>
		<td style=\"width:30%;\">Branch ID*</td>
		<td style=\"width:70%;\">".$row["BrID"]."</td>
	</tr>
	<tr>
		<td>Location*</td>
		<td style=\"width:70%;\">".$row["BrLoc"]."</td>
	</tr>
	<tr>
		<td>IFSC*</td>
		<td style=\"width:70%;\">".$row["BrIFSC"]."</td>
	</tr>
	<tr>
		<td>Opening Date*</td>
		<td>".$row["BrOpenDate"]."<button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>YYYY-MM-DD</button></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td style=\"width:70%;\">".$row["BrPhone"]."</td>
	</tr>
	<tr>
		<td>Email</td>
		<td style=\"width:70%;\">".$row["BrEmail"]."</td>
	</tr>
</table>
</div>

<button type=\"button\" class=\"btn btn-warning btn-xs\" onclick=\"printDiv('printbranchrecord')\">PRINT BRANCH RECORD</button><a href=\"manager-branch-edit.php?id=".$row["BrID"]."\"><button type=\"button\" class=\"btn btn-warning btn-xs\" style=\"margin-left:20px;\">EDIT</button></a>";
	}
}
else {
	echo "<div class=\"alert alert-danger\">Nothing found.</div>";
}

// displaying list of employees of this branch
echo "<h3>List of Employees working at this Branch</h3>";

$sql = "SELECT *, employees.EmpID, employees.EmpName, employees.EmpPhone, employees.EmpEmail, employees.EmpRole  FROM branches INNER JOIN employees ON branches.BrID=employees.EmpBrID WHERE BrID=".$BrID." ORDER BY EmpID ASC";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
	echo "<div class=\"table-responsive\">
<table class=\"table table-striped table-bordered\">
	<tr>
		<th>ID</th>
		<th>Employee Name</th>
		<th>Phone</th>
		<th>Email</th>
		<th>Role</th>
		<th>Photo</th>
	</tr>";
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<tr>
		<td>".$row["EmpID"]."</td>
		<td><a href=\"manager-employee-view.php?id=".$row["EmpID"]."\">".$row["EmpName"]."</a></td>
		<td>".$row["EmpPhone"]."</td>
		<td>".$row["EmpEmail"]."</td>
		<td>".$row["EmpRole"]."</td>
		<td><img src=\"img-employees/".$row["EmpID"]."-photo.jpg\" alt=\"".$row["EmpName"]." - Photo Load Error\" class=\"picsigfixedwidth\"></td>
	</tr>";
    }
	echo "</table></div>";
}
else {
	echo "<div class=\"alert alert-danger\">Nothing found.</div>";
}

}
else {
	header("Location: manager-dashboard.php");
}

?>


		</div>
		<div class="col-sm-4 mainside-mgr"><?php include_once "manager-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-mgr"><?php include_once "manager-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>