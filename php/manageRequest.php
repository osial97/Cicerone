<?php
//Accettazione o rifiuto di una richiesta.
ini_set( 'error_reporting', E_ALL );
ini_set( 'display_errors', true );
require_once("../conn/config.php");
require_once("../conn/auth.php");
include("Mail.php");
include_once("myFunction.php");
$codice = $_POST['id'];

  if(isset($_POST['accept'])){
      $codPartecipazione = $_POST['accept'];
      $sql = "UPDATE partecipazione,attivita SET stato=:stato,partecipanti=partecipanti+1 WHERE partecipazione.codPartecipazione=:codPartecipazione AND attivita.codAttivita=:codice";
      $stmt = $db->prepare($sql);

      $params = array(
          ":stato"=>1,
           ":codPartecipazione"=>$codPartecipazione,
           ":codice"=>$codice
      );
      $update = $stmt->execute($params);
      $var=queryPartecipazione($codPartecipazione);
      gestionePartecipantiMail($var['codUtente'],$var['codAttivita'],1);
        if($update) {
          if($_SESSION['user']['guida']=='2'){
          header("Location: ../admin/manageAdmin.php? codice=$codice");
        }else {
          header("Location: ../user/manage.php? codice=$codice");
        }
      }
    }

      if(isset($_POST['refuse'])){
          $codPartecipazione = $_POST['refuse'];
          $sql = "UPDATE partecipazione SET stato=:stato WHERE codPartecipazione=:codPartecipazione";
          $stmt = $db->prepare($sql);

          $params = array(
              ":stato"=>2,
               ":codPartecipazione"=>$codPartecipazione
          );
          $update = $stmt->execute($params);
          $var=queryPartecipazione($codPartecipazione);
          gestionePartecipantiMail($var['codUtente'],$var['codAttivita'],2);
          if($update) {
            if($_SESSION['user']['guida']=='2'){
            header("Location: ../admin/manageAdmin.php? codice=$codice");
          }else {
            header("Location: ../user/manage.php? codice=$codice");
          }
        }
      }


?>
