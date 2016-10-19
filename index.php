<?php

  session_start();

  header("Content-Type: text/html; charset=ISO-8859-1");

  $pagepathprefix= "/";
  setlocale(LC_ALL,"nl_NL");

  if( isset($_GET['kill']) ){
    session_destroy();
    header('Location: /index.php');
    exit;
  }

  if( isset( $_GET['changeProject'] ) ){
    unset( $_SESSION['database'] );
    header('Location: /index.php');
    exit;
  }

  //	Include alle relevante bestanden
  require_once("convert.php");
  include_once("custom.php");
  require_once("classes/conf.php");
  require_once("classes/db.class.php");
  require_once('classes/lijst.class.php');

  $db = new Database(DBNAME,DBUSER,DBPASS);

  $lijst = new Lijst();

  global $properties, $db;

?>

<!DOCTYPE html>
<html>

  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>

      Lionhead CMS - Lijsten

    </title>

    <meta name="viewport" content="width=device-width">

  <!-- 	Stylesheets		 -->

    <!-- Custom -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/selectize.css" />

    <!-- Third party -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,300,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/thirdparty/font-awesome-4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- 	Javascript		 -->

    <!-- Third party -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Custom -->
    <script type="text/javascript" src="/js/scripts.js"></script>
    <script type="text/javascript" src="/js/selectize.js"></script>

  </head>

  <body>

    <?php

      if( isset( $_SESSION['loggedin'] ) && !empty( $_SESSION['userData'] ) ){

        include('pages/dashboard.php');

      }else{

        include('pages/login.php');

      }

    ?>

  </body>

</html>
