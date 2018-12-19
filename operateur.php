<?php include 'before.html';
include 'connection.php';

$id_operateur = $_GET["id_operateur"];


$id_appels = $redis->smembers('affectation:'.$id_operateur);
?>
<h1><?php echo($redis->hget('operateur:'.$id_operateur,"firstname").' '.$redis->hget('operateur:'.$id_operateur,"lastname")) ?></h1>
<table class="table table-striped">
  <thead>
    <tr><th>id</th><th>Numéro</th><th>Description</th><th>Heure</th><th>Assignation</th><th>Durée</th></tr>
  </thead>
  <tbody>
  <?php foreach ($id_appels as $key => $value) {
    echo('<tr>');
    echo('<td>'.$value.'</td>');
    $appel=$redis->hgetall("appel:".$value);

    foreach ($appel as $key2 => $value2) {

      if($key2=="affectation"){

        $prenom = $redis->hget("operateur:".$value2,"firstname");
        $nom = $redis->hget("operateur:".$value2,"lastname");
        echo('<td>'.$prenom.' '.$nom.'</td>');
      }
      else{echo('<td>'.$value2.'</td>');}
    }
    if($redis->hget('appel:'.$value,"duree")==""){echo('<td>en cours</td>');}

    echo('</tr>');
  } ?>
 </tbody>
 </table>
