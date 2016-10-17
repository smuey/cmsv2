<?php

//  require_once('../classes/conf.php');
  define("DBNAME", "cms_".$_POST['project']);
  define("DBUSER", "preview");
  define("DBPASS","");
  define("IMAGEROOT","/home/data/websites/lionCMS/sites/");
  require_once('../classes/db.class.php');

  global $db;

  if( isset( $_POST ) && !empty( $_POST ) ){

    $fileData = explode("/",urldecode($_POST['link']));

    $file = $fileData[count($fileData)-1];

    if( unlink(IMAGEROOT.$_POST['project']."/images/".$file) == true ){
      $db->queryupdate("UPDATE ".$_POST['table']." SET ".$_POST['field']."=NULL WHERE ".$_POST['field']."='".$file."'");
      echo "OK";
    }else{
      echo "fout";
    }

  }

?>
