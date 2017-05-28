<!--Page permettant de lister les video h264 a convertir et les video mp4-->
<!DOCTYPE html">
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Liste des videos</title>
  </head>
<body>
<form action="convertir.php" method="POST" >
<table>
<tr>
<td><a href='index.php'><img src='accueil.png' width=60 height=60 id='photo' alt='Accueil'/></a></td>
<td><a href='index.php'>Accueil</a></td>
</tr>
</table>
Attendre la fin de l'enregistrement avant de faire la conversion</br>
Le fichier .h264 est supprimé à la fin de la conversion</br>
jour-mois-année_heure-minute-seconde</br>
<?php
$debuth264 = "/var/www/html/ralentiVideo/h264/";
$debutmp4 = " /var/www/html/ralentiVideo/video_mp4/";
//liste video h264 a convertir
$nb_fichier = 0;
echo '<ul>';
if($dossier = opendir('./h264/'))
{
	while(false !== ($fichier = readdir($dossier)))
	{
		if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
		{
			$nb_fichier++; // On incrémente le compteur de 1
			echo '<li>'.$fichier.'  <input type="submit" value="Convertir" name="'.$fichier.'"></li>';
		} // On ferme le if (qui permet de ne pas afficher index.php, etc.)
	} // On termine la boucle
	echo '</ul><br />';
	if($nb_fichier == 0)
		{echo "Il n'y a pas de fichiers à afficher";}
	closedir($dossier);

} 
else echo 'Le dossier n\' a pas pu être ouvert';
//liste des video mp4
$nb_fichier = 0;
echo '<ul>';
if($dossier = opendir('./video_mp4'))
{
	while(false !== ($fichier = readdir($dossier)))
	{
		if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
		{
			$nb_fichier++; // On incrémente le compteur de 1
			echo '<li><a href="./video_mp4/' . $fichier . '">' . $fichier . '</a></li>';
		} // On ferme le if (qui permet de ne pas afficher index.php, etc.)
	} // On termine la boucle
	echo '</ul><br />';
	closedir($dossier);
} 
else echo 'Le dossier n\' a pas pu être ouvert';
?>
</form>
</body>
</html>