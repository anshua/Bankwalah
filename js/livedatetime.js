<!--
function liveClock() {
	var d=new Date();
	var nmonth=d.getMonth(), ndate=d.getDate(), nyear=d.getFullYear();
	var nhour=d.getHours(), nmin=d.getMinutes(), nsec=d.getSeconds();
	var mymonth=(nmonth+1);

	if (mymonth<=9) mymonth="0"+mymonth;
	if (ndate<=9) ndate="0"+ndate;
	if (nhour<=9) nhour="0"+nhour;
	if (nmin<=9) nmin="0"+nmin;
	if (nsec<=9) nsec="0"+nsec;

	document.FormClock.TrDateTime.value=nyear+"-"+mymonth+"-"+ndate+" "+nhour+":"+nmin+":"+nsec;
	setTimeout("liveClock()",1000);
}

liveClock();
//-->