<?php
//Rimozione Attivita.
if(isset($_POST['delete'])){
  include("../conn/config.php");
  include("Mail.php");
          $codPartecipazione=$_POST['delete'];
          $codAttivita=$_POST['codAttivita'];
          $sql="DELETE FROM partecipazione WHERE codPartecipazione=$codPartecipazione";
          $sql2="UPDATE attivita SET partecipanti=partecipanti-1 WHERE codAttivita=$codAttivita";
          $stmt=$db->prepare($sql);
          $saved=$stmt->execute();
          $stmt2=$db->prepare($sql2);
          $saved2=$stmt2->execute();
          attivitaSeguitaPostoLiberatoMail($codAttivita);
          if($saved && $saved2){header("Location: ../user/myActivities.php");}
    }
?>
