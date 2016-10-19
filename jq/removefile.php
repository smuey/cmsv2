<?php

  define("IMAGEROOT","/home/data/websites/lionCMS/sites/");
  require_once('../classes/db.class.php');

  $db = new Database("cms_".$_POST['project'], "preview", "");

  global $db;

  if( isset( $_POST ) && !empty( $_POST ) ){

    $fileData = explode("/",urldecode($_POST['link']));

    $file = $fileData[count($fileData)-1];

    if( unlink(IMAGEROOT.$_POST['project']."/downloads/".$file) == true ){
      $db->queryupdate("UPDATE ".$_POST['table']." SET ".$_POST['field']."=NULL WHERE ".$_POST['field']."='".$file."'");
      echo "OK";
    }else{
      echo "fout";
    }

  }

?>
