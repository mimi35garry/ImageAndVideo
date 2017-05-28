<?php
session_start();
?>
<!-- Page permetant la previsualisation, pour le cardrage-->
<!DOCTYPE html">
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Prévisualisation</title>
  </head>
<body>
<form action="photo.php" method="POST">
<table>
<tr>
<td><a href='index.php'><img src='accueil.png' width=60 height=60 id='photo' alt='Accueil'/></a></td>
<td><a href='index.php'>Accueil</a></td>
</tr>
</table>
<input type="checkbox" name="hflip" value="hf" id = "idhf"> Retournement horizontale
<input type="checkbox" name="vflip" value="vf" id = "idvf"> Retournement verticale
<img src="./image/image" width=900 height=900 id="myimg">


<script>
function getXMLHttpRequest() {
	var xhr = null;
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}	
	return xhr;
}

var xhr = getXMLHttpRequest();

window.onload = function() {
    var image = document.getElementById("myimg");

    function updateImage() {
        image.src = image.src.split("?")[0] + "?" + new Date().getTime();//lajout du ? et de la date permet de forcer le navigateur a rafraichir(cache)
		var jshf = document.getElementById('idhf');
		var jsvf = document.getElementById('idvf');
		xhr.open("POST", "photo.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send("jshf="+jshf.checked+"&jsvf="+jsvf.checked);
    }
    setInterval(updateImage, 1000);//une nouvelle image toutes les 3 secondes
	}
</script>
</form>
</body>
</html>