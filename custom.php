<?php

  session_start();

  //  Lijst met standaard tabellen die door het CMS worden gegenereerd -
  //  Deze meoten buiten Lijsten blijven
  $doNotDisplay = array("tblbanner",
                        "tblblogreply",
                        "tblelements",
                        "tblemailadressen",
                        "tblguestbook",
                        "tbllanguages",
                        "tblmenus",
                        "tblpagebanner",
                        "tblpageelements",
                        "tblpageproperty",
                        "tblpages",
                        "tblpagesiteuser",
                        "tblprojectdata",
                        "tblproperty",
                        "tblresource",
                        "tblresourcetype",
                        "tblsiteusers",
                        "tblstat_daily",
                        "tblstat_daily_totals",
                        "tblstat_pages",
                        "tblstat_referer",
                        "tblstat_referervisitor",
                        "tblstat_visitor",
                        "tblwinkelbestelling",
                        "tblwinkelfactuur");

  //  Als er een database is gekozen en het formulier is verzonden, stel dan de naam van de DB in in de sessie
  if( isset( $_POST['database'] ) && !empty($_POST['database']) ){

    $_SESSION['database'] = $_POST['database'];

    //  Stuur een gebruiker tot slot door naar de index
    header("Location: /index.php");
    exit;

  }

?>
