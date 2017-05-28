<?php
session_start();

$phphf = "";
$phpvf = "";
if (isset($_SESSION['hf']) && !empty($_SESSION['hf'])) {
    if($_SESSION['hf']=="true")
		{$phphf = "-hf ";}
}
if (isset($_SESSION['vf']) && !empty($_SESSION['vf'])) {
    if($_SESSION['vf']=="true")
		{$phpvf = "-vf ";}
}

//Page permettant d enregistrer une video avec raspivid, parametres venant d enregistrer.php
$phpdate = date("d-m-y");//01-01-2017
$phpheure = date("h-i-s");//00-00-00
$cmd = 'sudo raspivid -w 640 -h 480 '.$phphf.$phpvf.'-fps '.$_POST["varFrameRate"].' -t '.$_POST["varTemp"].' -o ./h264/'.$_POST["dateHeure"].'.h264 >/dev/null &';//> /dev/null : dirige les messages vers dev/null, & execute en arriere plan
shell_exec($cmd);
echo "Enregistrement démarré";//renvoi pour XHR de la page enregistrer.php
?>