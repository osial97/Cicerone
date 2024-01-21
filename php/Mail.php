<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once("myFunction.php");
require_once('../phpmailer-master/src/Exception.php');
require_once('../phpmailer-master/src/PHPMailer.php');
require_once('../phpmailer-master/src/SMTP.php');
function mailer($array,$addres){
  try{
    $mail = new PHPMailer(true);
      //Server settings
      $mail->isSMTP();                                            // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';                             // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                                     // authentication enabled
      $mail->Username   = 'dddlingegneria@gmail.com';             // SMTP username
      $mail->Password   = 'ThisIsIngegneria2k19';                 // SMTP password
      $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
      $mail->Port       = 587;                                    // TCP port to connect to
      $mail->CharSet = "UTF-8";
      $mail->MailerDebug=false;
      //Recipients
      $mail->setFrom('dddlingegneria@gmail.com','Cicerone');
      if(!is_null($addres)){
        $array['nMail']=sizeof($addres);
      }
      else {
        $array['nMail']=1;
      }
      if($array['nMail']!=0){
        if($array['flagMultiAddress']==true){
          foreach ($addres as $key) {
            $mail->addAddress($key['email']);
          }
        }
        else
          $mail->addAddress($array['email']);
      }
      else {
        return ;
      }

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = $array['Subject'];
      $mail->Body    = $array['Body'];
      if($mail->send())
        return true;
  }
  catch(Exception $e){
    return false;
  }
}

function registrationMail($idUtente){
  //include(PATH);
  $app=queryUtente($idUtente);
  $array['flagMultiAddress']=false;
  $array['email']=$app['email'];
  $array['Subject']="Registrazione su Cicerone confermata";
  $array['Body']=file_get_contents("../PHPMailer-master/email/registrazione/email.html");
  if(mailer($array,null))
    return true;
  else
    return false;
}

function gestionePartecipantiMail($idUtente,$idAt,$stato){
  //include(PATH);
  $array['flagMultiAddress']=false;
  $app=queryUtente($idUtente);
  $array['email']=$app['email'];
  //Mail per la richesta accettata
  if($stato==1){
    $array['Subject']="Richiesta di partecipazione all'attività accettata";
    $array['Body']="Il cicerone ha accettato la sua richiesta all'attività: ";
    $array['Body'].=createBodyGestionePartecipanti($idAt);
  }
  //Mail per la richiesta rifiutata
  if($stato==2){
    $array['Subject']="Richiesta di partecipazione all'attività rifutata";
    $array['Body']="Il cicerone ha rifiutato la sua richiesta all'attività: ";
    $array['Body'].=createBodyGestionePartecipanti($idAt);
  }

  if(mailer($array,null))
    return true;
  else
    return false;
}

function createBodyGestionePartecipanti($idAt){
  //include(PATH);
  $att=queryAttivita($idAt);
  $app=queryAppuntamento($att['appuntamento']);
  $risultato="<br> ".$att['descrizione'];
  $risultato.="<br>Con Apputamento a : ".$app['citta'];
  $risultato.="<br>Con incontro : ".$app['luogo'];
  $risultato.="<br>Nel giorno: ".$app['data'];
  $risultato.="<br>Alle ore: ".$app['ora'];
  return $risultato;
}

function richiestaPartecipazioneMail($idUtente,$idAt){
  //include(PATH);
  $idAt=intval($idAt);
  $app=queryUtente($idUtente);
  $var=queryCiceroneFromActivity($idAt);
  $array['flagMultiAddress']=false;
  $array['email']=$var['email'];
  $array['Subject']="Richesta di partecipazione all'attività";
  $array['Body']="L'utente: ".$app['nome']." ".$app['cognome']." ha inviato una richiesta per partecipare all'attività: ";
  $array['Body'].=createBodyGestionePartecipanti($idAt);
  if(mailer($array,null))
    return true;
  else
    return false;
}
function attivitaSeguitaMail($idUtente,$idAt){
  //include(PATH);
  $idAt=intval($idAt);
  $app=queryUtente($idUtente);
  $var=queryCiceroneFromActivity($idAt);
  $array['flagMultiAddress']=false;
  $array['email']=$var['email'];
  $array['Subject']="Attività Piena";
  $array['Body']="L'utente: ".$app['nome']." ".$app['cognome']." segue l'attività: ";
  $array['Body'].=createBodyGestionePartecipanti($idAt);
  if(mailer($array,null))
    return true;
  else
    return false;
}


function modificaAttivitaMail($idAt){
  $att=queryAttivita($idAt);
  if($att['partecipanti']==0){
    return false;
  }
  else{
    $array['flagMultiAddress']=true;
    $var=queryEmailGlobetrotterFromAttivita($idAt);
    $array['multiEmail']=$var;
    $array['Subject']="Variazione dati attività";
    $array['Body']="Il cicerone ha modificato l'attività: ";
    $array['Body'].=createBodyGestionePartecipanti($idAt);
    if(mailer($array,$var))
      return true;
    else
      return false;
  }
}

function eliminaAttivitaMail($idAt){
  $att=queryAttivita($idAt);
  if($att['partecipanti']==0){
    return false;
  }
  else{
    $array['flagMultiAddress']=true;
    $var=queryEmailGlobetrotterFromAttivita($idAt);
    $array['multiEmail']=$var;
    $array['Subject']="Cancellazione attività";
    $array['Body']="Il cicerone ha eliminato l'attività: ";
    $array['Body'].=createBodyGestionePartecipanti($idAt);
    if(mailer($array,$var))
      return true;
    else
      return false;
    }
}

function attivitaSeguitaPostoLiberatoMail($idAt){
  if(haveSeguiti($idAt)){
    $array['flagMultiAddress']=true;
    $var=getSeguiti($idAt);
    $array['multiEmail']=$var;
    $array['Subject']="Liberazione di un posto attività";
    $array['Body']="Sono nuovamente disponibili posti per  l'attività: ";
    $array['Body'].=createBodyGestionePartecipanti($idAt);
    if(mailer($array,$var))
      return true;
    else
      return false;
  }
  else {
    return false;
  }
}


?>
