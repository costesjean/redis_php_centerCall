<?php include 'before.html';
include 'connection.php';

// ########## Suppression des hashs et des listes existants ##########
$nb_previous_op = $redis->scard("id_operateur");
for ($i=1;$i<=$nb_previous_op;$i++){ // Destruction des hashs opérateurs
  $redis->delete('operateur:'.$i);
  $redis->delete('affectation:'.$i);
}

$nb_previous_appel = $redis->scard("id_appel");
for ($i=1;$i<=$nb_previous_appel;$i++){ // Destruction des hashs appels
  $redis->delete('appel:'.$i);
}

//suppression des listes
$redis->delete("id_operateur");
$redis->delete("id_appel");
$redis->delete("en_attente");
$redis->delete("en_cours");
$redis->delete("fini");

// ########## Initialisation des opérateurs ##########
$redis->sadd("id_operateur","1","2","3","4","5"); //SET contenant les ids des opérateurs

$redis->hmset("operateur:1",array("firstname"=>"Didier","lastname"=>"Super","email"=>"ouioui@nonon.fr","age"=>"32"));// HASH représentant un opérateur sous la forme operateur:id_operateur
$redis->hmset("operateur:2",array("firstname"=>"Youssef","lastname"=>"Ouabel","email"=>"nonon@nonon.fr","age"=>"19"));
$redis->hmset("operateur:3",array("firstname"=>"Sandrine","lastname"=>"Dupuis","email"=>"attention@email.fr","age"=>"49"));
$redis->hmset("operateur:4",array("firstname"=>"Chen","lastname"=>"Li","email"=>"20@sur20.svp","age"=>"27"));
$redis->hmset("operateur:5",array("firstname"=>"Esteban","lastname"=>"Paela","email"=>"bonjour@cava.ouimerci","age"=>"99"));



// ########## Initialisation des appels ########## (comprenant 1 exemple pour chaque statut)
$redis->sadd("id_appel","1","2","3"); // SET contenant les ids de tous les appels ayant existés

$redis->hmset("appel:1",array("numero"=>"0625458715","description"=>"description test"));
$redis->hmset("appel:2",array("numero"=>"0625458715","description"=>"description test","heure"=>time(),"affectation"=>"1"));
$redis->hmset("appel:3",array("numero"=>"0625458715","description"=>"description test","heure"=>time()-150,"affectation"=>"3","duree"=>150));

$redis->sadd("en_attente","1"); // SET des appels en attente
$redis->sadd("en_cours","2"); // SET des appels en cours
$redis->sadd("fini","3"); // SET des appels terminés

$redis->sadd("affectation:3","3");
$redis->sadd("affectation:1","2");

header('Location: appels.php');
exit();

 ?>
