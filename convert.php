<?php

  $e=explode("/", $_GET['page']);

  $_GET['page'] = $e[0];

  if( $_GET['page'] == 'showcontents' && count($e) > 1 ){
    $_GET['tableName'] = $e[1];
  }

  if( $_GET['page'] == 'edittable' && count($e) > 1 ){
    $_GET['tableName'] = $e[1];
  }

  if( $_GET['page'] == 'additem' && count($e) > 1 ){
    $_GET['tableName'] = $e[1];
  }

?>
