<?php

  $tableData = $lijst->returnListMakeUp($_SESSION['database'], $_GET['tableName']);

  echo '<h2 class="sub-header">Opmaak van '.$_GET['tableName'].' wijzigen</h2>

          <div class="col-md-10 btn-group" role="group">
            <button type="button" class="btn btn-default">Nieuw veld toevoegen</button>
            <button type="button" class="btn btn-default">Tabel verwijderen</button>
          </div>

          <div class="col-md-10 table-responsive">
          <table class="table table-striped">
          <thead>
            <tr>
              <th class="text-center">Naam</th>
              <th class="text-center">Type</th>
              <th class="text-center">Standaardwaarde</th>
              <th class="text-center">Primary key</th>
              <th class="text-center">Automatisch oplopen</th>
              <th class="text-center">Bewerken</th>
            </tr>
          </thead>
          <tbody>';

  $x= 0;

  foreach( $tableData as $row ){

    echo "<tr>
            <td class=\"text-center\">".$row['COLUMN_NAME']."</td>
            <td class=\"text-center\">".$row['COLUMN_TYPE']."</td>
            <td class=\"text-center\">".$row['COLUMN_DEFAULT']."</td>
            <td class=\"text-center\">".($row['COLUMN_KEY']=='PRI'?"ja":"nee")."</td>
            <td class=\"text-center\">".($row['EXTRA'] == 'auto_increment'?"ja":"nee")."</td>
            <td class=\"text-center\">
              <a href=\"#\">
                <span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>
              </a>
            </td>
          </tr>";
    $x++;


  }

  echo '  </tbody>
        </table>

        <div class="alert alert-info" role="alert">
        Er zijn <b>'.$x.'</b> velden in deze tabel gevonden.
        </div>

        </div>';

?>
