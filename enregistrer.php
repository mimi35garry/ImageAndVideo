<?php
session_start();
?>
<!--Page pour parametrer l enregistrement
TODO:
-->
<!DOCTYPE html">
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Enregistrer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
  </head>
<form action="video.php" method="POST" >
<table>
<tr>
<td><a href='index.php'><img src='accueil.png' width=60 height=60 id='photo' alt='Accueil'/></a></td>
<td><a href='index.php'>Accueil</a></td>
</tr>
</table>
<img src="./image/image" width=300 height=300 id="myimg">
<?php
if (isset($_SESSION['hf']) && !empty($_SESSION['hf'])) {
    if($_SESSION['hf']=="true")
		{echo "</br>Retournement horizontal";}
}
if (isset($_SESSION['vf']) && !empty($_SESSION['vf'])) {
    if($_SESSION['vf']=="true")
		{echo "</br>Retournement vertical";}
}
?>
<p>Nombre d'images par seconde</br>Minimum 10, Maximum 90</br>
<input type="number" step="10" value="90" min="10" max="90" name="frameRate" id="idframerate"/>
</p>
<p>Nombre de millisecondes pour la durée de l'enregistrement</br>Minimum 10000, Maximun 120000</br>
<input type="number" step="10000" value="10000" min="10000" max="120000" name="temp" id="idtemp"/>
</p>
<p><input type="button" value="Démarrer" name="Enregistrer" id="idenregistrer"></p>
<script type="text/javascript">
function dateFr()
{
	// on recupere la date
    var date = new Date();
    // on construit le message
    var j = date.getDay();   //  jour
    if (j<10) {j = "0" + j}
    var m = date.getMonth();   // mois, 0 pour janvier
 	m ++;//+1 pour etre comprehensible
 	if (m<10) {m = "0" + m}
    var a = date.getFullYear();
 	var madate = j;
 	madate += "-";
 	madate += m;
 	madate += "-";
 	madate += a;
    return madate;
}
function heure()
{
	var ladate=new Date()
	var h=ladate.getHours();
	if (h<10) {h = "0" + h}
	var m=ladate.getMinutes();
	if (m<10) {m = "0" + m}
	var s=ladate.getSeconds();
	if (s<10) {s = "0" + s}
	var monheure = h;
	monheure += "-";
	monheure += m;
	monheure += "-";
	monheure += s;
	return monheure;
}
//Fonction permettant l'envoie de requette sans recharger la page
function getXMLHttpRequest() {
	var jsxhr = null;
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
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...\nChanger de navigateur (Chrome par exemple");
		return null;		
	}
	return jsxhr;
}
//Fonction envoyant les parametres d'enregistrement
function conf(frame, temp){
	var jsxhr = getXMLHttpRequest();//on recupere XHR
	jsxhr.onreadystatechange = function() {//quand on recois une reponse
		if (jsxhr.readyState == 4 && (jsxhr.status == 200 || jsxhr.status == 0)) {
			alert(jsxhr.responseText);//on l affiche
		}
	}
	jsxhr.open("POST", "video.php", true);
	jsxhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	jsxhr.send("varFrameRate="+frame+"&varTemp="+temp+"&dateHeure="+dateFr()+"_"+heure());
}
var jsenregistrerclick = document.getElementById('idenregistrer');
jsenregistrerclick.addEventListener('click', function(e) {//on creer l evenement du click
	var jsframerate = document.getElementById('idframerate');//on recupere les valeurs a envoyer
    var jstemp = document.getElementById('idtemp');
    var confirmation = confirm("Enregistrer une video de "+jstemp.value+" millisecondes\nAvec "+jsframerate.value+" images par seconde ?")
    if(confirmation){
        conf(jsframerate.value, jstemp.value);//si clique sur OK on transfert les parametres
    }
   
});
</script>
</form>
</html>