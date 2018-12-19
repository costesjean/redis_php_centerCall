<?php include 'connection.php';

$numero=$_POST["numero"];
$description=$_POST["description"];
$id = $redis->scard("id_appel") + 1;

$redis->hmset('appel:'.$id, array("numero" => $numero,"description" => $description));
$redis->sadd("id_appel",$id);
$redis->sadd("en_attente",$id);
header('Location: appels.php');
exit();

?>
