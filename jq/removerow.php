<?php

//  require_once('../classes/conf.php');
  define("DBNAME", $_POST['project']);
  define("DBUSER", "preview");
  define("DBPASS","");
  define("IMAGEROOT","/home/data/websites/lionCMS/sites/");
  require_once('../classes/db.class.php');

  global $db;

  if( isset( $_POST ) && !empty( $_POST ) ){

    $row = $db->queryrow("SELECT * FROM ".$_POST['table']." WHERE id=?", array($_POST['id']));

    foreach( $row as $key=>$value ){
      
      if( is_file( IMAGEROOT.str_replace("cms_","",$_POST['project'])."/images/".$value ) ){
        unlink(IMAGEROOT.str_replace("cms_","",$_POST['project'])."/images/".$value);
      }elseif( is_file( IMAGEROOT.str_replace("cms_","",$_POST['project'])."/downloads/".$value )){
        unlink(IMAGEROOT.str_replace("cms_","",$_POST['project'])."/downloads/".$value);
      }

    }

    $db->queryupdate( "DELETE FROM ".$_POST['table']." WHERE id=?", array($_POST['id']) );

    echo "OK";

  }

?>
