<?php include 'before.html';
include 'connection.php';

$ids = $redis->smembers("en_attente");
?>
<br><a href="newAppel.php"><button type="button" class="btn btn-secondary" >Nouvel Appel</button></a><br><br>
<h1>Appels en attente :</h1>
<table class="table table-striped">
  <thead>
    <tr><th>id</th><th>Numéro</th><th>Description</th><th>Assigner</th></tr>
  </thead>
  <tbody>
  <?php foreach ($ids as $key => $value) {
    echo('<tr>');
    echo('<td>'.$value.'</td>');
    $appel=$redis->hgetall("appel:".$value);
    foreach ($appel as $key2 => $value2) {
      echo('<td>'.$value2.'</td>');
    }
    echo('<td><a href="affectation.php?id_appel='.$value.'"<i class="fas fa-arrow-right"></i></a></td>');
    echo('</tr>');
  } ?>
 </tbody>
 </table>


<?php
 $ids = $redis->smembers("en_cours");
 ?>
 <h1>Appels en cours :</h1>
 <table class="table table-striped">
   <thead>
     <tr><th>id</th><th>Numéro</th><th>Description</th><th>Heure</th><th>Assignation</th><th>Finir</th></tr>
   </thead>
   <tbody>
   <?php foreach ($ids as $key => $value) {
     echo('<tr>');
     echo('<td>'.$value.'</td>');
     $appel=$redis->hgetall("appel:".$value);
     foreach ($appel as $key2 => $value2) {
       if($key2=="affectation"){

         $prenom = $redis->hget("operateur:".$value2,"firstname");
         $nom = $redis->hget("operateur:".$value2,"lastname");
         echo('<td><a href="operateur.php?id_operateur='.$value2.'">'.$prenom.' '.$nom.'</a></td>');
       }
       else{echo('<td>'.$value2.'</td>');}
     }

     echo('<td><a href="endAppel.php?id_appel='.$value.'"><i class="fas fa-blender-phone"></i></a></td>');
     echo('</tr>');
   } ?>
  </tbody>
  </table>


  <?php
  $ids = $redis->smembers("fini");
  ?>
  <h1>Appels finis :</h1>
  <table class="table table-striped">
    <thead>
      <tr><th>id</th><th>Numéro</th><th>Description</th><th>Heure</th><th>Assignation</th><th>Durée</th></tr>
    </thead>
    <tbody>
    <?php foreach ($ids as $key => $value) {
      echo('<tr>');
      echo('<td>'.$value.'</td>');
      $appel=$redis->hgetall("appel:".$value);

      foreach ($appel as $key2 => $value2) {

        if($key2=="affectation"){

          $prenom = $redis->hget("operateur:".$value2,"firstname");
          $nom = $redis->hget("operateur:".$value2,"lastname");
        echo('<td><a href="operateur.php?id_operateur='.$value2.'">'.$prenom.' '.$nom.'</a></td>');
        }
        else{echo('<td>'.$value2.'</td>');}
      }

      echo('</tr>');
    } ?>
   </tbody>
   </table>
