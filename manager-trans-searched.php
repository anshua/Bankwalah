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

<h2>Transactions Search List</h2>


<?php
require_once "dbconfig.php";

$fields = array('TrCustID', 'TrEmpID', 'TrRemarks', 'TrDate', 'TrAmount', 'TrID');
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
//$query = "SELECT * FROM transactions";
$query = "SELECT transactions.TrID, transactions.TrDateTime, transactions.TrRemarks, transactions.TrCustID, transactions.TrEmpID, transactions.TrAmount, customers.CustBrID FROM transactions INNER JOIN customers ON transactions.TrCustID=customers.CustID";
// if there are conditions defined
if(count($conditions) > 0) {
// append the conditions
$query .= " WHERE " . implode (' AND ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
}
$query .= " AND CustBrID=".$ses_BrID;
$query .= " ORDER BY TrID ASC";
$result = $conn->query($query);

if ($result->num_rows > 0) {
	echo "<div class=\"table-responsive\">
<table class=\"table table-striped table-bordered\">
	<tr>
		<th>ID</th>
		<th>Date-Time Stamp<br /><span style=\"font-size:10px;\">(YYYY-MM-DD HR:MI:SC)</span></th>
		<th>Amount<br /><span style=\"font-size:10px;\">(&#8377;)</span></th>
		<th>Customer ID</th>
		<th>Employee ID</th>
		<th>Remarks</th>
		<th>Action</th>
	</tr>";
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<tr>
		<td>".$row["TrID"]."</td>
		<td>".$row["TrDateTime"]."</td>
		<td>".$row["TrAmount"]."</td>
		<td><a href=\"manager-customer-view.php?id=".$row["TrCustID"]."\">".$row["TrCustID"]."</a></td>
		<td><a href=\"manager-employee-view.php?id=".$row["TrEmpID"]."\">".$row["TrEmpID"]."</a></td>
		<td>".$row["TrRemarks"]."</td>
		<td><a href=\"manager-trans-view.php?id=".$row["TrID"]."\">View</a></td>
	</tr>";
    }
	echo "</table></div>";
}
else {
	echo "<div class=\"alert alert-danger\">Nothing found.</div>";
}
?>

		</div>
		<div class="col-sm-4 mainside-mgr"><?php include_once "manager-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-mgr"><?php include_once "manager-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?>
</body>
</html>