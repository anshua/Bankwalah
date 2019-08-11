<?php include_once "clerk-session.php"; ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<?php include_once "clerk-inc-head.php"; ?>
</head>

<body onscroll="navStick()">

<?php include_once "clerk-inc-header.php"; ?>
<?php include_once "clerk-inc-nav.php"; ?>

<div class="content">

	<div class="row">
		<div class="col-sm-8 mainbody-clr">

<h2>Add New Customer</h2>

<div class="alert alert-danger">Fields marked with * are mandatory.</div>

<form action="clerk-customer-view.php" method="post" enctype="multipart/form-data">
<div class="table-responsive">
<table class="table table-striped">
	<tr>
		<td style="width:30%;">Customer ID*</td>
		<td style="width:70%;"><input type="text" name="CustID" value="SET TO AUTO_INCREMENT" style="width:50%;" disabled></td>
	</tr>
	<tr>
		<td>Name*</td>
		<td style="width:70%;"><input type="text" name="CustName" style="width:50%;" required></td>
	</tr>
	<tr>
		<td>Father's Name*</td>
		<td style="width:70%;"><input type="text" name="CustFName" style="width:50%;" required></td>
	</tr>
	<tr>
		<td>Mother's Name</td>
		<td style="width:70%;"><input type="text" name="CustMName" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Date of Birth*</td>
		<td><button type="button" class="btn btn-danger btn-xs" style="margin-right:20px;" disabled>YYYY-MM-DD</button><input type="text" name="CustDOB" class="datepicker" required></td>
	</tr>
	<tr>
		<td>Join Date*</td>
		<td><button type="button" class="btn btn-danger btn-xs" style="margin-right:20px;" disabled>YYYY-MM-DD</button><input type="text" name="CustJoinDate" class="datepicker" value="<?php echo date("Y-m-d"); ?>" required></td>
	</tr>
	<tr>
		<td>Sex*</td>
		<td><input type="radio" name="CustSex" value="Male" checked> Male<input type="radio" name="CustSex" value="Female" style="margin-left:30px;"> Female<input type="radio" name="CustSex" value="Other" style="margin-left:30px;"> Other</td>
	</tr>
	<tr>
		<td>Local Address*</td>
		<td style="width:70%;"><input type="text" name="CustLAdd" style="width:90%;" required></td>
	</tr>
	<tr>
		<td>Permanent Address</td>
		<td style="width:70%;"><input type="text" name="CustPAdd" style="width:90%;"></td>
	</tr>
	<tr>
		<td>Phone</td>
		<td style="width:70%;"><input type="text" name="CustPhone" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Email</td>
		<td style="width:70%;"><input type="email" name="CustEmail" style="width:50%;"></td>
	</tr>
	<tr>
		<td>PAN</td>
		<td style="width:70%;"><input type="text" name="CustPAN" style="width:50%;"><button type="button" class="btn btn-danger btn-xs" style="margin-left:20px;" disabled>Format : AAAAA2222A</button></td>
	</tr>
	<tr>
		<td>Aadhaar</td>
		<td style="width:70%;"><input type="text" name="CustAadhaar" style="width:50%;"><button type="button" class="btn btn-danger btn-xs" style="margin-left:20px;" disabled>Format : 111122223333</button></td>
	</tr>
	<tr>
		<td>Branch ID*</td>
		<?php echo "<td style=\"width:70%;\"><input type=\"text\" name=\"CustBrID\" value=\"".$ses_BrID."\" style=\"width:50%; background-color:red;\" readonly></td>"; ?>
	</tr>
	<tr>
		<td>Account Type*</td>
		<td><input type="radio" name="CustACType" value="Saving" checked> Saving AC<input type="radio" name="CustACType" value="Current" style="margin-left:30px;"> Current AC<input type="radio" name="CustACType" value="RD" style="margin-left:30px;"> Recurring Deposit AC<input type="radio" name="CustACType" value="FD" style="margin-left:30px;"> Fixed Diposit AC</td>
	</tr>
	<tr>
		<td>Current Balance*</td>
		<td style="width:70%;"><input type="text" name="CustCurrBal" style="width:50%;"><button type="button" class="btn btn-danger btn-xs" style="margin-left:20px;" disabled>&#8377; Upto 2 Decimals</button></td>
	</tr>
	<tr>
		<td>Customer Log</td>
		<td style="width:70%;"><input type="text" name="CustLog" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Net Banking Required*</td>
		<td><input type="radio" name="CustNetBank" value="No" checked> No<input type="radio" name="CustNetBank" value="Yes" style="margin-left:30px;"> Yes</td>
	</tr>
	<tr>
		<td>Net Banking Login</td>
		<td style="width:70%;"><input type="text" name="CustLogin" style="width:50%;"><button type="button" class="btn btn-danger btn-xs" style="margin-left:20px;" disabled>Unique</button></td>
	</tr>
	<tr>
		<td>Net Banking Password</td>
		<td style="width:70%;"><input type="password" name="CustPass" style="width:50%;"></td>
	</tr>
	<tr>
		<td>Photo</td>
		<td><button type="button" class="btn btn-danger btn-xs" style="margin-right:20px;" disabled>Max 1 MB, Only jpg</button><input type="file" name="CustPhoto" id="CustPhoto" accept=".jpg" style="display:inline;"></td>
	</tr>
	<tr>
		<td>Signature</td>
		<td><button type="button" class="btn btn-danger btn-xs" style="margin-right:20px;" disabled>Max 1 MB, Only jpg</button><input type="file" name="CustSig" id="CustSig" accept=".jpg" style="display:inline;"></td>
	</tr>
</table>
</div>
<input type="submit" name="submitnew" value="SUBMIT"><input type="reset" name="reset" value="RESET" style="margin-left:20px;">
</form>


		</div>
		<div class="col-sm-4 mainside-clr"><?php include_once "clerk-inc-sidebar.php"; ?></div>
	</div><!--row end-->
</div><!--content end-->

<div class="col-sm-12 mainfoot-clr"><?php include_once "clerk-inc-footer.php"; ?></div>

<script type="text/javascript" src="js/sticky.js"></script>
<?php $conn->close(); ?></body>
</html>