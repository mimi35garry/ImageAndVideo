<?php
session_start();
?>
<!DOCTYPE html">
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
<!--Todo
voir pour activer led ir
voir pour page shutdown, reste bloquer dessus
voir pour mettre une led pour lactiviter de la camera
voir pour indiquer la fin de la conversion-->
<?php
//espace libre
    $bytes = disk_free_space("."); 
    $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
    $base = 1024;
    $class = min((int)log($bytes , $base) , count($si_prefix) - 1);
    echo sprintf('Espace libre : '.'%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class] . '<br />';

//https://frillip.com/using-your-raspberry-pi-3-as-a-wifi-access-point-with-hostapd/ -->tuto pour creer un point dacces
//http://www.handsdown.be/raspicam/index.html --> parametre pour raspivid et raspicam
echo "<table>";
  echo "<tr>";
    echo "<td><a href='previsualisation.php'><img src='appareil-photo.png' width=60 height=60 id='photo' alt='Cadrage'/></a></td>";
    echo "<td>Pour effectuer le cadrage</td>";
  echo "</tr>";
  echo "<tr>";
    echo "<td><a href='liste video.php'><img src='play.png' width=60 height=60 id='liste' alt='Liste des video'/></a></td>";
    echo "<td>Liste des videos</td>";
  echo  "</tr>";
  echo "<tr>";
    echo  "<td><a href='enregistrer.php'><img src='video.png' width=60 height=60 id='video' alt='Enregistrer une video'/></a></td>";
    echo "<td>Enregistrement</td>";
  echo  "</tr>";
echo "</table>";
echo "Merci d'éteindre 'proprement' le raspberry pi <br>avec le bouton ci-dessous<br>";
echo '<a href="eteindre.php"><img src="eteindre.png" width=60 height=60 id="eteindre" alt="éteindre"/></a>';
?>

<script type="text/javascript">
function getXMLHttpRequest() {
	var xhr = null;
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				jsxhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				jsxhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			jsxhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}	
	return jsxhr;
}
function halt(){
	var jsxhr = getXMLHttpRequest();//on recupere XHR
	jsxhr.onreadystatechange = function() {//quand on recois une reponse
		if (jsxhr.readyState == 4 && (jsxhr.status == 200 || jsxhr.status == 0)) {
			alert(jsxhr.responseText);//on l affiche
   	    	alert("Patienter avant de le débrancher");
		}
	}
	jsxhr.open("POST", "eteindre.php", true);
	jsxhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	jsxhr.send();
}

var jseteindreclick = document.getElementById('eteindre');
jseteindreclick.addEventListener('click', function(e) {//on creer l evenement du click
    var confirmation = confirm("Voulez-vous éteindre le raspberry pi ?\nSi oui attendre 30 secondes avant de le débrancher après avoir cliqué sur OK")
    if(confirmation){ 
      halt();
      e.preventDefault();//bloque l'action du lien(appeler la page eteindre.php)
//      window.location = index.php; 
    }
     else{
      e.preventDefault();//bloque l'action du lien(appeler la page eteindre.php)
     }
});

  </script>
</html>