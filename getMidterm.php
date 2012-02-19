<?php

$url = "http://oim.etu.edu.tr/tr/content/ara-sinav-programi";
$input = file_get_contents($url); //or die("Could not access file: $url");
//$homepage = mb_convert_encoding($homepage, 'UTF-8'); 
$input = substr($input,31340,strpos($input,"</table>")-31336);

//echo "<table border=1>";
echo $input;
?>