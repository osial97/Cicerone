<?php
//Invio Richiesta Attivita.
include_once("Mail.php");
include_once("myFunction.php");
if(isset($_POST['join'])){
 $comment = $_POST["comment"];
 $codice=$_POST["idAttivita"];
 $codice=intval($codice);
    $sql = "INSERT INTO partecipazione (codUtente, codAttivita, stato, richiesta)
            VALUES (:codUtente, :codAttivita, :stato, :richiesta) ";
    $stmt = $db->prepare($sql);

    $params = array(
        ":codUtente" => $_SESSION['user']['idUtente'],
        ":codAttivita"=> $codice,
        ":stato" => 0,
        ":richiesta" => $comment
    );

    $saved = $stmt->execute($params);
    richiestaPartecipazioneMail($_SESSION['user']['idUtente'],$codice);
    if($saved) {
      echo '<div class="alert-success"><strong><center>Richiesta di Partecipazione inviata con successo! </center></strong> </div>';
      echo'<meta http-equiv="refresh" content="3.00;search.php" />';
    }
    else{
      echo '<div class="alert-warning"><strong><center>Errore!</center></strong> </div>';
      echo'<meta http-equiv="refresh" content="3.00;search.php" />';
    }
}
if(isset($_POST['follow'])){
  $comment = $_POST["comment"];
  $codice=$_POST["idAttivita"];
  $codice=intval($codice);
     $sql = "INSERT INTO partecipazione (codUtente, codAttivita, stato, richiesta)
             VALUES (:codUtente, :codAttivita, :stato, :richiesta) ";
     $stmt = $db->prepare($sql);

     $params = array(
         ":codUtente" => $_SESSION['user']['idUtente'],
         ":codAttivita"=> $codice,
         ":stato" => 3,
         ":richiesta" => $comment
     );

     $saved = $stmt->execute($params);
     attivitaSeguitaMail($_SESSION['user']['idUtente'],$codice);
     if($saved) {
       echo '<div class="alert-success"><strong><center>Attività seguita con successo! </center></strong> </div>';
       echo'<meta http-equiv="refresh" content="3.00;search.php" />';
     }
     else{
       echo '<div class="alert-warning"><strong><center>Errore!</center></strong> </div>';
       echo'<meta http-equiv="refresh" content="3.00;search.php" />';
     }
}
if(isset($_POST['joinS'])){
  $codAttivita=$_POST['codAttivita'];
  $codPartecipazione=$_POST['joinS'];
  updateRequest($codAttivita,$_SESSION['user']['idUtente'],$codPartecipazione);
  echo '<div class="alert-success"><strong><center>Richiesta di Partecipazione inviata con successo! </center></strong> </div>';
  echo'<meta http-equiv="refresh" content="2.00;../user/myActivities.php" />';
}
?>
