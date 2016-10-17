<?php

  $lijsten = $lijst->returnLijsten($_SESSION['database']);

?>

<h2 class="sub-header">Beschikbare lijsten</h2>
<div class="col-sm-10 table-responsive">
<table class="table table-striped">
<thead>
  <tr>
    <th>Naam</th>
    <th class="text-center">Bekijk items</th>
    <th class="text-center">Nieuwe rij toevoegen</th>
    <th class="text-center">Aanpassen</th>
    <th class="text-center">Verwijderen</th>
  </tr>
</thead>
<tbody>

  <?php

    $x = 0;

    foreach( $lijsten as $lijst ){

      if( !in_array( $lijst['table_name'], $doNotDisplay) ){

        echo "<tr>
                <td>".$lijst['table_name']."</td>
                <td class=\"text-center\">
                  <a href=\"/showcontents/".$lijst['table_name'].".html\">
                    <span class=\"glyphicon glyphicon-eye-open\" aria-hidden=\"true\"></span>
                  </a>
                </td>
                <td class=\"text-center\">
                  <a href=\"/additem/".$lijst['table_name'].".html\">
                    <span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>
                  </a>
                </td>
                <td class=\"text-center\">
                  <a href=\"/edittable/".$lijst['table_name'].".html\">
                    <span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>
                  </a>
                </td>
                <td class=\"text-center\">
                  <a href=\"#\">
                    <span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span>
                  </a>
                </td>
              </tr>";
        $x++;

      }

    }

  ?>

</tbody>
</table>

<div class="alert alert-info" role="alert">
Er zijn <b><?php echo $x; ?></b> lijsten beschikbaar.
</div>

</div>
