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

<h2>Add New Transaction</h2>

<div class="alert alert-warning">The process uses javascript clock which interprets your system time. To avaoid uploading wrong time into database, keep your computer's time accurate.</div>
<div class="alert alert-danger">Fields marked with * are mandatory.</div>

<form action="admin-trans-newconfirm.php" method="post" name="FormClock">
<div class="table-responsive">
<table class="table table-striped">
	<tr>
		<td style="width:30%;">Transaction ID*</td>
		<td style="width:70%;"><input type="text" name="TrID" value="SET TO AUTO_INCREMENT" style="width:50%;" disabled></td>
	</tr>
	<tr>
		<td>Date-Time Stamp*</td>
		<td style="width:70%;"><input type="text" name="TrDateTime" style="width:50%; background-color:red;" readonly><button type="button" class="btn btn-danger btn-xs" style="margin-left:20px;" disabled>YYYY-MM-DD HR:MI:SC</button></td>
	</tr>
	<tr>
		<td>Remarks</td>
		<td style="width:70%;"><input type="text" name="TrRemarks" style="width:50%;"></td>
	</tr>
	<?php
		if (isset($_GET["id"]) && isset($_GET["name"]) && isset($_GET["bal"])) {
			echo "<tr>
					<td style=\"width:30%;\">Customer ID*</td>
					<td style=\"width:70%;\"><input type=\"text\" name=\"TrCustID\" value=\"".$_GET["id"]."\" style=\"width:50%; background-color:red;\" readonly><button type=\"button\" class=\"btn btn-danger btn-xs\" style=\"margin-left:20px;\" disabled>".$_GET["name"].", Balance: &#8377; ".$_GET["bal"]."</button></td>
				</tr>";
			$transaction_max = " min=\"-".$_GET["bal"]."\"";
		}
		else {
			echo "<tr>
					<td style=\"width:30%;\">Customer ID*</td>
					<td style=\"width:70%;\"><input type=\"text\" name=\"TrCustID\" style=\"width:50%;\" required></td>
				</tr>";
			$transaction_max = "";
		}
	?>
	<tr>
		<td style="width:30%;">Employee ID*</td>
		<td style="width:70%;"><input type="text" name="TrEmpID" value="<?php echo $ses_EmpID; ?>" style="width:50%; background-color:red;" readonly></td>
	</tr>
	<tr>
		<td>Transaction Amount*</td>
		<td style="width:70%;"><input type="number" name="TrAmount" style="width:50%;"<?php echo $transaction_max; ?> required><button type="button" class="btn btn-danger btn-xs blink" style="margin-left:20px;" disabled>&#8377; Upto 2 Decimals ♦ + For Credit ♦ - For Debit</button></td>
	</tr>
</table>
</div>
<input type="submit" name="submit" value="NEXT"><input type="reset" name="reset" value="RESET" style="margin-left:20px;">
<?php if (isset($_GET["id"]) && isset($_GET["name"]) && isset($_GET["bal"])) { echo "<a href=\"admin-trans-new.php\"><button type=\"button\" class=\"btn btn-warning btn-xs\" style=\"margin-left:20px;\">START FRESH TRANSACTION</button></a>"; } ?>
</form>


		</div>
		<div class="col-sm-4 mainside-adm"><?php include_once "admin-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-adm"><?php include_once "admin-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<script type="text/javascript" src="js/livedatetime.js"></script>
<?php $conn->close(); ?></body>
</html>