<?php
function yaz($echo){
    echo $echo;
}

function txtyaz($belge,$deger,$aktar){
	$file = fopen("$belge", 'a');
	fwrite($file, $deger.  "\n\n");
fclose($file);
header("Refresh:0; url=$aktar");
}


function dbekle($config,$tablo,$tablodeger,$deger,$aktar){
	include("$config");
$tabloicerik = explode("-", $tablodeger);
$tabloyazi = implode(",", $tabloicerik);

$icerik = explode("-", $deger);
$yazi = "'".implode("','", $icerik)."'";

$ekle = mysqli_query($con,"INSERT INTO $tablo($tabloyazi) 
VALUES ($yazi)");
header("Refresh:0; url=$aktar");
}

function admingiris($config,$tablo,$tablouser,$tablopass,$user,$pass,$dogru,$yanlis){
include("$config");
ob_start();
session_start();

$sql_check = mysqli_query($con,"select * from $tablo where $tablouser='".$user."' and $tablopass='".$pass."' ") or die(mysql_error());

if(mysqli_num_rows($sql_check))  {
    $_SESSION["login"] = "true";
    $_SESSION["username"] = $user;
    $_SESSION["password"] = $pass;
    header("Location: $dogru");
}else{
header("Location: $yanlis");
}
ob_end_flush();

}


function yetkikontrol($config,$hata){
include("$config");
ob_start();
session_start();
 
if(!isset($_SESSION["login"])){
    header("Location:$hata");
}
}

function cikis($git){
session_start();
ob_start();
session_destroy();
header("location:$git");
ob_end_flush();	
}


?>