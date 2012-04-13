<?php
if(strlen($_GET["numero"]) > 7){
	$id = $_GET["numero"];
	if(isset($_GET["ders"])){
		echo "<b>Ders Programı</b>";
		echo "<br />";
	
	}else if(isset($_GET["vize"])){
		echo "<b>Vize Programı</b>";
		echo "<br />";
	
	}else if(isset($_GET["final"])){
		printHeader();
		echo "<b>Final Programı</b>";
		echo "<br />";
		
		
$url = "http://kayit.etu.edu.tr/final/Final_prg.php";
$ch = curl_init();	
curl_setopt($ch, CURLOPT_URL,$url);	
curl_setopt($ch, CURLOPT_POST,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'ogrencino='.$id.'&btn_ogrenci=Programı Göster');	
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);	
$returned = curl_exec($ch);	
curl_close ($ch);
$returned = mb_convert_encoding($returned, 'UTF-8'); 
$turkish = array("ý","Ý","ð","Ð","þ","Þ");
$english= array("ı","İ","ğ","Ğ","ş","Ş");
$returned=str_replace($turkish, $english, $returned);

$returned = substr($returned,strpos($returned,'</tr>')+6,-10);
//echo  $returned;
//echo "<hr>";
$returned = str_replace('<center>','<hr>',$returned);
$returned = str_replace('<th bgcolor=#FFCCFF>','<hr>',$returned);

$returned = strip_tags($returned,'<hr><br>');
//echo $returned;
//echo "<hr>";
$array = explode("<hr>",$returned);
//print_r($array);
//echo "<hr>";
$a=0;
for($i=1;$i<71;$i+=5){
	$date = $array[$i];
	$ilk = $array[$i+1];
	$ikinci = $array[$i+2];
	$ucuncu = $array[$i+3];
	$dorduncu = $array[$i+4];
	if(strlen($ilk)>3||strlen($ikinci)>3||strlen($ucuncu)>3||strlen($dorduncu)>3){
		if(strlen($ilk)>3){
			$time = "8:30-11:00";
			$ilk = explode("<br>",$ilk);
			$ilk[0]=substr($ilk[0],9);
			$ilk[1]=substr($ilk[1],6);
			$ilk[2]=substr($ilk[2],6);
			//echo $ilk;
			$array2[$a] = "<hr/><span class='comment'>".$date."<br/> <i>".$time."</i></span><br /><span class='name'>".$ilk[1]." <i>Şube: ".$ilk[2]."</i> 
						</span><br /><b>Sınıf: ".$ilk[0]."</b>";
						$a=$a+1;
		}
		if(strlen($ikinci)>3){
			$time ="11:30-14:00";
			$ilk = explode("<br>",$ikinci);
			$ilk[0]=substr($ilk[0],9);
			$ilk[1]=substr($ilk[1],6);
			$ilk[2]=substr($ilk[2],7);
			$array2[$a] = "<hr/><span class='comment'>".$date."<br/> <i>".$time."</i></span><br /><span class='name'>".$ilk[1]." <i>Şube: ".$ilk[2]."</i> 
						</span><br /><b>Sınıf: ".$ilk[0]."</b>";
						$a=$a+1;
		}
		if(strlen($ucuncu)>3){
			$time = "14:30-17:00";
			$ilk = explode("<br>",$ucuncu);
			$ilk[0]=substr($ilk[0],9);
			$ilk[1]=substr($ilk[1],6);
			$ilk[2]=substr($ilk[2],7);
			$array2[$a] = "<hr/><span class='comment'>".$date."<br/> <i>".$time."</i></span><br /><span class='name'>".$ilk[1]." <i>Şube: ".$ilk[2]."</i> 
						</span><br /><b>Sınıf: ".$ilk[0]."</b>";
						$a=$a+1;
		}
		if(strlen($dorduncu)>3){
			$time = "17:30-20:00";
			$ilk = explode("<br>",$dorduncu);
			$ilk[0]=substr($ilk[0],9);
			$ilk[1]=substr($ilk[1],6);
			$ilk[2]=substr($ilk[2],7);
			$array2[$a] = "<hr/><span class='comment'>".$date."<br/> <i>".$time."</i></span><br /><span class='name'>".$ilk[1]." <i>Şube: ".$ilk[2]."</i> 
						</span><br /><b>Sınıf: ".$ilk[0]."</b>";
						$a=$a+1;
		}
		
	}

}
if(isset($array2)){
foreach($array2 as $a){
	echo $a;
}
}else{
	echo "Öğrenci bulunamadı";
}
	printFooter();
	
	}else{
		redirect();
	}
}else{
	redirect();
}


function redirect(){
	header('Location: ./index.html');
	exit();
}

function printHeader(){
echo "<html><head>
<title>ETU-Mobile</title>
<meta content='text/html; charset=utf-8' http-equiv='Content-Type' />
</head><body>";
}
function printFooter(){
echo "</body>
</html>";

}
?>