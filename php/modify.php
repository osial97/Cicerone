<?php
include("../conn/config.php");
include("../conn/auth.php");
require_once("Mail.php");
require_once("myFunction.php");

if(isset($_POST['modify2'])){
  $itinerario = filter_input(INPUT_POST, 'itinerario', FILTER_SANITIZE_STRING);
  $tipoAttivita = $_POST['TipoAttivita'];
  $costo = filter_input(INPUT_POST, 'costo', FILTER_VALIDATE_INT);
  $descrizione = filter_input(INPUT_POST, 'descrizione', FILTER_SANITIZE_STRING);
  $linguaM = filter_input(INPUT_POST, 'linguaM', FILTER_SANITIZE_STRING);
  $linguaS = filter_input(INPUT_POST, 'linguaS', FILTER_SANITIZE_STRING);
  $dataFine= filter_input(INPUT_POST, 'dataFinePrenotazione', FILTER_SANITIZE_STRING);
  $maxp = filter_input(INPUT_POST, 'Maxpartecipanti', FILTER_SANITIZE_STRING);
  $luogo=filter_input(INPUT_POST, 'luogoAppuntamento', FILTER_SANITIZE_STRING);
  $data=filter_input(INPUT_POST, 'dataAppuntamento', FILTER_SANITIZE_STRING);
  $ora=filter_input(INPUT_POST, 'oraAppuntamento', FILTER_SANITIZE_STRING);
  $citta=filter_input(INPUT_POST, 'cittaAppuntamento', FILTER_SANITIZE_STRING);

  $idAt=filter_input(INPUT_POST, 'idAt', FILTER_VALIDATE_INT);
  $idAp=filter_input(INPUT_POST, 'idAp', FILTER_VALIDATE_INT);
  $numP=activityFull($idAt);
  $sql1="UPDATE attivita  SET
         tipo= :tipo,itinerario= :itinerario,
         appuntamento= :appuntamento,costo= :costo,
         descrizione= :descrizione,
         numMaxPartecipanti= :numMaxPartecipanti,
         dataFinePrenotazione= :dataFinePrenotazione,
         linguaMadre=:linguaMadre,
         linguaSecondaria=:linguaSecondaria
         WHERE codAttivita LIKE :id";
  $sql2="UPDATE appuntamento SET
         luogo= :luogo,data= :data,citta= :citta, ora= :ora
         WHERE codAppuntamento LIKE :id";

  $param2 =array(
    ":luogo" => $luogo,
    ":data" =>$data,
    ":citta"=>$citta,
    ":id"=>$idAp,
    ":ora" =>$ora
  );
  $params = array(
      ":tipo" => $tipoAttivita,
      ":itinerario" => $itinerario,
      ":appuntamento"=>$idAp,
      ":costo" => $costo,
      ":descrizione"=>$descrizione,
      ":numMaxPartecipanti" => $maxp,
      ":dataFinePrenotazione" => $dataFine,
      ":linguaMadre" =>$linguaM,
      ":linguaSecondaria" =>$linguaS,
      ":id" =>$idAt,
  );
  $stmt2=$db ->prepare($sql2);
  $saved2=$stmt2 ->execute($param2);
  $stmt = $db->prepare($sql1);
  $saved = $stmt->execute($params);
  modificaAttivitaMail($idAt);
  if($numP==1){
    $numP2=activityFull($idAt);
    if($numP2==0){
      attivitaSeguitaPostoLiberatoMail($idAt);
    }
  }
  if($saved2){
    if ($saved){
      if($_SESSION['user']['guida']==2){
        header("Location: ../admin/adminView.php");
      }else{
      header("Location: ../user/activitiesCreated.php");
      }
    }
  }
  else {
  }

}
else {
  header("Location: ../user/profile.php");
}
 ?>
