<?php

  session_start();

  if( isset( $_POST ) && !empty( $_POST ) ){

    //  Tot ik er aan toe kom om dit ergens in een tabel op te slaan en uit te breiden, doen we het
    //  maar even zo (niet heul netjes, I know)
    require_once('classes/user.class.php');
    $user = new User;

    $user->logIn( $_POST['email'], $_POST['password'] );

  }

?>

<div class="container">

  <?php

    if( isset( $_GET['loginIncorrect'] ) ){

      echo '<div class="alert alert-danger text-center" role="alert">
              Uw inloggegevens zijn incorrect
            </div>';

    }

  ?>

  <form class="form-signin" method="post">
    <h2 class="form-signin-heading">Inloggen</h2>
    <label for="inputEmail" class="sr-only">Emailadres</label>
    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="Emailadres" required autofocus>
    <label for="inputPassword" class="sr-only">Wachtwoord</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Wachtwoord" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Inloggen</button>
  </form>

</div>
