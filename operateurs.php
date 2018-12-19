<?php include 'before.html';
include 'connection.php';

$ids = $redis->smembers("id_operateur");
?>
<table class="table table-striped">
  <thead>
    <tr><th>id</th><th>Nom</th><th>Prénom</th><th>Email</th><th>age</th></tr>
  </thead>
  <tbody>
  <?php foreach ($ids as $key => $value) {
    echo('<tr>');
    echo('<td><a href="operateur.php?id_operateur='.$value.'">'.$value.'</a></td>');
    $appel=$redis->hgetall("operateur:".$value);
    foreach ($appel as $key2 => $value2) {
      echo('<td>'.$value2.'</td>');
    }
    echo('</tr>');
  } ?>
 </tbody>
 </table>
