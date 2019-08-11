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

<h2>Branch Cleaned</h2>


<?php
require_once "dbconfig.php";

if (isset($_POST["submit"])) {

/* employee photo signature deletion for the branch starts */
$sql_emp = "SELECT EmpID FROM employees WHERE EmpBrID=".$_POST["BrID"];
$result_emp = $conn->query($sql_emp);

if ($result_emp->num_rows > 0) {
	// output data of each row
	echo "<div class=\"alert alert-success\">";
	while($row_emp = $result_emp->fetch_assoc()) {
		$emp_photo_file = "img-employees/".$row_emp["EmpID"]."-photo.jpg";
		$emp_sig_file = "img-employees/".$row_emp["EmpID"]."-sig.jpg";

		if (file_exists($emp_photo_file)) {
			if (!unlink($emp_photo_file)) { echo "Employee ID = ".$row_emp["EmpID"].". Photo was not deleted due to some error.<br />"; } else { echo "Employee ID = ".$row_emp["EmpID"].". Photo was deleted.<br />"; }
		}
		else {
			echo "Employee ID = ".$row_emp["EmpID"].". Photo was not available.<br />";
		}
		
		if (file_exists($emp_sig_file)) {
			if (!unlink($emp_sig_file)) { echo "Employee ID = ".$row_emp["EmpID"].". Signature was not deleted due to some error.<br />"; } else { echo "Employee ID = ".$row_emp["EmpID"].". Signature was deleted.<br />"; }
		}
		else {
			echo "Employee ID = ".$row_emp["EmpID"].". Signature was not available.<br />";
		}
    }
	echo "</div>";
}
else {
	echo "<div class=\"alert alert-danger\">Employee photo-signature not available to delete.</div>";
}
/* employee photo signature deletion for the branch ends */

/* customer photo signature deletion for the branch starts */
$sql_cust = "SELECT CustID FROM customers WHERE CustBrID=".$_POST["BrID"];
$result_cust = $conn->query($sql_cust);

if ($result_cust->num_rows > 0) {
	// output data of each row
	echo "<div class=\"alert alert-success\">";
	while($row_cust = $result_cust->fetch_assoc()) {
		$cust_photo_file = "img-customers/".$row_cust["CustID"]."-photo.jpg";
		$cust_sig_file = "img-customers/".$row_cust["CustID"]."-sig.jpg";

		if (file_exists($cust_photo_file)) {
			if (!unlink($cust_photo_file)) { echo "Customer ID = ".$row_cust["CustID"].". Photo was not deleted due to some error.<br />"; } else { echo "Customer ID = ".$row_cust["CustID"].". Photo was deleted.<br />"; }
		}
		else {
			echo "Customer ID = ".$row_cust["CustID"].". Photo was not available.<br />";
		}
		
		if (file_exists($cust_sig_file)) {
			if (!unlink($cust_sig_file)) { echo "Customer ID = ".$row_cust["CustID"].". Signature was not deleted due to some error.<br />"; } else { echo "Customer ID = ".$row_cust["CustID"].". Signature was deleted.<br />"; }
		}
		else {
			echo "Customer ID = ".$row_cust["CustID"].". Signature was not available.<br />";
		}
    }
	echo "</div>";
}
else {
	echo "<div class=\"alert alert-danger\">Customer photo-signature not available to delete.</div>";
}
/* customer photo signature deletion for the branch ends */

/* employee and customer data deletion for the branch starts */
$sql_delete ="DELETE employees, customers FROM employees INNER JOIN customers ON customers.CustBrID=employees.EmpBrID WHERE employees.EmpBrID=".$_POST["BrID"];

if ($conn->query($sql_delete) === TRUE) {
	echo "<div class=\"alert alert-success\">Branch ID : ".$_POST["BrID"]."<br /><br />All employees and customers data of the above branch were deleted permanently.</div>";
}
else {
	echo "<div class=\"alert alert-danger\">Error: " . $sql_delete . "<br />" . $conn->error . "</div>";
}
/* employee and customer data deletion for the branch ends */

}
else {
	header("Location: admin-dashboard.php");
}

?>

<a href="admin-branch-search.php"><button type="button" class="btn btn-warning btn-xs">SEARCH ANOTHER BRANCH</button></a>


		</div>
		<div class="col-sm-4 mainside-adm"><?php include_once "admin-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-adm"><?php include_once "admin-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>