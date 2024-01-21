<?php
//require_once("costant.php");
define('PATH',"../conn/config.php");
define('DATE_MODE',"Y-m-d");
include(PATH);
include_once("Mail.php");
/*convertStato converte in maniera "SOLO VISIVA" lo stato della richiesta con valori 0,1,2 in IN ATTESA,ACCETTATA,RIFIUTATA */
function convertStato($stato){
  if($stato==0) {return "IN ATTESA" ;}
  if($stato==1) {return "ACCETTATA" ;}
  if($stato==2) {return "RIFIUTATA" ;}
  if($stato==3) {return "SEGUITO" ;}
}

/*query per l'appuntamento
*/
function queryAppuntamento($idAp){
    //include(PATH);
    global $db;
    $sql2="SELECT * FROM appuntamento where codAppuntamento=$idAp";
    $stmt2=$db->prepare($sql2);
    $stmt2->execute();
    $app=$stmt2->fetchAll();
    return $app[0];
}
/*query per la partecipazione
*/
function queryPartecipazione($idPa){
    //include(PATH);
    global $db;
    $sql2="SELECT * FROM partecipazione where codPartecipazione=$idPa";
    $stmt2=$db->prepare($sql2);
    $stmt2->execute();
    $app=$stmt2->fetchAll();
    return $app[0];
}

function queryPartecipazioneFromAttivita($idAt){
  //include(PATH);
  global $db;
  $sql2="SELECT * FROM partecipazione where codAttivita=$idat";
  $stmt2=$db->prepare($sql2);
  $stmt2->execute();
  $app=$stmt2->fetchAll();
  return $app;
}
/*query per l'utente
*/
function queryUtente($idUt){
    //include(PATH);
    global $db;
    $sql2="SELECT * FROM utenti where idUtente=$idUt";
    $stmt2=$db->prepare($sql2);
    $stmt2->execute();
    $app=$stmt2->fetchAll();
    return $app[0];
}
//query per il cicerone dell'attività
function queryCiceroneFromActivity($idAt){
  $att=queryAttivita($idAt);
  return queryUtente($att['codCicerone']);
}

//query per le email dei globetrotter partecipanti all'attività
function queryEmailGlobetrotterFromAttivita($idAt){
  //include(PATH);
  global $db;
  $sql2="SELECT utenti.email as email FROM
        utenti INNER JOIN partecipazione ON
        utenti.idUtente=partecipazione.codUtente
        WHERE codAttivita=$idAt
        AND partecipazione.stato=1";
  $stmt2=$db->prepare($sql2);
  $stmt2->execute();
  $app=$stmt2->fetchAll();
  return $app;
}
function queryEmailGlobetrotterFromAttivitaPostiLiberi($idAt){
  global $db;
  $sql2="SELECT utenti.email as email FROM
        utenti INNER JOIN partecipazione ON
        utenti.idUtente=partecipazione.codUtente
        WHERE codAttivita=$idAt
        AND stato=3";
  $stmt2=$db->prepare($sql2);
  $stmt2->execute();
  $app=$stmt2->fetchAll();
  return $app;
}
/*query per l'attivita
*/
function queryAttivita($id){
  //include(PATH);
  global $db;
  $sql1="SELECT * FROM attivita WHERE codAttivita=$id";
  $stmt1=$db->prepare($sql1);
  $stmt1->execute();
  $att=$stmt1->fetchAll();
  return $att[0];
}

/*activityFull controlla se l'attivita ha raggiunto il numero massimo di Partecipanti:
ritorna 0 se c'è almeno un posto libero
ritorna 1 se è full */
function activityFull($codAttivita){
  //include(PATH);
  global $db;
  $sql = "SELECT partecipanti FROM attivita WHERE codAttivita=$codAttivita AND partecipanti<numMaxPartecipanti";
  $result=$db->query($sql);
  $row=$result->fetch(PDO::FETCH_ASSOC);
    if($row!=null)
      {return 0;}
    else
      {return 1;}
}

/*checkDateActivity controlla la validità delle date informando l'utente nel caso ci sia qualche errore!
  ritorna 0 se c'è almeno una data errata
  ritorna 1 se è tutto ok*/
function checkDateActivity($dataFinePrenotazione,$data){
  $ok=0;
  $ok2=0;
  $ok3=0;

  if(date(DATE_MODE)>$data){
    echo "La data di inzio dell'attivita non è corretta!";

  }else{ $ok=1;}

  if (date(DATE_MODE)>$dataFinePrenotazione){
    echo "La data di fine prenotazione dell'attivita non è corretta!";
  }else {$ok2=1;}

  if($data<$dataFinePrenotazione){
    echo "La data di inzio dell'attivita deve essere successiva a quella di fine prenotazione!";
  }else{ $ok3=1;}

  if($ok*$ok2*$ok3==1){ return 1;}
  else {return 0;}
}


function checkEndActivity($data){
if(date(DATE_MODE)>$data){
 return 1;
}else {return 0;}
}

function checkActivitiesEnded($idUtente){
  //include(PATH);
  global $db;
  $sql = "SELECT * FROM attivita INNER JOIN appuntamento WHERE codCicerone=$idUtente AND CURDATE()<data";
  $result=$db->query($sql);
  $row=$result->fetch(PDO::FETCH_ASSOC);
  if($row==null)
    {return 1;}
  else
    {return 0;}
}


function checkRequestSended($idUtente,$codAttivita){
  //include(PATH);
  global $db;
  $sql = "SELECT * FROM attivita INNER JOIN partecipazioni WHERE codCicerone=$idUtente AND CURDATE()<data";
  $result=$db->query($sql);
  $row=$result->fetch(PDO::FETCH_ASSOC);
    if($row==null)
      {return 1;}
    else
      {return 0;}
}

function returnVoto($idAttivita){
  //include(PATH);
  global $db;
  $sql = "SELECT AVG(valore) FROM feedback WHERE idAttivita=$idAttivita";
  $result=$db->query($sql);
  $row=$result->fetch(PDO::FETCH_ASSOC);
  return $row['AVG(valore)'];
}

function checkFeedback($idAttivita,$idUtente){
  //include(PATH);
  global $db;
  $sql = "SELECT idFeedback FROM feedback WHERE idUtente=$idUtente AND idAttivita=$idAttivita";
  $result=$db->query($sql);
  $row=$result->fetch(PDO::FETCH_ASSOC);
  if($row==NULL)
    return 1;
  else
    return 0;
}


function getSeguiti($idAt){
  global $db;
  $sql="SELECT email from utenti inner join partecipazione
        on utenti.idUtente=partecipazione.codUtente
        where codAttivita=$idAt
        AND partecipazione.stato=3 ";
  $stmt=$db->prepare($sql);
  $stmt->execute();
  $app=$stmt->fetchAll();
  return $app;
}

function haveSeguiti($idAt){
  global $db;
  $sql="SELECT COUNT(email) as n from utenti inner join partecipazione
        on utenti.idUtente=partecipazione.codUtente
        where codAttivita=$idAt
        AND partecipazione.stato=3 ";
  $stmt=$db->prepare($sql);
  $stmt->execute();
  $app=$stmt->fetchColumn();
  if($app>0){
    return true;
  }
  else {
    return false;
  }
}

function utenteNonPartecipante($idAt,$idUt){
  global $db;
  $sql="SELECT COUNT(codUtente) as n FROM partecipazione where codUtente LIKE '$idUt' AND codAttivita LIKE '$idAt'";
  $stmt=$db->prepare($sql);
  $stmt->execute();
  $app=$stmt->fetchColumn();
  if($app==0){
    return true;
  }
  else {
    return false;
  }
}


function updateRequest($codAttivita,$idUt,$codPartecipazione){
  global $db;
  $sql="UPDATE partecipazione SET stato='0' WHERE codPartecipazione=:codice";
  $stmt = $db->prepare($sql);
  $comment="";
  $params = array(
      ":codice" => $codPartecipazione
  );

  $saved = $stmt->execute($params);
  richiestaPartecipazioneMail($idUt,$codAttivita);
  return;
}
 ?>
