<?php
require_once("../conn/config.php");
require_once("../conn/auth.php");

  if(isset($_POST['sendreport'])){


      $idUtente = $_SESSION["user"]["idUtente"];
      $mail = $_SESSION["user"]["email"];
      $oggetto = $_POST["oggetto"];
      $messaggio = $_POST["messaggio"];

      $sql="INSERT INTO segnalazioni (idUtente,oggetto,messaggio)
      VALUES (:idUtente,:oggetto,:messaggio)";
      $stmt=$db->prepare($sql);
      $params = array(
        ":idUtente" => $idUtente,
        ":oggetto" => $oggetto,
        ":messaggio" => $messaggio
      );
      $saved=$stmt->execute($params);

      if($saved){
        echo'<script type="text/javascript">
        window.alert("Segnalazione inviata con Successo. La contatteremo tramite mail!");
        </script>';

      }else {
        echo'<script type="text/javascript">
        window.alert("Segnalazione non inviata, Errore!.");
        </script>';
      }
      header("Location: ../user/contactUser.php");
}
?>
