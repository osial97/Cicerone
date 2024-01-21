<?php
require_once("../conn/auth.php");
require_once("../conn/config.php");
include("myFunction.php");
  if(isset($_POST['create'])){
      global $db;
      $itinerario = filter_input(INPUT_POST, 'itinerario', FILTER_SANITIZE_STRING);
      $tipoAttivita = $_POST['TipoAttivita'];
      $costo = filter_input(INPUT_POST, 'costo', FILTER_VALIDATE_INT);
      $descrizione = filter_input(INPUT_POST, 'descrizione', FILTER_SANITIZE_STRING);
      $linguaM = $_POST['linguaM'];
      $linguaS = $_POST['linguaS'];
      $dataFine= filter_input(INPUT_POST, 'dataFinePrenotazione', FILTER_SANITIZE_STRING);
      $maxp = filter_input(INPUT_POST, 'Maxpartecipanti', FILTER_SANITIZE_STRING);
      $luogo=filter_input(INPUT_POST, 'luogoAppuntamento', FILTER_SANITIZE_STRING);
      $data=filter_input(INPUT_POST, 'dataAppuntamento', FILTER_SANITIZE_STRING);
      $ora=filter_input(INPUT_POST, 'oraAppuntamento', FILTER_SANITIZE_STRING);
      $citta=$_POST['cittaAppuntamento'];
      $id=$_SESSION["user"]["idUtente"];

      $sql1 = "INSERT INTO attivita (tipo, itinerario, appuntamento, costo,
               descrizione, numMaxPartecipanti, dataFinePrenotazione, codCicerone,
                linguaMadre,linguaSecondaria)
               VALUES (:tipo, :itinerario, :appuntamento, :costo, :descrizione,
               :numMaxPartecipanti, :dataFinePrenotazione, :codCicerone,
                :linguaMadre, :linguaSecondaria)";
      $sql2 = "INSERT INTO appuntamento (luogo, data, citta, ora)
               VALUES (:luogo, :data, :citta, :ora)";
      $sql3 = "SELECT MAX(codAppuntamento) as last FROM appuntamento " ;

      $stmt2=$db ->prepare($sql2);
      $param2 =array(
        ":luogo" => $luogo,
        ":data" =>$data,
        ":citta"=>$citta,
        ":ora" =>$ora
      );
      $saved2=$stmt2 ->execute($param2);
      $stmt3 =$db->prepare($sql3);
      $stmt3->execute();
      $app=$stmt3->fetchColumn();
      $stmt = $db->prepare($sql1);
      $params = array(
          ":tipo" => $tipoAttivita,
          ":itinerario" => $itinerario,
          ":appuntamento"=>$app,
          ":costo" => $costo,
          ":descrizione"=>$descrizione,
          ":numMaxPartecipanti" => $maxp,
          ":dataFinePrenotazione" => $dataFine,
          ":codCicerone" => $id,
          ":linguaMadre" => $linguaM,
          ":linguaSecondaria" => $linguaS
      );

      if(checkDateActivity($dataFine,$data)==1){
      if($saved2){
        $saved = $stmt->execute($params);
        if ($saved){
          header("Location: ../user/activitiesCreated.php");
        }else {echo 'Errore nella prima query';}
      }else {echo 'Errore nella seconda query';}
    }else {echo '<div class="alert-warning"><strong><center>Riprova, errore nell\'inserimento delle date! </center></strong> </div>';}
    }

?>
