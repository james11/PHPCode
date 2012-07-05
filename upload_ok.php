
<html>
<head>
<meta http-equiv="Content-Type" content="text/xml; charset=big5">
<title>File Uploading and Receiving</title>
</head>
<body>

	<?php


	// Create two timezone objects, one for Taipei (Taiwan) and one for
	// Tokyo (Japan)
	$dateTimeZoneTaipei = new DateTimeZone('Asia/Taipei'); // $dateTimeZoneTaipei = timezone_open('Asia/Taipei');
	$dateTimeZoneUS = new DateTimeZone('America/Los_Angeles'); // $dateTimeZoneUS = timezone_open('America/Los_Angeles');

	// Create two DateTime objects that will contain the same Unix timestamp, but
	// have different timezones attached to them.
	$dateTimeTaipei = new DateTime('now', $dateTimeZoneTaipei);
	$dateTimeUS = new DateTime('now', $dateTimeZoneUS);

	// Calculate the GMT offset for the date/time contained in the $dateTimeTaipei
	// object, but using the timezone rules as defined for Tokyo
	// ($dateTimeZoneJapan).
	$timeOffset = $dateTimeZoneUS->getOffset($dateTimeTaipei);
	$timeOffset = 8 - ($timeOffset / 60 / 60);

	//echo $filenamedate;
	echo "<br>";

	echo 'Now Time(Taiwan) : ';
	$hour = 60 * 60;
	echo date('Y/m/d  H:i:s', time())."<br>";
	echo "<br>";

	echo 'LA Time : ';
	$x = time() - $hour * $timeOffset;
	echo date('Y/m/d  H:i:s', $x)."<br>";
	echo "<br>";
	echo "<hr>";
	echo "<br>";




	// Receive userName from client side.
	echo "Hello ".$_POST["uname"]."<p>";

	// Receive userID from client side.
	$fid = $_POST["uid"];
	echo "UserID: ".$_POST["uid"]."<p>";

	// Receive userAddress from client side.
	echo "Address: ".$_POST["uaddress"]."<p>";

	// Decode package information
	$error_msg=$_FILES["ufile"]["error"];
	$fname=$_FILES["ufile"]["name"];
	$tmpname=$_FILES["ufile"]["tmp_name"];
	$fsize=$_FILES["ufile"]["size"];
	$ftype=$_FILES["ufile"]["type"];

	// Get file received date
	$filenamedate = date('YmdHis', time());

	// Floder names of different type of data file ＆ floder created date.
	$Dataflodername = "ECG";
	$Locationflodername = 'Location';
	$Mseflodername = 'RRmse';
	$floderdate = date('YmdH', time());


	// Check if uploading is success
	if($error_msg)
	{
		echo "<font color=red>Uploading failed!</font><p>";
		echo "Error Message -> ".$error_msg;
	}
	else
	{
		echo "Receive file successfully<br>";
		echo "Received file name -> ".$fname."<br>";
		echo "Temporart file dir -> ".$tmpname."<br>";
		echo "File size -> ".$fsize." B"."<br>";
		echo "File formate -> ".$ftype."<br>";
		echo "<hr>";



		/*======================= Create UserID floder under /Volumes/Macintosh HD2/Server Data =========================*/

		if(!file_exists("/Volumes/Macintosh HD2/Server Data/$fid")){
			mkdir ("/Volumes/Macintosh HD2/Server Data/$fid" , 0777);
		}


		/*======================================== Different DataType Processing ========================================*/


		/*========== For ECG.txt data files ==========*/

		if(preg_match(".ECG.", $fname)){


			/*========== Createing new zip file every hour if there has ECG floder to be compressed ==========*/
			/*=============== ECG data received from 16:00 ~ 17:00 will be compressed at 17:00 ===============*/

			if(!file_exists("/Volumes/Macintosh HD2/Server Data/$fid/$floderdate.zip")){

				echo "Date of last compressing: ".$lastfloderdate."<br>";

				include ("pclzip.lib.php");
				$zipName=($floderdate).".zip";
				$zipFile=($Dataflodername);

				//If there is no ECG floder to compressed , create new ECG floder .
				if(!file_exists("/Volumes/Macintosh HD2/Server Data/$fid/$Dataflodername")){
					echo "No data to be compress!!"."<br>";
					mkdir ("/Volumes/Macintosh HD2/Server Data/$fid/$Dataflodername" , 0777);
				}

				// Create new zip file
				else{

					$archive = new PclZip($zipName);

					$v_list = $archive->add("/Volumes/Macintosh HD2/Server Data/$fid/$zipFile",
							PCLZIP_OPT_REMOVE_PATH,"/Volumes/Macintosh HD2/Server Data/$fid");

					// Move the compressed zip file to assigned dir .
					rename("$zipName","/Volumes/Macintosh HD2/Server Data/$fid/$zipName");

					// Report compressing error message
					if ($v_list == 0) {
						die("Error : ".$archive->errorInfo(true));
					}

					// Delete the compressed ECG floder
					include ("deletefloder.php");
					$dir = "/Volumes/Macintosh HD2/Server Data/$fid/$zipFile";
					delTree($dir);

				}
				$lastfloderdate = $floderdate;
			}

			$uploads_dir="/Volumes/Macintosh HD2/Server Data/$fid/$Dataflodername";

			$name=$fname;

			// Copy the  file to assigned dir
			$success=copy($tmpname,"$uploads_dir/$name");


		}


		/*========== For Location.txt location files ==========*/

		else if(preg_match(".Location.", $fname)){

			if(!file_exists("/Volumes/Macintosh HD2/Server Data/$fid/$Locationflodername")){

				mkdir ("/Volumes/Macintosh HD2/Server Data/$fid/$Locationflodername" , 0777);

			}

			$uploads_dir="/Volumes/Macintosh HD2/Server Data/$fid/$Locationflodername";

			$name=$fname;

			// Copy the  file to assigned dir
			$success=copy($tmpname,"$uploads_dir/$name");


		}


		/*========== For RR.txt R-R interval files ==========*/

		else if(preg_match(".RR.", $fname)){

			if(!file_exists("./$fid")){
				mkdir ("./$fid" , 0777);
				if(!file_exists("./$fid/$Mseflodername")){
					mkdir ("./$fid/$Mseflodername" , 0777);
				}
			}

			// Save received file to an exist dir temprorarily
			copy($tmpname,"./$fid/$Mseflodername/$fname");

			$command = array(
					//0=>"mkdir $Mseflodername",
					1=>"./mse.app <./$fid/$Mseflodername/$fname> ./$fname",
					//2=>"rm -rf $fname"
			);

			for($i=0; $i<3; $i++) {
				$last_line = system($command[$i], $retval);
			}

			if(!file_exists("/Volumes/Macintosh HD2/Server Data/$fid/$Mseflodername")){
				mkdir ("/Volumes/Macintosh HD2/Server Data/$fid/$Mseflodername" , 0777);
			}

			$uploads_dir="/Volumes/Macintosh HD2/Server Data/$fid/$Mseflodername";

			$name=$fname;

			$success=copy("./$fname","$uploads_dir/$name");

			unlink($fname);


			echo '
			</pre>
			Last line of the output: ' . $last_line."<br>
			Return value: ". $retval."<hr />";
		}


		if($success){

			echo "Uploading Success!!<br>";
			echo "Database dir: ";
			echo realpath("$uploads_dir/$name")."<p>";
			// Delete $tmpname .
			unlink($tmpname);

		}else{
			echo "<font color=red>Cannot copy file!</font>";
		}

	}

	?>

</body>
</html>
