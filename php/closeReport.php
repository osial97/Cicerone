<?php
//Chiusura Segnalazione.
if(isset($_POST['close'])){
  include("../conn/config.php");
  include("../conn/auth.php");

          $idSegnalazione=$_POST['close'];
          $sql="DELETE FROM segnalazioni WHERE idSegnalazione=$idSegnalazione";
          $stmt=$db->prepare($sql);
          $saved=$stmt->execute();

          if($saved) {
              header("Location: ../admin/report.php");
            }

    }

?>
