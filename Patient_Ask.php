<html>
<head>
<meta http-equiv="Content-Type" content="text/xml; charset=big5">
<title>Patient Select Webpage</title>
</head>

<body>
	<form name="form1" method="post" enctype="multipart/form-data"
		action="Patient_List.php">

		<p>
		
		
		<center>
			<p>
				<img
					src="http://www.thenewportcreek.com/img/icons/google_maps_icon.png"
					height="120" width="120"></img>
			</p>

			<font size=6> <font color=#0000ff> Wellcome </font>
			</font> <font size=6> <font color=#cc0033> to Patient </font>
			</font> <font size=6> <font color=#ffcc00> Select </font>
			</font> <font size=6> <font color=#00CC00> Webpage</font>
			</font>



			<p>
				Patient's ID： <input type="text" name="upatientID">
			</p>


			<p>
				File's Date ： <input type="text" name="udate">
			</p>


			<p>
				Start From : <select name="ustarttime" size="1">
					<option selected value="0">請選擇</option>
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
				Scale : <select name="uscale" size="1">
					<option selected value="0">請選擇</option>
					<option value="1">1 Sec</option>
					<option value="5">5 Sec</option>
					<option value="10">10 Sec</option>
					<option value="15">15 Sec</option>
					<option value="30">30 Sec</option>
				</select>
			</p>






			<p>
				<input type="submit" name="Submit" value="Patirnt_List"> <input
					type="reset" name="Reset" id="Reset" value="reset">
			</p>


		</center>
	</form>


</body>
<center>

	</font>
</center>
</html>
