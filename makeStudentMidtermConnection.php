<?php
	if(isset($_GET["ogrenci"]) ){
				//include("connection.php");
				
				   $host="localhost"; 
					$kullanici="root"; 
					$sifre=""; 
					$vtadi="etunet"; 

					//$connection=mysql_connect($host,$kullanici,$sifre);
					//mysql_select_db($vtadi,$connection);
					$connection=new mysqli($host,$kullanici,$sifre,$vtadi);
					$connection->set_charset("utf8");
					
				
				$id = $_GET["ogrenci"];
				
				$query = "SELECT COUNT(studentID) AS students FROM etumobile_student_midterm WHERE studentID= '".$id."' LIMIT 1";
				//echo $query;
				$result = $connection->query($query);
				//$homepage = $connection->query($query);
					
					$result = $result->fetch_array();
				//echo $result;
				
				//$result = $result->fetch_object();
				
				//print_r($result);
				
				if($result[0]==0){
					//echo "RESULT EMPTY";
					$array = getLectures($id);
					$array = array_unique($array);
					//print_r($array);
					
					$k=0;
					foreach($array as $array2){
						$lecture_tag = mb_substr($array2,0,strpos($array2," ")+5);
						$branch = mb_substr($array2,-1);
						if(substr($lecture_tag,-1)==" "){
							$lecture_tag = substr($lecture_tag,0,-1);
						
						}
						if(strlen($lecture_tag)>6){
							$newarray[$k] = array($lecture_tag,$branch);
							$k=$k+1;
						}
					}
					
					
					//asort($newarray); //DERS KODUNA GÖRE SIRALA
					//ksort($newarray);
					//print_r($newarray);
					
					//echo "<hr/>";
					$k=0;
					$lastarray;
					foreach($newarray as $array){
						$query = "SELECT * FROM etumobile_midterm WHERE lesson_tag='".$array[0]."' AND etumobile_midterm.branch=".$array[1]."";
						
						//echo $query;
						
						//echo "<hr/>";
						$result = $connection->query($query);
						/*$result -> bind_param('isssssss',$lesson_id,$lesson_tag,$lesson_name,$branch,$place, $date,$day,$time);
						$result -> execute();
						$result -> bind_result();
						$result -> fetch();
						$result -> close();*/
						$result = $result->fetch_array();
						//print_r($result);
						//echo "<br>";
						//
						if($result['lesson_name']!=null){
						
						
							$lastarray[$k]=array($result['lesson_name'],$result['lesson_tag'],$result['branch'],$result['place'],$result['date'],$result['day'],$result['time']);
							$k++;
						}
						
						
					
					
					}
					
					function sortByOrder($a, $b) {
						return strtotime($a[4]) - strtotime($b[4]);
					}

					usort($lastarray, 'sortByOrder');
					
					//$newarray = array_unique($newarray);
					$newarray = "";
					foreach($lastarray as $result){
					
						$newarray.="<li class='store'><span class='comment'>".$result[0]."</span><span class='name'>".$result[1]." <i>Şube: ".$result[2]."</i> 
						</span><span class='stars'>".$result[3]."</span><span class='starcomment'>".$result[4]." ".$result[5]." | ".$result[6]."</span></li>";
					
					
					}
					
					
					
					print_r($newarray); //$item = json_encode($lastarray);
					
					$query = "INSERT INTO etumobile_student_midterm VALUES('".$id."','".addslashes($newarray)."')";
					
					//echo $query;
					$connection->query($query);
					$connection->close();
				}else{
					//echo "Pulled from DB";
					$query = "SELECT programme FROM etumobile_student_midterm WHERE studentID='".$id."' LIMIT 1";
					
					$homepage = $connection->query($query);
					
					$homepage = $homepage->fetch_array();
					
					//echo($homepage->lesson_id);
					
					echo($homepage[0]);
				}
                
                
                
				
        } else {
              echo "<div class='alert-message error'><p>Bir hata oluştu. Lütfen daha sonra tekrar deneyin</p></div>";
        }
		
		function getLectures($id){
                //$id=$_GET["ogrenci"];
                $url = "http://kayit.etu.edu.tr/kayit/dersprogrami.php?ogrenci=".$id."&sube=0";
                
                $homepage = file_get_contents($url);
				$homepage = substr($homepage,639);
				$homepage = substr($homepage,0,-2);
				$homepage = strip_tags($homepage,'<br><center>');
				
				$homepage = mb_convert_encoding($homepage, 'UTF-8'); 
                $turkish = array("ý","Ý","ð","Ð","þ","Þ");
                $english= array("ı","İ","ğ","Ğ","ş","Ş");
                $homepage=str_replace($turkish, $english, $homepage);
				
				$array = explode("<br>",$homepage);	
				
				$array2;
				
				for($i=0;$i<count($array)-1;$i++){
					
					//$array[$i] = htmlspecialchars($array[$i]);
					$array2[$i] = mb_substr($array[$i],   strrpos($array[$i],"<center>")+8,12,"UTF-8");
					//$array2[$i][2] = $array[$i];
				}
				
				return $array2;//2;
                                
        }



?>