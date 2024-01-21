<?php
include("../conn/auth.php");
include("../conn/config.php");
if(isset($_POST["elimina"])) {

  $idUtente=$_SESSION["user"]["idUtente"];
  if($_SESSION["user"]["guida"]==1) {
  $sql1="SELECT * FROM attivita WHERE codCicerone=:idUtente";
  $params1 = array( ":idUtente" => $idUtente );
  $stmt1 = $db->prepare($sql1);
  $stmt1->execute($params1);
  $data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
  foreach($data as $row){
    $sql2="DELETE FROM appuntamento WHERE idAppuntamento=:idAppuntamento";
    $params2 = array( ":idAppuntamento" => $row["appuntamento"] );
    $stmt2 = $db->prepare($sql2);
    $stmt2->execute($params2);
  }
}
  $sql3="DELETE FROM utenti WHERE idUtente=:idUtente";

  $params3 = array( ":idUtente" => $idUtente );
  $stmt3 = $db->prepare($sql3);
  $delete=$stmt3->execute($params3);

  if($delete) {
    echo "eliminazione effettuata con successo";
    header("Location: ../conn/logout.php");
  } else {
    echo "eliminazione fallita";
  }




}
?>
