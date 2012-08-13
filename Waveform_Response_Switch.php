<html>

<head>
<title>Waveform Response Webpage</title>
<center>

	<p>
		<img
			src="http://www.ntuh.gov.tw/_catalogs/masterpage/V2/images/logo1.gif"
			height="80" width="300"></img>
	</p>

	<font size=6> <font color=#0000ff> Welcome </font>
	</font> <font size=6> <font color=#cc0033> to Waveform </font>
	</font> <font size=6> <font color=#ffcc00> Response </font>
	</font> <font size=6> <font color=#00CC00> Webpage</font>
	</font>


	<?php

	// Create two timezone objects,
	$dateTimeZoneTaipei = new DateTimeZone('Asia/Taipei');
	$dateTimeZoneUS = new DateTimeZone('America/Los_Angeles');


	// Create two DateTime objects that will contain the same Unix timestamp, but
	// have different timezones attached to them.
	$dateTimeTaipei = new DateTime('now', $dateTimeZoneTaipei);
	$dateTimeUS = new DateTime('now', $dateTimeZoneUS);


	// Calculate the GMT offset for the date/time contained in the $dateTimeTaipei
	// object, but using the timezone rules as defined for LA
	// ($dateTimeZoneJapan).
	$timeOffset = $dateTimeZoneUS->getOffset($dateTimeTaipei);
	$timeOffset = 8 - ($timeOffset / 60 / 60);


	//echo Time;
	echo "<br>";
	echo "<br>";
	echo 'Now Time (Taiwan) : ';
	$hour = 60 * 60;
	echo date('Y/m/d  H:i:s', time())."<br>";
	echo "<br>";

	echo 'LA Time : ';
	$x = time() - $hour * $timeOffset;
	echo date('Y/m/d  H:i:s', $x)."<br>";
	echo "<br>";
	echo "<hr>";
	echo "<br>";

	$blue = '#0000ff';
	$red = '#cc0033';
	$yellow = '#ffcc00';
	$green = '#00CC00';


	$upatientID = $_GET["upatientID"];
	// echo "Hi doctor "."<font color=$blue>$doctorname</font>".":<p>";
	// 	echo $upatientID;
	echo "<br>";

	$udate = $_GET["udate"];
	echo $udate;
	echo "<br>";

	$starttime = $_GET["ustarttime"];
	// 	echo $starttime;
	if($starttime <= 0) $starttime = 1;
	// 	echo "  ".$starttime;
	echo "<br>";

	$scale = $_GET["uscale"];
	// 	echo $scale;
	$scale_m = $scale*1920;
	// 	echo "  ".$scale_m;
	echo "<br>";

	$command = array(
			0=>"tar xvf ../../SavedData/$upatientID/$udate.zip",
			1=>"mv ./ECG_$udate/RowData/$udate.ECG.txt ./data.txt",
			2=>"",
			3=>"mv ./data.txt ./plottingTool/data.txt",
			4=>"mv ./scale.txt ./plottingTool/scale.txt",
			5=>"rm -rf ./ECG_$udate*",
			6=>"",
			7=>"",
			8=>"",
			9=>"",
			10=>""
	);

	for($i=0; $i<2; $i++) {
		$last_line = system($command[$i], $retval);
	}

	$fp = fopen('scale.txt', 'w');
	fwrite($fp, "$starttime\n $scale_m");
	fclose($fp);

	for($i=2; $i<6; $i++) {
		$last_line = system($command[$i], $retval);
	}

	sleep(3);

	echo "<img src=\"./plottingTool/output.bmp\">";
	echo "<br>";


	// 	$test = $_POST["utest"];
	// 	echo $test;

	$starttime_previous = $starttime-$scale_m;
	$starttime_next = $starttime+$scale_m;

	echo "<br>"."<h2>";
	echo "<a href=http://140.114.14.54/phpBB3/ECGServer/PHPCode/Waveform_Response_Switch.php?upatientID=$upatientID&udate=$udate&ustarttime=$starttime_previous&uscale=$scale target=_self>Previous Figure</a>";
	echo "...............";
	echo "<a href=http://140.114.14.54/phpBB3/ECGServer/PHPCode/Patient_Ask.php?zipFile=$udate&id=$upatientID target=_self>\t Back to Patient Select Webpage \t</a>";
	echo "...............";
	echo "<a href=http://140.114.14.54/phpBB3/ECGServer/PHPCode/Waveform_Response_Switch.php?upatientID=$upatientID&udate=$udate&ustarttime=$starttime_next&uscale=$scale target=_self>Next Figure</a>";
	echo "<br>"."<br>";

	?>


</center>
</head>


<body>

</body>

</html>

