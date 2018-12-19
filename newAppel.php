<?php include 'before.html';
 ?>
 <h1>Nouvel Appel</h1>

 <form method="post" action="addAppel.php">
   <div class="form-group">
     <label for="text">Numéro:</label>
     <input type="text" required="required" class="form-control" name="numero">
   </div>
   <div class="form-group">
     <label for="text">Description:</label>
     <input type="text" required="required" class="form-control" name="description">
   </div>
   <button type="submit" required="required" class="btn btn-default">Submit</button>
 </form>
