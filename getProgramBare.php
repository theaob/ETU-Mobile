<?php

                
        if(isset($_GET["ogrenci"]) ){
                $id=$_GET["ogrenci"];
                $url = "http://kayit.etu.edu.tr/kayit/dersprogrami.php?ogrenci=".$id."&sube=0";
                
                $homepage = file_get_contents($url);
				$homepage = substr($homepage,639);
				$homepage = substr($homepage,0,-2);
				$homepage = strip_tags($homepage,'<br>');
				
				$homepage = mb_convert_encoding($homepage, 'UTF-8'); 
                $turkish = array("ý","Ý","ð","Ð","þ","Þ");
                $english= array("ı","İ","ğ","Ğ","ş","Ş");
                $homepage=str_replace($turkish, $english, $homepage);
				
				$array = explode("<br>",$homepage);	
				
				$array2;
				
				for($i=0;$i<count($array)-1;$i++){
				
					$array2[$i] = mb_substr($array[$i],-11,11,"UTF-8");
				
				}
				
				print_r($array2);
                                
        } else {
              echo "<div class='alert-message error'><p>Bir hata oluştu. Lütfen daha sonra tekrar deneyin</p></div>";
        }
?>