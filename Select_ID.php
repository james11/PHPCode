<html>

<head>
<meta http-equiv="Content-Type" content="text/xml; charset=big5">
<title>Patient Select Webpage</title>


<?
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

/** ---------------------------------------------------------------------- **/


// directory for saved data
$dir = "/Applications/MAMP/htdocs/phpBB3/SavedData/";

/*
 ���F�O�ҩҩ� index.php ���ؿ��O�ڥؿ��A$path ���i�H�� '..' �ӫe���@�w�O './'
*/
if (($path == "") || (substr_count($path, '..') > 0) ||
		(substr($path, 0, 2)) != './') $path = './';
$tmp = substr($path, 1);

echo "<h3>Patient ID Folder List ".$id."</h3>\n<pre>";

/*
 Ū�ɮ�/�ؿ��C��A��J�}�C $farray/$darray
*/
$darray = $farray = array(); // �ŧi $farray �M $darray ���}�C
// $hndl = opendir("$path");
$hndl = opendir($dir);
$fi = 0;
$di = 0;
/*
 �}�lŪ�o�ؿ��̪��Ҧ��ɮשM�ؿ�
*/
while($entry = readdir($hndl)) {
	if (is_file($entry)) { // �O�_�ɮסH
		if ($entry != 'index.php') $farray[$fi++] = $entry;
	}
	else {   // �O�ؿ�
		if ($entry != '.') {
			if ($entry != '..' || $path != './') {
				$darray[$di++] = $entry;
			}
		}
	}
}
closedir($hndl);
/*
 �C�X�ؿ��C��
*/
$didx = count($darray);
if ($didx > 0) {
	sort($darray); // �ƦC
	for ($i = 0; $i < $didx; $i++) {
		echo "            [";
		if ($darray[$i] == '..') {
			// �R���̫᪺ '/'
			$tmp = substr($path, 0, strlen($path) - 1);
			// �M��̫�@��'/'
			$ipos = strrpos($tmp, '/');
			// �R���̫�@�ӥؿ�
			$tmp = substr($tmp, 0, $ipos+1);
			echo '<a href="index.php?path='.$tmp.'">..</a>]'."\n";
		}
		else {
			echo "<a href=http://140.114.14.54/phpBB3/SavedData/$darray[$i]/Select_File.php?id=$darray[$i] target=_self>$darray[$i]</a>]\n";
		}
	}
}
/*
 List files
*/
$fidx = count($farray);
if ($fidx > 0) {
	sort($farray);
	for ($i = 0; $i < $fidx; $i++) {

		// Read the timestamp of the file
		$idate = filemtime($farray[$i]);
		// Transfer timestamp into date
		$sdate = date('Y/m/d', $idate);
		$fsize = filesize($farray[$i]); // Get file size
		if ($fsize < 1024) {
			// 			printf("%5d B   ", $fsize); // in byte
		}
		else {
			$fsize = (float) ($fsize / 1024.0);
			if ($fsize < 1024.0) {
				// 				printf("%5.1f KB  ", $fsize);  // in KB
			}
			else {
				$fsize /= 1024.0;
				if ($fsize < 1024.0) {
					// 					printf("%5.1f MB  ", $fsize);  // in MB
				}
				else {
					$fsize /= 1024.0;
					// 					printf("%5.1f GB  ", $fsize);  // in GB
				}
			}
		}
		// 		echo $sdate."   ";
		// 		echo '  <a href="'.$path.$farray[$i].'">'.$farray[$i].'</a>'."\n";

	}
}


echo '</pre><hr><pre><font color="#808080" size="2">';
echo 'Select Patient ID to Continue'."\n";
echo $date.'</font></pre>';
echo '</body></html>';
?>


</head>

<body>

</body>

</html>
