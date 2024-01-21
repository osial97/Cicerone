<?php

ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
require_once("../conn/config.php");
include("Mail.php");
  if(isset($_POST['register'])){


      $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
      $cognome = filter_input(INPUT_POST, 'cognome', FILTER_SANITIZE_STRING);
      $sesso = $_POST["sesso"];
      $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
      $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
      $dataNascita = filter_input(INPUT_POST, 'dataNascita', FILTER_SANITIZE_STRING);
      $indirizzo= filter_input(INPUT_POST, 'indirizzo', FILTER_SANITIZE_STRING);
      $guida = $_POST["guida"];

      $sql = "INSERT INTO utenti (nome, cognome, sesso, password, email, dataNascita, indirizzo, guida)
              VALUES (:nome, :cognome, :sesso, :password, :email, :dataNascita, :indirizzo, :guida)";
      $stmt = $db->prepare($sql);

      $params = array(
          ":nome" => $nome,
          ":cognome" => $cognome,
          ":sesso" => $sesso,
          ":password" => $password,
          ":email" => $email,
          ":dataNascita" => $dataNascita,
          ":indirizzo" => $indirizzo,
          ":guida" => $guida
      );

      $saved = $stmt->execute($params);
      $sql3="SELECT MAX(idUtente) as last FROM utenti";
      $stmt3 =$db->prepare($sql3);
      $stmt3->execute();
      $app=$stmt3->fetchColumn();
      $varMail=registrationMail($app);
      if($saved && $varMail) {
        echo '<div class="alert-success"><strong><center>Registrazione effettuata con Successo! </center></strong> </div>';
        echo'<meta http-equiv="refresh" content="3.00; ../index.php" />';
      }else {echo '<div class="alert-warning"><strong><center>Errore, registrazione non eseguita! </center></strong> </div>';
        echo'<meta http-equiv="refresh" content="3.00; ../index.php" />';
      }
    }
?>
