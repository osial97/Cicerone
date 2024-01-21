<?php
include("costant.php");
require_once("../conn/auth.php");
require_once("../conn/config.php");
require_once("../php/myFunction.php");
//ricerca per citta , data, tipo attivita, cicerone ,
if(isset($_POST['search'])){
  $valCitta=$plhCitta=$_POST[CITTA];
  $valDataApp=$plhData=$_POST[DATA];
  $plhTipo=$_POST[TIPO_ATTIVITA];
  $valCicerone=$plhCicerone=$_POST[CICERONE];
  $plhLingua=$_POST['lingua'];
}
else {
  $plhCitta="";
  $plhTipo="Tipo Attività";
  $plhCicerone="Cicerone Attività";
  $valCitta="";
  $valDataApp="";
  $valCicerone="";
  $plhLingua="";
}
?>
<html>

<head>
<title>Ricerca attività</title>
<?php
include("headerUser.php");
?>
</head>
<?php
include("../php/joinActivity.php");
$codice=0;
?>
  <body>
    <section class="background-gray-lightest">
      <div class="container">
      <h1>Ricerca Attività</h1>
      <form action="" method="post">
        <div class="form-group">
            <label for="citta">Città attività</label>
            <select class="form-control" name="citta">
              <?php
              $sql="SELECT * FROM comuni";
              ?><option value=null></option><?php
              foreach($db->query($sql)as $row){
                if($plhCitta==$row['comune']){
                  ?><option selected value="<?php echo $row['comune'];?>"><?php }
                  else {
                    ?><option value="<?php echo $row['comune'];?>"><?php }
                  echo $row['comune'];?>
                </option> <?php } ?>

          </select>
        </div>
        <div class="form-group">
            <label for="nome">Data Attività</label>
            <input class="form-control" type="date" name="data"
             value="<?php echo $valDataApp;?>"/>
        </div>
        <div class="form-group">
            <label for="TipoAttivita">Tipo attività</label>
            <select class="form-control" name="tipoAttivita">
              <?php
              $sql="SELECT * FROM tipoAttivita";
              ?><option value=null></option><?php
              foreach($db->query($sql)as $row){
                if($plhTipo==$row['codTipo']){
                  ?><option selected value="<?php echo $row['codTipo'];?>"><?php }
                  else {
                    ?><option value="<?php echo $row['codTipo'];?>"><?php }
                  echo $row['descrizione'];?>
                </option> <?php } ?>

          </select>
        </div>
        <div class="form-group">
            <label for="lingua">Lingua attività</label>
            <select class="form-control" name="lingua">
              <?php
              $sql="SELECT * FROM lingue";
              ?><option value=null></option><?php
              foreach($db->query($sql)as $row){
                if($plhLingua==$row['lingua']){
                  ?><option selected value="<?php echo $row['lingua'];?>"><?php }
                  else {
                    ?><option value="<?php echo $row['lingua'];?>"><?php }
                  echo $row['lingua'];?>
                </option> <?php } ?>
          </select>
        </div>

        <div class="form-group">
            <label for="nome">Cicerone Attività</label>
            <input class="form-control" type="text" name="cicerone"
             value="<?php echo $valCicerone; ?>" placeholder="<?php echo $plhCicerone; ?>" />
        </div>
        <input type="submit" value="Ricerca" class="btn btn-success btn-block" name="search"/>
      </form>
      <?php
        if(isset($_POST['search'])){
        echo "<br><div class='table-responsive'>
        <table class='table table-bordered'>
        <thead>
          <tr>
            <th>Cicerone</th>
            <th>Tipo Attività</th>
            <th>Costo</th>
            <th>Numero massimo partecipanti</th>
            <th>Data fine prenotazione</th>
            <th>Città appuntamento</th>
            <th>Luogo appuntamento</th>
            <th>Data appuntamento</th>
            <th>Ora appuntamento</th>
          </tr>
          </thead>";
        if($_POST[CITTA]=="null"){
          $citta='%';}
        else
          $citta=$_POST[CITTA];

        if(empty($_POST[DATA])){
          $data="%";
        }
        else
          $data=$_POST[DATA];

        if($_POST[TIPO_ATTIVITA]=="null")
          $tipo="%";
        else
          $tipo=$_POST[TIPO_ATTIVITA];
        if($_POST['lingua']=="null")
          $lingua="%";
        else
          $lingua=$_POST['lingua'];
        if(empty($_POST[CICERONE])){
          $cicerone="%";
        }
        else
          $cicerone=$_POST[CICERONE];
        $idCicerone=$_SESSION['user']['idUtente'];

        $sql="SELECT nome,tipoAttivita.descrizione as tDescri,
              itinerario,costo,linguaMadre,linguaSecondaria,attivita.descrizione as aDescri,
              numMaxPartecipanti,dataFinePrenotazione,citta,luogo,
              data,ora,codTipo,codAttivita,partecipanti
              FROM (((attivita INNER JOIN tipoAttivita
                ON tipoAttivita.codTipo=attivita.tipo)
                INNER JOIN appuntamento
                ON appuntamento.codAppuntamento=attivita.appuntamento)
                INNER JOIN utenti ON
                utenti.idUtente=attivita.codCicerone)
                WHERE (LOWER(appuntamento.citta) LIKE LOWER('$citta')
                AND codTipo LIKE '$tipo'
                AND (linguaMadre LIKE '$lingua' OR linguaSecondaria LIKE '$lingua')
                AND data LIKE '$data'
                AND LOWER(nome) LIKE LOWER('$cicerone')
                AND idUtente NOT LIKE '$idCicerone'

                )";

                echo "<tbody>";
                $i=0;
        foreach($db->query($sql) as $row){
            echo "<tr>";
            echo "<th>".$row["nome"]."</th>";
            echo "<th>".$row["tDescri"]."</th>";
            echo "<th>".$row["costo"]."</th>";
            echo "<th>".$row["numMaxPartecipanti"]."</th>";
            echo "<th>".$row["dataFinePrenotazione"]."</th>";
            echo "<th>".$row[CITTA]."</th>";
            echo "<th>".$row["luogo"]."</th>";
            echo "<th>".$row[DATA]."</th>";
            echo "<th>".$row["ora"]."</th>";

            if(activityFull($row["codAttivita"])==1 || checkEndActivity($row["dataFinePrenotazione"])==1) {
              echo "<th><button type='button' class='btn btn-danger btn-sm'  data-toggle='modal' data-target='#".$i."'>Dettagli</button></th>";
              echo "</tr>";
            }else
            {
              echo "<th><button type='button' class='btn btn-info btn-sm'  data-toggle='modal' data-target='#".$i."'>Dettagli</button></th>";
              echo "</tr>";
            }
              echo "  <!-- Modal -->
              <div class='modal fade' id=".$i." role='dialog'>
                <div class='modal-dialog'>

                  <!-- Modal content-->
                  <div class='modal-content'>
                    <div class='modal-header'>
                      <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      <h4 class='modal-title'>Richiesta di Partecipazione</h4>
                    </div>
                    <div class='modal-body'>
                    <label>Descrizione :". $row['aDescri'] ."</label><br>
                    <label>Lingua Madre :". $row['linguaMadre'] ."</label><br>
                    <label>Lingua Secondaria :". $row['linguaSecondaria'] ."</label><br>
                      <form action='' method='post'>
                      <p><div class='form-group'>
                        <label for='comment'>Inserisci richieste particolari da annotare al Cicerone:</label>
                        <textarea class='form-control' rows='3' name='comment'></textarea>
                      </div></p>
                      <input type='hidden' name='idAttivita' value=".$row['codAttivita']."/>
                    </div>
                    <div class='modal-footer'>";

                    if(checkEndActivity($row["dataFinePrenotazione"])==0){
                      if(activityFull($row["codAttivita"])==0){
                        if(utenteNonPartecipante($row["codAttivita"],$idCicerone))
                          echo"<input type='submit'  class='btn btn-success' name='join' value='invia'></input>";
                        else {
                          echo"<input type='button'  class='btn btn-danger' name='join' value='Hai Gia inviato una richiesta'></input>";
                        }
                      }else {
                        echo"<button type='submit' class='btn btn-danger' name='follow'>SEGUI</button>";
                      }
                    }else {
                      echo"<button type='button' class='btn btn-danger' data-dismiss='modal'>SCADUTO</button>";
                    }
                    $i++;
        }
        echo "</tbody>";
        echo "</table>";
        echo"</div>";
      }
      ?>
      </div>

    </section>
  </body>

<?php include("footerUser.php");?>

</html>
