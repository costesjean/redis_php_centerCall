<?php include 'before.html';
include 'connection.php';

$id_appel = $_GET["id_appel"];

// On déplace l'id de l'appel de la liste des appels en cours vers celle des appels finis
$redis->smove("en_cours","fini",$id_appel);

// calcul de la durée de l'appel et ajout dans le hash
$debut = (int)$redis->hget('appel:'.$id_appel,"heure");
$temps = time() - $debut;
$redis->hset('appel:'.$id_appel,"duree",$temps);


header('Location: appels.php');
exit();

 ?>
