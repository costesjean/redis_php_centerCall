<?php include 'before.html';
include 'connection.php';

$ids = $redis->smembers("id_operateur");
$id_appel=$_GET["id_appel"];
?>
<table class="table table-striped">
  <thead>
    <tr><th></th><th>Nom</th><th>Prénom</th><th>Email</th><th>age</th></tr>
  </thead>
  <tbody>
  <?php foreach ($ids as $key => $value) {
    echo('<tr>');
    echo('<td><a href="affectationAppel.php?id_appel='.$id_appel.'&id_operateur='.$value.'"><i>cliquer pour affecter</i></a></td>');
    $appel=$redis->hgetall("operateur:".$value);
    foreach ($appel as $key2 => $value2) {
      echo('<td>'.$value2.'</td>');
    }
    echo('</tr>');
  } ?>
 </tbody>
 </table>
