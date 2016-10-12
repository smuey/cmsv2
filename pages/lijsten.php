<?php

  global $db;

  //  Maak een nieuw Lijst-object aan
  require_once('classes/lijst.class.php');
  $lijst = new Lijst();


  switch( $_GET['page'] ){

    case "showcontents":
      //  Inhoud van een lijst weergeven
      include('incl/showlistcontents.php');
      break;

    case "edittable":
      //  Geef een overzicht van alle lijsten binnen de database weer
      include('incl/edittable.php');
      break;

    case "additem":
      //  Voeg een nieuwe rij aan de tabel toe
      include('incl/additem.php');
      break;

    default:
      //  Toon een overzicht van alle tabellen in de gekozen database
      include('incl/showlistoverview.php');
      break;

  }

?>
