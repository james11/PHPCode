
<html>
<head>
<meta http-equiv="Content-Type" content="text/xml; charset=big5">
<title>File Uploading and Receiving</title>
</head>
<body>

	<?php

	$a = "123456";
	echo "$a";
	echo "<br>";
	echo $a;
	echo "<br>";

	$b = "aaa %3s";

	printf($b,$a);
	echo "<br>";
	$num = 5;
	$location = 'tree';

	$format= 'The %2$2s contains %1$04d monkeys';
	printf($format, $num, $location);

	?>

</body>
</html>
