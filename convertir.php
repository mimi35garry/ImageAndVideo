<?php
//<!--Page permettant de convertir en video h264 en mp4 puis de supprimer le fichier h264(format d enregistrement de la camera du raspberry pi -->
$debuth264 = "/var/www/html/ralentiVideo/h264/";
$debutmp4 = " /var/www/html/ralentiVideo/video_mp4/";
foreach ($_POST as $key => $value) {//on recupere le nom du fichier
	$finmp4 = mb_strimwidth($key, 0, 23, ".mp4");//on remplace l extension
	$finh264 = mb_substr($key, 0, 19, 'utf-8').'.h264';
	print_r($finmp4);
	$fichier = "/var/www/html/ralentiVideo/video_mp4/".$finmp4;
	 if($fichier!="." AND $fichier!=".." AND !is_dir($fichier))
        {
        $cmd = 'MP4Box -fps 10 -add '.$debuth264.$finh264.$debutmp4.$finmp4;//commande pour la conversion
        shell_exec($cmd);
        sleep(10);//on bloque le temps de la conversion
        unlink("/var/www/html/ralentiVideo/h264/".$finh264);//on supprime le fichier h264
        /* Redirection vers une page différente du même dossier */
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';
		header("Location: http://$host$uri/$extra");
		exit;
        }
	}
?>