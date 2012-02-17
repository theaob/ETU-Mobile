<?php

		function printday($array, $day){
			return '<ul><li><span class="number" style="width:55px">08:30</span><span class="name" id="slot1">
            '.$array[$day].'</span> </li>
			
            <li><span class="number" style="width:55px">09:30</span><span class="name" id="slot2">
            '.$array[$day+8].'</span></li>
            
            <li><span class="number" style="width:55px">10:30</span><span class="name" id="slot3">
            '.$array[$day+16].'</span></li>
            
            <li><span class="number" style="width:55px">11:30</span><span class="name" id="slot4">
            '.$array[$day+24].'</span></li>
            
            <li><span class="number" style="width:55px">12:30</span><span class="name" id="slot5">
            '.$array[$day+32].'</span></li>
            
            <li><span class="number" style="width:55px">13:30</span><span class="name" id="slot6">
            '.$array[$day+40].'</span></li>
            
            <li><span class="number" style="width:55px">14:30</span><span class="name" id="slot7">
            '.$array[$day+48].'</span></li>
            
            <li><span class="number" style="width:55px">15:30</span><span class="name" id="slot8">
            '.$array[$day+56].'</span></li>
            
            <li><span class="number" style="width:55px">16:30</span><span class="name" id="slot9">
            '.$array[$day+64].'</span></li>
            
            <li><span class="number" style="width:55px">17:30</span><span class="name" id="slot10">
            '.$array[$day+72].'</span></li>
            
            <li><span class="number" style="width:55px">18:30</span><span class="name" id="slot11">
            '.$array[$day+80].'</span></li>
            
            <li><span class="number" style="width:55px">19:30</span><span class="name" id="slot12">
            '.$array[$day+88].'</span></li>
            
            <li><span class="number" style="width:55px">20:30</span><span class="name" id="slot13">
            '.$array[$day+96].'</span></li></ul>';
		
		
		}
                

        if(isset($_GET["ogrenci"]) ){
                $id=$_GET["ogrenci"];
                $url = "http://kayit.etu.edu.tr/kayit/dersprogrami.php?ogrenci=".$id."&sube=0";
                
                $homepage = file_get_contents($url,NULL,NULL,607);
                $homepage = mb_convert_encoding($homepage, 'UTF-8'); 
                $turkish = array("ý","Ý","ð","Ð","þ","Þ");
                $english= array("ı","İ","ğ","Ğ","ş","Ş");
                $homepage=str_replace($turkish, $english, $homepage);
				$homepage = strip_tags($homepage,'<center><br>');
				
				$homepage = str_replace('center','hr',$homepage);
				$homepage = str_replace('<br>','</span>&nbsp;<span class="place">',$homepage);
				
				$array = explode("<hr>",$homepage);
                                
                                
                                
                                
                                for($i=0; $i<7;$i++){
                                    $array2[$i] = printday($array, $i+2);
                                }
                                
                                
                                echo json_encode($array2);
				
                                
        } else {
              echo "<div class='alert-message error'><p>Bir hata oluştu. Lütfen daha sonra tekrar deneyin</p></div>";
        }
?>