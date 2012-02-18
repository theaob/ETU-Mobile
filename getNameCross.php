<?php
        if(isset($_GET["ogrenci"]) ){
		
			$host="localhost"; 
					$kullanici="root"; 
					$sifre=""; 
					$vtadi="etunet"; 

					$connection=new mysqli($host,$kullanici,$sifre,$vtadi);
					$connection->set_charset("utf8");
					$st=$connection->stmt_init();
					//mysql_query("SET NAMES utf8");
					
				$id = $_GET["ogrenci"];
				
				$query = "SELECT name FROM etumobile WHERE studentID= '".$id."' LIMIT 1";
				
				$result = $connection->query($query);
				
				if($result->num_rows!="1"){
				
					//echo "RESULT EMPTY";
					$url = "http://st081101017.etu.edu.tr/getProgram.php?ogrenci=".$id."";
					$url2 = "http://st081101017.etu.edu.tr/getName.php?ogrenci=".$id."";
					
					$homepage = file_get_contents($url);
					$name = file_get_contents($url2);
					
					$name = strip_tags($name);
					
					print($name);
					
					$homepage = $connection->real_escape_string($homepage);
					
					$query = "INSERT INTO etumobile VALUES('".$id."','".$homepage."','".$name."')";
				
					$connection->query($query);
					
					//print($homepage);
					
				}else{
					//echo "Pulled from DB";
					$query = "SELECT name FROM etumobile WHERE studentID='".$id."' LIMIT 1";
					
					$homepage = $connection->query($query);
					
					$homepage = $homepage->fetch_object();
					
					echo($homepage->name);
				}
        } else {
              echo "<div class='alert-message error'><p>Bir hata oluştu. Lütfen daha sonra tekrar deneyin</p></div>";
        }
?>