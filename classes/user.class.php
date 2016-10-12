<?php

  class User{


    /**************************************************************

        __construct() - Constructor

    **************************************************************/
    function __construct(){

      require_once('conf.php');
      require_once('db.class.php');
      global $db;
      $this->db = $db;

    }


    /**************************************************************

        checkUserPriveleges( $userId ) - Controleer of een
        gebruiker voldoende rechten heeft om een handeling uit
        te voeern

    **************************************************************/
    public function checkUserPriveleges( $userId ){



    }


    /**************************************************************

        logIn( $username, $password ) - Log een bestaande
        gebruiker in

    **************************************************************/
    public function logIn( $username, $password ){

      $pwd = 'b942e083af9e9ba0f6f3e13c1a86a8d4ca81dbbff41e79f2393e1f7270b3cc0e7fd113570b48a2d9ae905890beae55e1f081737d5579b200929bd67aeb33da6d';

      if( $username == 'michael@lionhead.nl' && hash('sha512', $password) == $pwd ){

        $_SESSION['loggedin'] = true;
        $_SESSION['userData'] = array( 'userEmail'=>$username );

        header('Location: /');
        exit;

      }else{

        header('Location: ?loginIncorrect');
        exit;

      }

    }


  }

?>
