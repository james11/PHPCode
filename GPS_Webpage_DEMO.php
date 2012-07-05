<html>

<head>
<center>
	<title>GPS Location Mapping</title>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />

	<script type="text/javascript"
		src="http://maps.google.com/maps/api/js?sensor=true"></script>

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
	// echo "<hr>";
	// echo "<br>";


	$blue = '#0000ff';
	$red = '#cc0033';
	$yellow = '#ffcc00';
	$green = '#00CC00';


	// // Get doctor name
	// $doctorname = $_POST["udoctorname"];
	// echo "Hi doctor "."<font color=$blue>$doctorname</font>".":<p>";

	// // Get patient name
	// $patientname = $_POST["upatientname"];
	// echo "Asking for patient "."<font color=$blue>$patientname</font>"."'s location ?<p>";

	// Compose file name to get location data
	$fid = $_POST["upatientid"];
	$fname=$_POST["udate"].".Location.txt";
	echo "The Location data file you asked is : ".$fname." </p>";
	echo "<br>";
	echo "<hr>";
	echo "<br>";


	$last_line = system("cp -r ../../SavedData/$fid/Location/$fname ./");


	// Read file INFO
	$i=0;
	$file = fopen($fname,"r");

	for($x=0;$x<=1000;$x++){
		$data[$x]=fgetc($file);
		if($data[$x] == ",") $data[$x] = "";
	}

	fclose($file);

	// Encode file INFO
	for($i=0;$i<=1000;$i=$i+11){

		if($data[$i] == "0") {
			if($data[$i+1] == "0") {
				if($data[$i+2] == "0") {
					$data[$i] = "";
					$data[$i+1] = "";
					$data[$i+2] = "0";
				}
				$data[$i+1] = "";
				$data[$i] = "*";
			}
			$data[$i] = "";
		}

		$string[$i/11]=
		$data[$i].$data[$i+1].$data[$i+2].
		$data[$i+3].$data[$i+4].$data[$i+5].
		$data[$i+6].$data[$i+7].$data[$i+8].
		$data[$i+9].$data[$i+10];
		if($string[$i/11] == "000.000000") $string[$i/11] = $string[($i/11)-2];


		//echo $string[$i/11]." _ ";
	};

	$last_line = system("rm -rf /Applications/MAMP/htdocs/phpBB3/ECGServer/PHPCode/$fname");

	?>





	<script type="text/javascript">
    
    
    	var longitude = new Array;
    	var latitude = new Array;
    
		longitude[0] = [<?php echo $string[0];?>];		latitude[0] = [<?php echo $string[1];?>];
		longitude[1] = [<?php echo $string[2];?>];		latitude[1] = [<?php echo $string[3];?>];
		longitude[2] = [<?php echo $string[4];?>];		latitude[2] = [<?php echo $string[5];?>];
		longitude[3] = [<?php echo $string[6];?>];		latitude[3] = [<?php echo $string[7];?>];
		longitude[4] = [<?php echo $string[8];?>];		latitude[4] = [<?php echo $string[9];?>];
		longitude[5] = [<?php echo $string[10];?>];		latitude[5] = [<?php echo $string[11];?>];
		longitude[6] = [<?php echo $string[12];?>];		latitude[6] = [<?php echo $string[13];?>];
		longitude[7] = [<?php echo $string[14];?>];		latitude[7] = [<?php echo $string[15];?>];
		longitude[8] = [<?php echo $string[16];?>];		latitude[8] = [<?php echo $string[17];?>];
		longitude[9] = [<?php echo $string[18];?>];		latitude[9] = [<?php echo $string[19];?>]; 
	
		longitude[10] = [<?php echo $string[20];?>];	latitude[10] = [<?php echo $string[21];?>];
		longitude[11] = [<?php echo $string[22];?>];	latitude[11] = [<?php echo $string[23];?>];
		longitude[12] = [<?php echo $string[24];?>];	latitude[12] = [<?php echo $string[25];?>];
		longitude[13] = [<?php echo $string[26];?>];	latitude[13] = [<?php echo $string[27];?>];
		longitude[14] = [<?php echo $string[28];?>];	latitude[14] = [<?php echo $string[29];?>];
		longitude[15] = [<?php echo $string[30];?>];	latitude[15] = [<?php echo $string[31];?>];
		longitude[16] = [<?php echo $string[32];?>];	latitude[16] = [<?php echo $string[33];?>];
		longitude[17] = [<?php echo $string[34];?>];	latitude[17] = [<?php echo $string[35];?>];
		longitude[18] = [<?php echo $string[36];?>];	latitude[18] = [<?php echo $string[37];?>];
		longitude[19] = [<?php echo $string[38];?>];	latitude[19] = [<?php echo $string[39];?>];
		
		longitude[20] = [<?php echo $string[40];?>];	latitude[20] = [<?php echo $string[41];?>];
		longitude[21] = [<?php echo $string[42];?>];	latitude[21] = [<?php echo $string[43];?>];
		longitude[22] = [<?php echo $string[44];?>];	latitude[22] = [<?php echo $string[45];?>];
		longitude[23] = [<?php echo $string[46];?>];	latitude[23] = [<?php echo $string[47];?>];
		longitude[24] = [<?php echo $string[48];?>];	latitude[24] = [<?php echo $string[49];?>];
	
        
        function initialize() {
            var myOptions = {
                zoom: 14,
                center: new google.maps.LatLng(latitude[24], longitude[24]),
                mapTypeId: google.maps.MapTypeId.ROADMAP
                
            };
            var map = new google.maps.Map(document.getElementById("map"), myOptions);
             
            // Creating an array with the points for "trackPath" and "Polygon"
            var trackPoints = [

                new google.maps.LatLng(latitude[0],longitude[0]),
                new google.maps.LatLng(latitude[1],longitude[1]),
                new google.maps.LatLng(latitude[2],longitude[2]),
                new google.maps.LatLng(latitude[3],longitude[3]),
                new google.maps.LatLng(latitude[4],longitude[4]),
                new google.maps.LatLng(latitude[5],longitude[5]),
                new google.maps.LatLng(latitude[6],longitude[6]),
                new google.maps.LatLng(latitude[7],longitude[7]),
                new google.maps.LatLng(latitude[8],longitude[8]),
                new google.maps.LatLng(latitude[9],longitude[9]),
                new google.maps.LatLng(latitude[10],longitude[10]),
                new google.maps.LatLng(latitude[11],longitude[11]),
                new google.maps.LatLng(latitude[12],longitude[12]),
                new google.maps.LatLng(latitude[13],longitude[13]),
                new google.maps.LatLng(latitude[14],longitude[14]),
                new google.maps.LatLng(latitude[15],longitude[15]),
                new google.maps.LatLng(latitude[16],longitude[16]),
                new google.maps.LatLng(latitude[17],longitude[17]),
                new google.maps.LatLng(latitude[18],longitude[18]),
                new google.maps.LatLng(latitude[19],longitude[19]),
                new google.maps.LatLng(latitude[20],longitude[20]),
                new google.maps.LatLng(latitude[21],longitude[21]),
                new google.maps.LatLng(latitude[22],longitude[22]),
                new google.maps.LatLng(latitude[23],longitude[23]),
                new google.maps.LatLng(latitude[24],longitude[24])
         
       
            ];

          
        	//Create the trackpath by trackPoints
    		var trackPath = new google.maps.Polyline({
                path: trackPoints,
                strokeColor: "#FF0000", // Line color
                strokeOpacity: .6, 
                strokeWeight: 3 
            });

            trackPath.setMap(map);

            // Create the polygon by trackPoints
            var polygon = new google.maps.Polygon({
            	path:trackPoints,
            	map: map,
            	strokeColor: "#FFCC00", 
                strokeOpacity: .4, 
                strokeWeight: 1, 
                fillColor: "#FFCC00",
                fillOpacity: 0.2
            });
            
            
            // Adding mouseover event to the polygon
            google.maps.event.addListener(polygon , 'mouseover' , function(e){
            	// Setting mouseover color to "Blue"
            	polygon.setOptions({
            		fillColor: '#00CC00',
            		strokeColor: '#00CC00'
            	});
            });

            // Adding mouseout event to the polygon
            google.maps.event.addListener(polygon , 'mouseout' , function(e){
            	// Setting mouseover color to "Red"            
            	polygon.setOptions({
            		fillColor: '#FFCC00',
            		strokeColor: '#FFCC00'
            	});
            });
            
            
       		// Create new icon
     		var man = new google.maps.MarkerImage(
     		'http://www.shankariasacademy.com/images/man-icon.jpg',
     		new google.maps.Size(40,40),
     		new google.maps.Point(20,10),
     		new google.maps.Point(16,30)
     		);
     	     		
            // Mark new icon onto map
            var marker = new google.maps.Marker({
            	position: new google.maps.LatLng(latitude[24],longitude[24]),
            	map: map,
            	icon: man,
            	clickable: false
            });
            
                            
            var infoWindow;
            
            // Add event handler for the markers click event
            google.maps.event.addListener(marker , 'click' , function(){
            	            	
            	// Creating the divs that will contain the detail map and links
            	var content = document.createElement('div'); // Content under ZoomOut mode
            	var content2 = document.createElement('div'); // Content under ZoomIn mode
            	
            	// Creating the paragraph that will contain the detail map
            	var detailDiv = document.createElement('p');
            	detailDiv.style.width = '280px';
            	detailDiv.style.height = '180px';
            	document.getElementById('map').appendChild(content);  
            	
            	// Create MapOptions for the overview map
            	var overviewOpts = {
            		zoom: 16,
            		center: marker.getPosition(),
            		mapTypeId: map.getMapTypeId(),
            		disableDefaultUI: false
            	};
            	
            	var detailMap = new google.maps.Map(detailDiv , overviewOpts);
            	
            	// Create a marker that will show in the detial map
            	var detailMarker = new google.maps.Marker({
            		position: marker.getPosition(),
            		map: detailMap,
  	            	clickable: false
            	});    
            	      	
            	

            	//function getAddress(){
            		var geocoder = new google.maps.Geocoder();
            		var geocoderRequest = {
						latLng: new google.maps.LatLng(latitude[24],longitude[24])
                	}

            		var position;
                    //location.href="GPS Webpage.php?position=" +position;
            		geocoder.geocode(geocoderRequest , function(results , status){
						position = 'Position: ';
						if(status == google.maps.GeocoderStatus.OK){
							position = position + results[0].formatted_address;
						}
                	});
            	//}


            	
				// Create a paragraph element to contain some text
            	var p = document.createElement('p');
            	p.innerHTML = 'This marker is the position of the patient.';


            	// Create a paragraph element to contain zoomin link
            	var pzi = document.createElement('p');
            	
            	// Create the clickable zoomin link
            	var azi = document.createElement('a');
            	azi.innerHTML = 'Zoom in';
            	azi.href = '#';
            	
            	// Adding a click event to the link that performs the zoom in,
            	// and cancels its default action
            	azi.onclick = function(){
            		//getAddress();
            		map.setCenter(marker.getPosition());
            		map.setZoom(18);
					infoWindow.setContent(content2);
           			return false;
            	};
            	
            	
            	// Create a paragraph element to contain zoomout link
            	var pzo = document.createElement('p');
            	
            	// Create the clickable zoomout link
            	var azo = document.createElement('a');
            	azo.innerHTML = 'Zoom out';
            	azo.href = '#';
            	
            	// Adding a click event to the link that performs the zoom out,
            	// and cancels its default action
            	azo.onclick = function(){
            		map.setCenter(marker.getPosition());
            		map.setZoom(14);
					infoWindow.setContent(content);
           			return false;
            	};


            	// Create a paragraph element to contain address get link
            	var pagl = document.createElement('p');
            	
            	// Create the clickable address get link
            	var agl = document.createElement('a');
            	agl.innerHTML = 'Show location address';
            	agl.href = '#';
            	
            	// Adding a click event to the link that performs the zoom in,
            	// and cancels its default action
            	agl.onclick = function(){
            		alert(position);
            	};



          		
            	// Appending links to paragraphs
            	pzi.appendChild(azi);
           		pzo.appendChild(azo);
           		pagl.appendChild(agl);

            	// Appending paragraphs to contents
            	content.appendChild(detailDiv);            	
				content.appendChild(pzi);
            	content2.appendChild(p);
				content2.appendChild(pzo);
				content2.appendChild(pagl);
				
            	

            	// Check to see if an infoWindow is already exists  
            	if(!infoWindow){
            		infoWindow = new google.maps.InfoWindow();
            	}            	
	
            	// Setting the content of the window
            	infoWindow.setContent(content);
            	            	
            	// Opening the InfoWindow
            	infoWindow.open(map , marker);
            	
            });
            	
            // Triggering the click event 
            google.maps.event.trigger(marker , 'click');	
                  
        }

            
</script>

	<?php
	echo $_GET['position'];
	?>
</center>
</head>


<body onload="initialize()">
	<center>
		<form id="form1">
			<div id="map" style="width: 600px; height: 800px;"></div>
		</form>
	</center>
</body>

</html>
