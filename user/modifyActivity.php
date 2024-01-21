<?php
require_once("../conn/auth.php");
require_once("../conn/config.php");
include("../php/myFunction.php");
?>
<html>
<head>
<title>Cicerone - Gestisci Attività</title>
  <?php

  include("headerUser.php");
  if(isset($_POST['modify'])){
    $id=$_POST['modify'];
    $att=queryAttivita($id);
    $idAp=$att["appuntamento"];
    $app=queryAppuntamento($idAp);
    $valItine=$plhItine=$att["itinerario"];
    $plhTipo=$att["tipo"];
    $valCosto=$att["costo"];
    $valDescr=$att["descrizione"];
    $plhDataFine=$att["dataFinePrenotazione"];
    $valMaxP=$att["numMaxPartecipanti"];
    $plhLinguaM=$att['linguaMadre'];
    $plhLinguaS=$att['linguaSecondaria'];
    $plhCitta=$app["citta"];
    $valLuogo=$app["luogo"];
    $valDataApp=$app["data"];
    $valOraApp=$app["ora"];
    $valIdAt=$att["codAttivita"];
    $valIdAp=$app["codAppuntamento"];
    $plhName="modify2";
  }
  else {
    header("Location: profile.php");
  }
  ?>
</head>

    <section class="background-gray-lightest">
      <div class="container">
        <h1>Modifica Attività</h1>
        <form action="../php/modify.php" method="POST">
          <div class="form-group">
              <label for="nome">Itinerario</label>
              <input class="form-control" type="text" name="itinerario" value="<?php echo $valItine; ?>" placeholder="<?php echo $plhItine; ?>" />
          </div>
          <div class="form-group">
            <label for="TipoAttivita">Tipo attivita</label>
            <select class="form-control" name="TipoAttivita">
              <?php
              $sql="SELECT * FROM tipoAttivita";
                foreach($db->query($sql)as $row){
                  if($plhTipo==$row['codTipo']){
                    ?><option selected value="<?php echo $row['codTipo'];?>">
                  <?php }
                  else {
                    ?><option value="<?php echo $row['codTipo'];?>">
                  <?php }
                  echo $row['descrizione'];?>
                  </option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
              <label for="nome">Costo Attività</label>
              <input class="form-control" type="number" name="costo" value="<?php echo $valCosto; ?>"   />
          </div>
          <div class="form-group">
              <label for="nome">Descrizione</label>
              <input class="form-control" type="text" name="descrizione" value="<?php echo $valDescr; ?>"  />
          </div>
          <div class="form-group">
            <label for="linguaM">Tipo attivita</label>
            <select class="form-control" name="linguaM">
              <?php
              $sql="SELECT * FROM lingue";
                foreach($db->query($sql)as $row){
                  if($plhLinguaM==$row['lingua']){
                    ?><option selected value="<?php echo $row['lingua'];?>">
                  <?php }
                  else {
                    ?><option value="<?php echo $row['lingua'];?>">
                  <?php }
                  echo $row['lingua'];?>
                  </option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="linguaS">Tipo attivita</label>
            <select class="form-control" name="linguaS">
              <?php
              $sql="SELECT * FROM lingue";
                foreach($db->query($sql)as $row){
                  if($plhLinguaS==$row['lingua']){
                    ?><option selected value="<?php echo $row['lingua'];?>">
                  <?php }
                  else {
                    ?><option value="<?php echo $row['lingua'];?>">
                  <?php }
                  echo $row['lingua'];?>
                  </option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
              <label for="dataNascita">Data di fine prenotazione</label>
              <input class="form-control" type="date" name="dataFinePrenotazione" value="<?php echo $plhDataFine; ?>" />
          </div>
          <div class="form-group">
              <label for="nome">Max Partecipanti</label>
              <input class="form-control" type="number" name="Maxpartecipanti" value="<?php echo $valMaxP; ?>"  />
          </div>

          <h3>Modifica Appuntamento</h3>
          <div class="form-group">
            <label for="cittaAppuntamento">Città Apputamento</label>
            <select class="form-control" name="cittaAppuntamento">
              <?php
              $sql="SELECT * FROM comuni";
                foreach($db->query($sql)as $row){
                  if($plhCitta==$row['comune']){
                    ?><option selected value="<?php echo $row['comune'];?>">
                  <?php }
                  else {
                    ?><option value="<?php echo $row['comune'];?>">
                  <?php }
                  echo $row['comune'];?>
                  </option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
              <label for="nome">Luogo appuntamento</label>
              <input class="form-control" type="text" name="luogoAppuntamento" value="<?php echo $valLuogo; ?>"  />
          </div>
          <div class="form-group">
              <label for="dataNascita">Data appuntamento</label>
              <input class="form-control" type="date" name="dataAppuntamento" value="<?php echo $valDataApp; ?>" />
          </div>
          <div class="form-group">
              <label for="dataNascita">Ora appuntamento</label>
              <input class="form-control" type="time" name="oraAppuntamento" value="<?php echo $valOraApp; ?>" />
          </div>
          <input type="hidden" name="idAt" value="<?php echo $valIdAt; ?>"/>
          <input type="hidden" name="idAp" value="<?php echo $valIdAp; ?>"/>
          <input type="submit" class="btn btn-success btn-block" name="modify2" value="Modifica Attività" />

        </form>
        </section>
        <?php include("footerUser.php"); ?>
</body>
</html>
