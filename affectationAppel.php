<?php include 'connection.php';

$id_appel=$_GET["id_appel"];
$id_operateur=$_GET["id_operateur"];

// On ajoute l'appel à la liste des appels de l'opérateur
$redis->sadd('affectation:'.$id_operateur,$id_appel);

// Ajout de l'heure et de l'opérateur au hash de l'appel
$redis->hset('appel:'.$id_appel,"heure",time());
$redis->hset('appel:'.$id_appel,"affectation",$id_operateur);


// On déplace l'id de l'appel de la liste des appels en attente vers celle des appels enn cours
$redis->smove("en_attente","en_cours",$id_appel);

header('Location: appels.php');
exit();

 ?>
