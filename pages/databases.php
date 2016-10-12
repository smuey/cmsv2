<?php

  global $db;

  $databases = $db->queryarray("SELECT SCHEMA_NAME AS `database` FROM INFORMATION_SCHEMA.SCHEMATA");

?>

<div class="alert alert-success" role="alert">
  <b>LET OP!</b> Kies eerst een database
</div>

<form method="post" class="col-sm-4">

  <select id="dbchoice" name="database">
    <option value="">- Kies een database -</option>

    <?php

      foreach($databases as $data){
        echo "<option value=\"".$data['database']."\">".$data['database']."</option>";
      }

    ?>

  </select>
  <br />
  <button class="btn btn-primary" type="submit">Kies</button>

</form>
