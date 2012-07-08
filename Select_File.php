<html>

<head>
<meta http-equiv="Content-Type" content="text/xml; charset=big5">
<title>Data File Select Webpage</title>


<?
// Receive variable from "Select_ID.php"
echo $_GET['id']."<br>";

if ($_GET['id']) {
	$id = $_GET['id'];
	echo $_GET['id']."<br>";
}

/** ------------------------------------------------------------------------ **/



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

$dir = "/Applications/MAMP/htdocs/phpBB3/SavedData/$id";

echo '<html><head><meta http-equiv="Content-Type" ';
echo 'content="text/html; charset=big5">';
echo '<title>Testing PHP for hierList</title></head><body>';
/*
 為了保證所放 index.php 的目錄是根目錄，$path 不可以有 '..' 而前面一定是 './'
*/
if (($path == "") || (substr_count($path, '..') > 0) ||
		(substr($path, 0, 2)) != './') $path = './';
$tmp = substr($path, 1);
echo "<h3>Index of $tmp </h3>\n<pre>";
/*
 讀檔案/目錄列表，放入陣列 $farray/$darray
*/
$darray = $farray = array(); // 宣告 $farray 和 $darray 為陣列
// $hndl = opendir("$path");
$hndl = opendir($dir);
$fi = 0;
$di = 0;
/*
 開始讀這目錄裡的所有檔案和目錄
*/
while($entry = readdir($hndl)) {
	if (is_file($entry)) { // 是否檔案？
		if ($entry != 'index.php') $farray[$fi++] = $entry;
	}
	else {   // 是目錄
		if ($entry != '.') {
			if ($entry != '..' || $path != './') {
				$darray[$di++] = $entry;
			}
		}
	}
}
closedir($hndl);
/*
 列出目錄列表
*/
$didx = count($darray);
if ($didx > 0) {
	sort($darray); // 排列
	for ($i = 0; $i < $didx; $i++) {
		echo "            [";
		if ($darray[$i] == '..') {
			// 刪除最後的 '/'
			$tmp = substr($path, 0, strlen($path) - 1);
			// 尋找最後一個'/'
			$ipos = strrpos($tmp, '/');
			// 刪除最後一個目錄
			$tmp = substr($tmp, 0, $ipos+1);
			echo '<a href="index.php?path='.$tmp.'">..</a>]'."\n";
		}
		else {
			echo '<a href="http://140.114.14.54'.$dir.$darray[$i].'/">'.$darray[$i].'</a>]'."\n";
		}
	}
}
/*
 列出檔案列表
*/
$fidx = count($farray);
if ($fidx > 0) {
	sort($farray); // 排列
	for ($i = 0; $i < $fidx; $i++) {
		// 讀檔案的timestamp（時間戳記）
		$idate = filemtime($farray[$i]);
		// 將timestamp轉換為date（日期）
		$sdate = date('Y/m/d', $idate);
		$fsize = filesize($farray[$i]); // 讀檔案大小
		if ($fsize < 1024) {
			printf("%7d B   ", $fsize); // 為byte
		}
		else {
			$fsize = (float) ($fsize / 1024.0);
			if ($fsize < 1024.0) {
				printf("%5.1f KB  ", $fsize);  // 為KB
			}
			else {
				$fsize /= 1024.0;
				if ($fsize < 1024.0) {
					printf("%5.1f MB  ", $fsize);  // 為MB
				}
				else {
					$fsize /= 1024.0;
					printf("%5.1f GB  ", $fsize);  // 為GB
				}
			}
		}
		echo $sdate;
		$zipFile = substr($farray[$i],0,5);
		echo "<a href=http://140.114.14.54/phpBB3/ECGServer/PHPCode/Patient_Ask.php?zipFile=$zipFile&id=$id target=_self>$farray[$i]/</a><br>";
	}
}

$baidu = baidu;

echo "<a  href=\"http://140.114.14.54/phpBB3/ECGServer/PHPCode/Patient_Ask.php?i\"id=\"google\" \"target=\"_self\">Patient_Ask/</a><br>";

//Link with valuable sending
echo "<a href=http://140.114.14.54/phpBB3/ECGServer/PHPCode/Patient_Ask.php?id=$baidu target=_self>Patient_Ask</a><br>";



echo '</pre><hr><pre><font color="#808080" size="2">';
echo 'Testing PHP for hierList'."\n";
echo $date.'</font></pre>';
echo '</body></html>';
?>


</head>

<body>

</body>

</html>
