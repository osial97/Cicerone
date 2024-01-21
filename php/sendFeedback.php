<?php
require_once("../conn/config.php");

if(isset($_POST["rileva"])) {
  $rate=$_POST["link"];
  $codice=$_POST["idAttivita"];
  $idUtente=$_POST["codUtente"];

  $sql = "INSERT INTO feedback (idUtente,idAttivita,valore) VALUES (:idUtente,:idAttivita,:valore)";
  $stmt = $db->prepare($sql);
  $params = array(
  ':valore' =>$rate,
  ':idUtente' =>$idUtente,
  ':idAttivita' =>$codice,
  );

  $stmt->execute($params);
} else {$rate=0;}


header("Location: ../user/myActivities.php? codice=$codice");
?>
