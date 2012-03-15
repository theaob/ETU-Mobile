<?php 
    $host="localhost"; 
    $kullanici="root"; 
    $sifre="1244244"; 
    $vtadi="etunet"; 

    $connection=new mysqli($host,$kullanici,$sifre,$vtadi);
    $connection->set_charset("utf8");
    $st=$connection->stmt_init();
    //mysql_query("SET NAMES utf8");

?>