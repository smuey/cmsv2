<?php

  //  Haal de inhoud op
  $lijstInhoud = $lijst->returnListContents( $_GET['tableName'], $_GET['sortby'], $_GET['sorttype'] );

  echo "<h2>".$_GET['tableName']."</h2>";

  echo "<div class=\"col-md-12\">
          <a href=\"/additem/".$_GET['tableName'].".html\" class=\"btn btn-primary\" role=\"button\">Nieuw item toevoegen</a>
        </div>
        <div class=\"col-md-12\">&nbsp;</div>";


  echo "<div class=\"col-md-10 table-responsive\">
          <table class=\"table table-striped sort display\">
            <thead>
              <tr>";

  // Loop door de lijst heen
  foreach( $lijstInhoud[0] as $key=>$value ){

    //  Bepaal het juiste Sorteer-icoon bovenaan de lijst
    if( $_GET['sortby'] == $key && $_GET['sorttype'] == 'asc' ){
      $sortClass = "fa-sort-asc";
    }elseif( $_GET['sortby'] == $key && $_GET['sorttype'] == 'desc' ){
      $sortClass = "fa-sort-desc";
    }elseif(empty($_GET['sortby']) && empty($_GET['sorttype']) && $key == 'id'){
      $sortClass = "fa-sort-asc";
    }else{
      $sortClass = "fa-sort";
    }

    //  Bepaal de juiste soort link om te sorteren
    if( $_GET['sortby'] == $key && $_GET['sorttype'] == 'asc' ){
      $sortLink = "?sortby=".$key."&sorttype=desc";
    }elseif( $_GET['sortby'] == $key && $_GET['sorttype'] == 'desc' ){
      $sortLink = "?sortby=".$key."&sorttype=asc";
    }else{
      $sortLink = "?sortby=".$key."&sorttype=asc";
    }

    echo "<th class=\"text-center\">
            <a href=\"".$sortLink."\">
              ".$key." <i class=\"fa ".$sortClass."\"></i>
            </a>
          </th>";

  }

  echo "      </tr>
            </thead>
            <tbody class=\"ui-sortable\">
              <tr id=\"trash\"><td colspan=\"".count($lijstInhoud[0])."\" style=\"text-center\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span></td></tr>";

  $x = 0;   //  Teller om bij te houden hoeveel items er zijn verwerkt

  //  Geef voor iedere rij de inhoud van alle kolommen weer
  foreach( $lijstInhoud as $item ){

    echo "<tr class=\"ui-sortable-handle editlink\" data-id=\"".$item['id']."\" data-table=\"".$_GET['tableName']."\" data-db=\"".$_SESSION['database']."\" data-href=\"/edititem/".$_GET['tableName']."/".$item['id'].".html\">";

    foreach( $item as $key=>$value ){
      echo "<td class=\"text-center\">".(strlen($value) > 125?substr(strip_tags($value), 0, 125.)."...":strip_tags($value))."</td>";
    }

    $x++;

  }

  echo "   </tr>
          </tbody>
        </table>";

  //  Geef tot slot een melding weer van het aantal gevonden items
  echo "<div class=\"alert alert-info\" role=\"alert\">
          Er zijn <b>".$x."</b> items gevonden.
        </div>";

?>
