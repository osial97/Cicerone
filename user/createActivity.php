<?php
require_once("../conn/auth.php");
require_once("../conn/config.php");
?>
<html>
<head>
<title>Cicerone - Crea Attività</title>
<?php include("headerUser.php");?>
</head>

    <section class="background-gray-lightest">
      <div class="container">
        <h1>Crea Attivita</h1>
        <form action="../php/create.php" method="POST">
          <div class="form-group">
              <label for="nome">Itinerario</label>
              <input class="form-control" type="text" name="itinerario" placeholder="Itinerario" />
          </div>
          <div class="form-group">
              <label for="TipoAttivita">Tipo attivita</label>
              <select class="form-control" name="TipoAttivita">
                <?php
                $sql="SELECT * FROM tipoAttivita";
                foreach($db->query($sql)as $row){
                  echo" <option value=".$row['codTipo'].">";
                  echo $row['descrizione'];
                  echo "</option>";
                }
                ?>
            </select>
          </div>
          <div class="form-group">
              <label for="nome">Costo Attività</label>
              <input class="form-control" type="number" name="costo"  placeholder="Costo" />
          </div>
          <div class="form-group">
              <label for="nome">Descrizione</label>
              <input class="form-control" type="text" name="descrizione" placeholder="descrizione" />
          </div>
          <div class="form-group">
              <label for="linguaM">Lingua Madre</label>
              <select class="form-control" name="linguaM">
                <?php
                $sql="SELECT * FROM lingue";
                foreach($db->query($sql)as $row){
                  echo" <option value=".$row['lingua'].">";
                  echo $row['lingua'];
                  echo "</option>";
                }
                ?>
            </select>
          </div>
          <div class="form-group">
              <label for="linguaS">Lingua Secondaria</label>
              <select class="form-control" name="linguaS">
                <?php
                $sql="SELECT * FROM lingue";
                foreach($db->query($sql)as $row){
                  echo" <option value=".$row['lingua'].">";
                  echo $row['lingua'];
                  echo "</option>";
                }
                ?>
            </select>
          </div>
          <div class="form-group">
              <label for="dataNascita">Data di fine prenotazione</label>
              <input class="form-control" type="date" name="dataFinePrenotazione" />
          </div>
          <div class="form-group">
              <label for="nome">Max Partecipanti</label>
              <input class="form-control" type="number" name="Maxpartecipanti" placeholder="Numero massimo di Partecipanti" />
          </div>

          <h3>Imposta Appuntamento</h3>
          <div class="form-group">
              <label for="cittaAppuntamento">Città Apputamento</label>
              <select class="form-control" name="cittaAppuntamento">
                <?php
                $sql="SELECT * FROM comuni";
                foreach($db->query($sql)as $row){
                  echo" <option value=".$row['comune'].">";
                  echo $row['comune'];
                  echo "</option>";
                }
                ?>
            </select>
          </div>
          <div class="form-group">
              <label for="nome">Luogo appuntamento</label>
              <input class="form-control" type="text" name="luogoAppuntamento" placeholder="Luogo" />
          </div>
          <div class="form-group">
              <label for="dataNascita">Data appuntamento</label>
              <input class="form-control" type="date" name="dataAppuntamento"/>
          </div>
          <div class="form-group">
              <label for="dataNascita">Ora appuntamento</label>
              <input class="form-control" type="time" name="oraAppuntamento"/>
          </div>
          <input type="hidden" name="idAt" value="<?php echo $valIdAt; ?>"/>
          <input type="hidden" name="idAp" value="<?php echo $valIdAp; ?>"/>
          <input type="submit" class="btn btn-success btn-block" name="create" value="Crea" />

        </form>
        </section>
        <?php include("footerUser.php"); ?>
</body>
</html>
