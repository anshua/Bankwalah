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

<h2>Customers Search List</h2>


<?php
require_once "dbconfig.php";

$fields = array('CustName', 'CustFName', 'CustDOB', 'CustPhone', 'CustEmail', 'CustID');
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
$query = "SELECT customers.CustID, customers.CustName, customers.CustFName, customers.CustPhone, customers.CustEmail, customers.CustCurrBal, customers.CustDOB, customers.CustBrID, branches.BrLoc FROM customers INNER JOIN branches ON customers.CustBrID=branches.BrID";
// if there are conditions defined
if(count($conditions) > 0) {
// append the conditions
$query .= " WHERE " . implode (' AND ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
}
$query .= " ORDER BY CustID ASC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
	echo "<div class=\"table-responsive\">
<table class=\"table table-striped table-bordered\">
	<tr>
		<th>ID</th>
		<th>Customer Name</th>
		<th>Father's Name</th>
		<th>DOB<br /><span style=\"font-size:10px;\">(YYYY-MM-DD)</span></th>
		<th>Phone</th>
		<th>Balance<br /><span style=\"font-size:10px;\">(&#8377;)</span></th>
		<th>Branch Location</th>
		<th>Do</th>
		<th>Do</th>
	</tr>";
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<tr>
		<td>".$row["CustID"]."</td>
		<td><a href=\"admin-customer-view.php?id=".$row["CustID"]."\">".$row["CustName"]."</a></td>
		<td>".$row["CustFName"]."</td>
		<td>".$row["CustDOB"]."</td>
		<td>".$row["CustPhone"]."</td>
		<td>".$row["CustCurrBal"]."</td>
		<td><a href=\"admin-branch-view.php?id=".$row["CustBrID"]."\">".$row["BrLoc"]."</a></td>
		<td><a href=\"admin-trans-new.php?id=".$row["CustID"]."&name=".$row["CustName"]."&bal=".$row["CustCurrBal"]."\">Transact</a></td>
		<td><a href=\"admin-trans-tform.php?id=".$row["CustID"]."&name=".$row["CustName"]."&bal=".$row["CustCurrBal"]."\">Transfer</a></td>
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