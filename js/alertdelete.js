function alertdeleteFunction() {
	alert("The record will be deleted permanently. Are you sure, you want to delete this record?");
}

function delalertFunction() {
	var txt;
	if (confirm("Press a button!") == true) {
		txt = "You pressed OK!";
	}
	else {
		txt = "You pressed Cancel!";
	}
	document.getElementById("demo").innerHTML = txt;
}