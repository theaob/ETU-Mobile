<?php

$url = "http://oim.etu.edu.tr/tr/content/ara-sinav-programi";
$input = file_get_contents($url); //or die("Could not access file: $url");
//$homepage = mb_convert_encoding($homepage, 'UTF-8'); 
$input = substr($input,31340,strpos($input,"</table>")-31336);





//echo "<table border=1>";

$input = str_replace("</td>","|",$input);
$input = strip_tags($input);
$input = explode('|',$input);

 $host="localhost"; 
$kullanici="root"; 
$sifre=""; 
$vtadi="etunet"; 

$connection=new mysqli($host,$kullanici,$sifre,$vtadi);
$connection->set_charset("utf8");


//print_r($input);
//echo $input;

$count = count($input)-1;
$say = $count / 9;

echo "There are ".$say." midterm exams available";




for($i=0;$i<$count;$i){
	
	$query = "INSERT INTO etumobile_midterm VALUES( '','".$input[$i]."','".addslashes($input[$i+1])."','".$input[$i+2]."','".$input[$i+4]."','".$input[$i+5]."','".$input[$i+6]."','".$input[$i+7]."')";
	
	$connection->query($query);
	
	$i = $i + 9;
}







?>