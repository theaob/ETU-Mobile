<?php
        if(isset($_GET["ogrenci"]) ){
                $id=$_GET["ogrenci"];
                $url = "http://kayit.etu.edu.tr/kayit/dersprogrami.php?ogrenci=".$id."&sube=0";
                //echo $url;
				
				
               // $input = @file_get_contents($url) or die("Could not access file: $url");

                //$input = substr($input, 0, strpos($input,"<br>"));
                //$numara = $input->find("
                
                $homepage = file_get_contents($url);
                $homepage = mb_convert_encoding($homepage, 'UTF-8'); 
                $turkish = array("ý","Ý","ð","Ð","þ","Þ");
                $english= array("ı","İ","ğ","Ğ","ş","Ş");
                $homepage=str_replace($turkish, $english, $homepage);

                print($homepage);
        } else {
              echo "<div class='alert-message error'><p>Bir hata oluştu. Lütfen daha sonra tekrar deneyin</p></div>";
        }
?>