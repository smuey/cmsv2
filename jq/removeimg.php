<?php

  require_once('../classes/conf.php');
  require_once('../classes/db.class.php');

  global $db;

  if( isset( $_POST ) && !empty( $_POST ) ){

    $fileData = explode("/",urldecode($_POST['link']));

    $file = $fileData[count($fileData)-1];

    echo $file;

  }

?>
