<html>

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Patient Select Webpage</title>

<center>

	<?php 

	// Receive variable from "Select_ID.php"
	$zipFile = $_GET['zipFile'];
	// 	echo $zipFile."<br>";
	$id = $_GET['id'];
	// 	echo $id."<br>";

	?>

</center>
</head>

<body>
	<form name="form1" method="post" enctype="multipart/form-data"
		action="Waveform_Response.php">

		<p>
		
		
		<center>
			<p>
				<img
					src="http://www.ntuh.gov.tw/_catalogs/masterpage/V2/images/logo1.gif"
					height="80" width="300"></img>
			</p>

			<font size=6> <font color=#0000ff> Welcome </font>
			</font> <font size=6> <font color=#cc0033> to Patient </font>
			</font> <font size=6> <font color=#ffcc00> Select </font>
			</font> <font size=6> <font color=#00CC00> Webpage</font>
			</font>



			<p>
				Patient ID: <input name="upatientID" value="<?php echo $id;?>">
			</p>


			<p>
				File Date: <input name="udate" value="<?php echo $zipFile;?>">
			</p>


			<p>
				Start From: <select name="ustarttime" size="1">
					<option selected value="0">Select</option>
					<option value="0">head</option>
					<option value="1">1st</option>
					<option value="2">2nd</option>
					<option value="3">3th</option>
					<option value="4">4th</option>
					<option value="5">5th</option>
					<option value="6">6th</option>
					<option value="7">7th</option>
					<option value="8">8th</option>
					<option value="9">9th</option>
				</select> Minute
			</p>

			<p>
				Scale: <select name="uscale" size="1">
					<option selected value="0">Select</option>
					<option value="1">1</option>
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="30">30</option>
				</select> Second
			</p>


			<p>
				<input type="submit" name="Submit" value="Ask Waveform"> <input
					type="reset" name="Reset" id="Reset" value="reset">
			</p>


			<!-- 			<p> -->
			<!-- 				<input type="radio" name=utest value=1234><label>QQ</label> -->
			<!-- 			</p> -->

			<?php
			echo "<h3>";
			echo "<a href=http://140.114.14.54/phpBB3/ECGServer/PHPCode/Select_ID.php? target=_self>\t Back to ID Select Webpage</a>";
			echo "<br>"."<br>";
			?>

		</center>
	</form>


</body>
<center>

	</font>
</center>
</html>
