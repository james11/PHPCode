<title>Waveform Response Webpage</title>

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


$upatientID = $_POST["upatientID"];
// echo "Hi doctor "."<font color=$blue>$doctorname</font>".":<p>";
echo $upatientID;
echo "<br>";

$udate = $_POST["udate"];
echo $udate;
echo "<br>";

$starttime = $_REQUEST["ustarttime"];
echo $starttime;
if($starttime == 0) $starttime = $starttime+1;
else
	$starttime = $starttime*1920*60;
echo "  ".$starttime;
echo "<br>";

$scale = $_REQUEST["uscale"];
echo $scale;
$scale = $scale*1920;
echo "  ".$scale;
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
fwrite($fp, "$starttime\n $scale");
fclose($fp);

for($i=2; $i<6; $i++) {
	$last_line = system($command[$i], $retval);
}

sleep(3);

echo "<img src=\"./plottingTool/output.bmp\">";
echo "<br>";


$test = $_POST["utest"];
echo $test;

?>
