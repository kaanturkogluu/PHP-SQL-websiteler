<?php 

// Vt baglan 
header("Content-Type: text/html; charset=utf-8");
//error_reporting(0)
setlocale(LC_ALL ,'tr_TR.UTF-8', 'tr_TR', 'tr','turkish');

$DBHost = "localhost"; 
$DBuser ="root"; 
$Dbpass =""; 
$Dbname="hobbyhome";


try{
$db=new PDO("mysql:host=$DBHost;dbname=$Dbname",$DBuser,$Dbpass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(Exception $e){
echo $e->getMessage();
}

$db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");
define("_URL","http://http://localhost:3000/admin/");


?>