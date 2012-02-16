<?php

		function printday($array, $day){
			echo '<ul><li><span class="number">08:30</span><span class="name" id="slot1">
            '.$array[$day].'</span> </span></li>
			
            <li><span class="number">09:30</span><span class="name" id="slot2">
            '.$array[$day+8].'</span> </span></li>
            
            <li><span class="number">10:30</span><span class="name" id="slot3">
            '.$array[$day+16].'</span> </span></li>
            
            <li><span class="number">11:30</span><span class="name" id="slot4">
            '.$array[$day+24].'</span></span></li>
            
            <li><span class="number">12:30</span><span class="name" id="slot5">
            '.$array[$day+32].'</span> </span></li>
            
            <li><span class="number">13:30</span><span class="name" id="slot6">
            '.$array[$day+40].'</span> </span></li>
            
            <li><span class="number">14:30</span><span class="name" id="slot7">
            '.$array[$day+48].'</span> </span></li>
            
            <li><span class="number">15:30</span><span class="name" id="slot8">
            '.$array[$day+56].'</span></span></li>
            
            <li><span class="number">16:30</span><span class="name" id="slot9">
            '.$array[$day+64].'</span></span></li>
            
            <li><span class="number">17:30</span><span class="name" id="slot10">
            '.$array[$day+72].'</span> </span></li>
            
            <li><span class="number">18:30</span><span class="name" id="slot11">
            '.$array[$day+80].'</span> </span></li>
            
            <li><span class="number">19:30</span><span class="name" id="slot12">
            '.$array[$day+88].'</span> </span></li>
            
            <li><span class="number">20:30</span><span class="name" id="slot13">
            '.$array[$day+96].'</span> </span></li></ul><br/>';
		
		
		}

        if(isset($_GET["ogrenci"]) ){
                $id=$_GET["ogrenci"];
                $url = "http://kayit.etu.edu.tr/kayit/dersprogrami.php?ogrenci=".$id."&sube=0";
                //echo $url;
				
				
               // $input = @file_get_contents($url) or die("Could not access file: $url");

                //$input = substr($input, 0, strpos($input,"<br>"));
                //$numara = $input->find("
                
                $homepage = file_get_contents($url,NULL,NULL,607);
                $homepage = mb_convert_encoding($homepage, 'UTF-8'); 
                $turkish = array("ý","Ý","ð","Ð","þ","Þ");
                $english= array("ı","İ","ğ","Ğ","ş","Ş");
                $homepage=str_replace($turkish, $english, $homepage);
				$homepage = strip_tags($homepage,'<center><br>');
				
				$homepage = str_replace('center','hr',$homepage);
				$homepage = str_replace('<br>','&nbsp;|&nbsp;',$homepage);
				
				$array = explode("<hr>",$homepage);
                                echo json_encode($array);
				
				//print_r($array);
				/*
				echo "oo1oo"; //2
				printday($array, 2);
				echo "oo2oo";
				printday($array, 3);
				echo "oo3oo";
				printday($array, 4);
				echo "oo4oo";
				printday($array, 5);
				echo "oo5oo";
				printday($array, 6);
				echo "oo6oo";
				printday($array, 7);
				echo "oo7oo";
				printday($array, 8);
				echo "oo8oo";*/
				
                //print($homepage);
        } else {
              echo "<div class='alert-message error'><p>Bir hata oluştu. Lütfen daha sonra tekrar deneyin</p></div>";
        }
?>