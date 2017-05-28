<?php
session_start();
//code pour lancer une photo
//http://www.handsdown.be/raspicam/index.html : pour connaitre les options
// -t  Time before takes picture and shuts down(msec)
// -hf Set horizontal flip
// -vf Set vertical flip
// -o  Output filename
// -n  Do not display a preview window
// -e  Encoding to use for output filename

$_SESSION['hf'] = $_POST["jshf"];
$_SESSION['vf'] = $_POST["jsvf"];
$phphf = "";
$phpvf = "";
if (isset($_POST["jshf"]) && !empty($_POST["jshf"])) {
    if($_POST["jshf"]=="true")
		{$phphf = "-hf ";}
}
if (isset($_POST["jsvf"]) && !empty($_POST["jsvf"])) {
    if($_POST["jsvf"]=="true")
		{$phpvf = "-vf ";}
}
$cmd = 'sudo raspistill -q 10 -t 10 '.$phphf.$phpvf.'-o /var/www/html/ralentiVideo/image/image -n -e jpg';
shell_exec($cmd);
?>