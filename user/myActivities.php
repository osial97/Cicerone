<?php
require_once("costant.php");
require_once("../conn/auth.php");
require_once("../conn/config.php");
require_once("../php/myFunction.php");
include("../php/joinActivity.php");

?>

<html>
<head>
<title>Cicerone - Gestisci Attività</title>
<?php include("headerUser.php");?>
</head>
  <body>
    <section class="background-gray-lightest">
      <div class="container">
        <h2>Le mie Attività</h2>
        <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th>Tipo Attività</th>
          <th>Città appuntamento</th>
          <th>Luogo appuntamento</th>
          <th>Data appuntamento</th>
          <th>Ora appuntamento</th>
          <th>Stato</th>
          <th>Rimuovi</th>
          <th></th>
        </tr>
      </thead>
        <?php
        $id= $_SESSION["user"][ID_UTENTE];
        $sql= "SELECT luogo,data,ora,citta,stato,itinerario,codPartecipazione,linguaMadre,
              linguaSecondaria,attivita.descrizione as aDescri,
              tipoAttivita.descrizione as tDescri,attivita.codAttivita as codice
              from (attivita inner join tipoAttivita
              ON tipoAttivita.codTipo=attivita.tipo)
              inner join appuntamento
              ON appuntamento.codAppuntamento=attivita.appuntamento
              inner join partecipazione
              ON partecipazione.codAttivita=attivita.codAttivita
              where partecipazione.codUtente=$id
              AND CURDATE()<=data";

        $data=$db->query($sql)->fetchAll();
        $i=0;
        foreach($data as $row){
          echo "<tbody><tr>";
          echo "<th>" .$row["tDescri"]. "</th>";
          echo "<th>" .$row[CITTA]. "</th>";
          echo "<th>" .$row[LUOGO]. "</th>";
          echo "<th>" .$row["data"]. "</th>";
          echo "<th>" .$row["ora"]. "</th>";
          echo "<th>" .convertStato($row["stato"]). "</th>";
          echo "<form action='../php/deleteRequest.php' method='post'>";
          echo"<input type='hidden' name='codAttivita' value=".$row['codice'].">";
          echo   "<th><button type='submit' class='btn btn-danger btn-sm' name='delete' value=".$row['codPartecipazione'].">";
          echo     "<span class='fa fa-remove'></span></button></form></th>";
          echo "<th><button type='button' class='btn btn-info btn-sm'  data-toggle='modal' data-target='#".$i."'>Dettagli</button></th>";
          if($row["stato"]==3){
            if(activityFull($row["codice"])==0){
              echo "<form action='../php/joinActivity.php' method='post'>";
              echo"<input type='hidden' name='codAttivita' value=".$row['codice'].">";
              echo   "<th><button type='submit' class='btn btn-success btn-sm' name='joinS' value=".$row['codPartecipazione'].">";
              echo     "<span class='fa fa-check'></span></button></form></th>";
            }
          }
          echo   "</tr>";

          echo "  <!-- Modal -->
          <div class='modal fade' id=".$i." role='dialog'>
            <div class='modal-dialog'>

              <!-- Modal content-->
              <div class='modal-content'>
                <div class='modal-header'>
                  <button type='button' class='close' data-dismiss='modal'>&times;</button>
                  <h4 class='modal-title'>Dettagli Attività</h4>
                </div>
                <div class='modal-body'>
                <label>Descrizione :". $row['aDescri'] ."</label><br>
                <label>Lingua Madre :". $row['linguaMadre'] ."</label><br>
                <label>Lingua Secondaria :". $row['linguaSecondaria'] ."</label><br>
                <label>Itinerario:". $row['itinerario'] ."</label><br>
                  <form action='' method='post'>
                  <input type='hidden' name='idAttivita' value=".$row['codice']."/>
                </div>
                <div class='modal-footer'>";

                $i++;
        }
        ?>
      </tbody>
      </table>
    </div>
    </section>

    <section class="background-gray-lightest">
      <div class="container">
        <h2>Le mie Attività Concluse</h2>
        <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th>Tipo Attività</th>
          <th>Città appuntamento</th>
          <th>Luogo appuntamento</th>
          <th>Data appuntamento</th>
          <th>Ora appuntamento</th>
          <th>Stato</th>
          <th>Feedback</th>
        </tr>
      </thead>
        <?php
        $id=$_SESSION["user"][ID_UTENTE];
        $sql2="SELECT nome,cognome,luogo,data,ora,citta,stato,itinerario,tipoAttivita.descrizione as tDescri,attivita.codAttivita as codice
              from (((attivita inner join tipoAttivita
              ON tipoAttivita.codTipo=attivita.tipo)
              inner join appuntamento
              ON appuntamento.codAppuntamento=attivita.appuntamento)
              inner join partecipazione
              ON partecipazione.codAttivita=attivita.codAttivita)
              INNER JOIN utenti
              ON utenti.idUtente=attivita.codCicerone
              where partecipazione.codUtente=$id
              AND CURDATE()>data";

        $data2=$db->query($sql2)->fetchAll();
        $i=0;
        echo "<tbody>";
        foreach($data2 as $row2){
          echo "<tr>";
          echo "<th>" .$row2["tDescri"]. "</th>";
          echo "<th>" .$row2[CITTA]. "</th>";
          echo "<th>" .$row2[LUOGO]. "</th>";
          echo "<th>" .$row2["data"]. "</th>";
          echo "<th>" .$row2["ora"]. "</th>";
          echo "<th>" .convertStato($row2["stato"]). "</th>";
          if($row2["stato"]==1){
            if(checkFeedback($row2['codice'],$_SESSION['user']['idUtente'])==1){
                echo "
                <form action='feedback.php'  method='POST'>
                <input type='hidden' name='codUtente' value=".$_SESSION['user'][ID_UTENTE]."/>
                <input type='hidden' name='idAttivita' value=".$row2['codice']."/>
                <th><button type='submit' class='btn btn-warning btn-sm' name='gofeedback'><span class='fa fa-star'></span></button></th>
                </form>";
            }else {
                echo"<th>VOTATO</th>";
              }
          }
          echo "</tr>";
          $i++;
          }
        ?>
      </tbody>
      </table>
    </div>
    </section>

      </body>

<?php include("footerUser.php");?>

</html>
