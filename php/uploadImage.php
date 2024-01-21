<?php
require("../conn/config.php");
require("../conn/auth.php");
$file_path = $_FILES["file"]["tmp_name"];
$codImage = base64_encode(file_get_contents($file_path));
$idUtente=$_SESSION["user"]["idUtente"];
$sql ="UPDATE utenti SET image=:image WHERE utenti.idUtente = :idUtente";
$params = array(
    ":image" => $codImage,
    ":idUtente" => $idUtente
);

  $stmt = $db->prepare($sql);
  $update =$stmt->execute($params);

  if($update) {header('Location: ../user/profile.php');}
  else {echo "errore nell'upload, caricare un immagine!";};
?>
