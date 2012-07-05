<title>Patient List WebPage</title>

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



echo "<img src=\"./output.bmp\">";
// echo "<img src=\"./"."output.BMP\">";





// $command = array(
// 		0=>"tar xvf ../../SavedData/$upatientID/$udate.zip",
// 		1=>"mv ./ECG_$udate/RowData/$udate.ECG.txt ./$udate.txt",
// 		2=>"mv ./$udate.txt ./19200.txt",
// 		// 		3=>"rm -rf *.bmp",
// 		4=>"./plotECG.app",
// 		5=>"",
// 		6=>"",
// 		7=>"",
// 		// 		8=>"rm -rf *.bmp",
// 		9=>"rm -rf ECG_*",
// 		// 		10=>"rm -rf 19200.txt"
// );

// for($i=0; $i<4; $i++) {
// 	$last_line = system($command[$i], $retval);
// }

// for($i=4; $i<11; $i++) {
// 	$last_line = system($command[$i], $retval);
// }

// echo "<img src=\"./"."output.BMP\">";

// for($i=6; $i<11; $i++) {
// 	$last_line = system($command[$i], $retval);
// }

// echo "<img src=\"../../SavedData/$doctorname/".$patientname.".GIF\">";


?>
