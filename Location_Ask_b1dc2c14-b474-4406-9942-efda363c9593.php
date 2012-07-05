<html>
<head>
<meta http-equiv="Content-Type" content="text/xml; charset=big5">
<title>Location get Webpage</title>
</head>

<body>
	<form name="form1" method="post" enctype="multipart/form-data"
		action="GPS_Webpage_DEMO.php">

		<p>
		
		
		<center>
			<p>
				<img
					src="http://www.thenewportcreek.com/img/icons/google_maps_icon.png"
					height="120" width="120"></img>
			</p>
			<font size=6> <font color=#0000ff> Welcome </font>
			</font> <font size=6> <font color=#cc0033> to GPS </font>
			</font> <font size=6> <font color=#ffcc00> Location Get </font>
			</font> <font size=6> <font color=#00CC00> Webpage</font>
			</font>


<!-- 			<p> -->
<!-- 				Patient ID： <input type="text" name="upatientid"> -->
<!-- 			</p> -->

<!-- 			<p> -->
<!-- 				Year： <input type="text" name="uyear"> (ex: 2011 or 2012) -->
<!-- 			</p> -->

			<p>
				Patient ID : <select name="upatientid" size="1">
					<option selected value="0">請選擇</option>
					<option value="3ee24b28-44ed-41f1-864f-f965a5bae2c0">Tzu-Yu Kuo</option>
					<option value="f48770bd-c911-4568-af67-96808b7d6729">Ching-Wei Chen</option>
					<option value="b1dc2c14-b474-4406-9942-efda363c9593">Cheng-Wei Hsiao</option>
					<option value="86e03ff3-3d4b-4a62-86cf-b8529fdf80ff">Kuang-Jer Tam</option>
<!-- 					<option value="a6d157b5-1e23-4b75-ae60-40334fce2d50">Chun-Chieh Chan</option> -->
				</select> 
			</p>	

			<p>
				Location : <select name="udate" size="1" if(uAA==0)>
					<option selected value="0">請選擇</option>
					<option value="201206182220">2012/06/18/22:20</option>
					<option value="201206182230">2012/06/18/22:30</option>
					<option value="201206182240">2012/06/18/22:40</option>
					<option value="201206182250">2012/06/18/22:50</option>
				</select>
			</p>

<!-- 			<p> -->
<!-- 				Date： <input type="text" name="udate"> (ex: 0718 or 1123) -->
<!-- 			</p> -->

<!-- 			<p> -->
<!-- 				Time： <input type="text" name="utime"> (ex: 0723 or 1945) -->
<!-- 			</p> -->

			<p>
				<input type="submit" name="Submit" value="Get Location"> <input
					type="reset" name="Reset" id="Reset" value="reset">
			</p>

		</center>
	</form>


</body>
<center>
	<font size=1>http://www.thenewportcreek.com/img/icons/google_maps_icon.png
	</font>
</center>
</html>
