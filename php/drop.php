<?php
//Rimozione Attivita.
if(isset($_POST['drop'])){
  include("../conn/config.php");
  include("../conn/auth.php");
  include("Mail.php");
          $val=$_POST['drop'];
          $sql2="SELECT appuntamento FROM attivita WHERE codAttivita=$val";
          $stmt2=$db->prepare($sql2);
          $stmt2->execute();
          $val2=$stmt2->fetchColumn();
          eliminaAttivitaMail($val);
          $sql3="DELETE FROM appuntamento WHERE codAppuntamento=$val2";
          $sql="DELETE FROM attivita WHERE codAttivita=$val ";
          $stmt=$db->prepare($sql);
          $saved=$stmt->execute();
          $stmt3=$db->prepare($sql3);
          $saved3=$stmt3->execute();
          if($saved && $saved3) {
            if($_SESSION['user']['guida']=='2'){
              header("Location: ../admin/adminView.php");
            }else {
              header("Location: ../user/activitiesCreated.php");
            }
    }
}
?>
