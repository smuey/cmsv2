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

      require_once('conf.php');
      require_once('db.class.php');

      $localDB = new Database(LOCALDBNAME,LOCALDBUSER,LOCALDBPASS);

      $user = $localDB->queryrow("SELECT * FROM users WHERE email=?", array($username));

      if( !empty( $user ) ){

        if( hash('sha512', $password.$user['dateofregistration']) == $user['password'] ){

          $_SESSION['loggedin'] = true;
          $_SESSION['userData'] = array( 'userEmail'=>$username, 'usertype'=>$user['usertype'] );

          header('Location: /');
          exit;

        }else{

          header('Location: ?loginIncorrect');
          exit;

        }

      }

    }


  }

?>
