<html>

<head>
<meta http-equiv="Content-Type" content="text/xml; charset=big5">
<title>Data File Select Webpage</title>


<?
echo $_GET['id']."<br>";

if ($_GET['id']) {
	$id = $_GET['id'];
	echo $_GET['id']."<br>";
}

$date = '2002/12/21';  
$dir = "/Applications/MAMP/htdocs/phpBB3/SavedData/$id";

echo '<html><head><meta http-equiv="Content-Type" ';
echo 'content="text/html; charset=big5">';
echo '<title>Testing PHP for hierList</title></head><body>';
/*
   ���F�O�ҩҩ� index.php ���ؿ��O�ڥؿ��A$path ���i�H�� '..' �ӫe���@�w�O './'
*/
if (($path == "") || (substr_count($path, '..') > 0) ||
   (substr($path, 0, 2)) != './') $path = './';
$tmp = substr($path, 1);
echo "<h3>Index of $tmp </h3>\n<pre>";
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
         echo '<a href="http://140.114.14.54'.$dir.$darray[$i].'/">'.$darray[$i].'</a>]'."\n";
      }
   }
}
/*
   �C�X�ɮצC��
*/
$fidx = count($farray);
if ($fidx > 0) {
   sort($farray); // �ƦC
   for ($i = 0; $i < $fidx; $i++) {
   // Ū�ɮת�timestamp�]�ɶ��W�O�^
      $idate = filemtime($farray[$i]);
   // �Ntimestamp�ഫ��date�]����^
      $sdate = date('Y/m/d', $idate);
      $fsize = filesize($farray[$i]); // Ū�ɮפj�p
      if ($fsize < 1024) {
         printf("%7d B   ", $fsize); // ��byte
      }
      else {
         $fsize = (float) ($fsize / 1024.0);
         if ($fsize < 1024.0) {
            printf("%5.1f KB  ", $fsize);  // ��KB
         }
         else {
            $fsize /= 1024.0;
            if ($fsize < 1024.0) {
                 printf("%5.1f MB  ", $fsize);  // ��MB
            }
            else {
               $fsize /= 1024.0;
               printf("%5.1f GB  ", $fsize);  // ��GB
            }
         }
      }
      echo $sdate;
//       echo '  <a href="'.$path.$farray[$i].'">'.$farray[$i].'</a>'."\n";
      echo "<a href=http://140.114.14.54/phpBB3/ECGServer/PHPCode/Patient_Ask.php?id=$farray[$i] target=_self>$farray[$i]/</a><br>";
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

<p>
<input type = "radio" name = utest value = 1234><label>QQ</label>
</p>

</body>

</html>