<?php
require_once("../user/costant.php");
require_once("../conn/auth.php");
require_once("../conn/config.php");
require_once("../php/myFunction.php");
?>

<html>
<head>
<title>Cicerone -Administration</title>
<?php include("headerAdmin.php");?>
</head>
  <body>

    <section class="background-gray-lightest">
      <div class="container">
        <h2>Attività in progresso</h2>
        <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th>Tipo Attività</th>
          <th>Itinerario</th>
          <th>Costo</th>
          <th>Numero massimo partecipanti</th>
          <th>Partecipanti</th>
          <th>Data fine prenotazione</th>
          <th>Città appuntamento</th>
          <th>Luogo appuntamento</th>
          <th>Data appuntamento</th>
          <th>Ora appuntamento</th>
        </tr>
      </thead>
        <?php
        $sql="SELECT costo,linguaMadre,linguaSecondaria,luogo,data,ora,dataFinePrenotazione,
              itinerario,numMaxPartecipanti,codAttivita,citta,partecipanti,
              tipoAttivita.descrizione as tDescri,
              attivita.descrizione as aDescri
              from (attivita inner join tipoAttivita
              ON tipoAttivita.codTipo=attivita.tipo)
              inner join appuntamento
              ON appuntamento.codAppuntamento=attivita.appuntamento
              where CURDATE() <= data";
        $data=$db->query($sql)->fetchAll();
        foreach($data as $row){
          echo "<tbody><tr>";
          echo "<th>" .$row["tDescri"]. "</th>";
          echo "<th>" .$row["itinerario"]. "</th>";
          echo "<th>" .$row["costo"]. "</th>";
          echo "<th>" .$row["numMaxPartecipanti"]. "</th>";
          echo "<th>" .$row["partecipanti"]. "</th>";
          echo "<th>" .$row["dataFinePrenotazione"]. "</th>";
          echo "<th>" .$row["citta"]. "</th>";
          echo "<th>" .$row["luogo"]. "</th>";
          echo "<th>" .$row["data"]. "</th>";
          echo "<th>" .$row["ora"]. "</th>";
          echo "<form action='../php/drop.php' method='post'>";
          echo   "<th><button type='submit' class='btn btn-danger btn-sm' value=".$row[COD_ATTIVITA]."  name='drop'>";
          echo     "<span class='fa fa-remove'></span></button></form></th>";
          echo   "<form action='modifyActivityAdmin.php' method='post'>";
          echo   "<th><button type='submit'  class='btn btn-warning btn-sm' value=".$row[COD_ATTIVITA]."  name='modify'>";
          echo     "<span class='fa fa-pencil'></span></button></form></th>";
          echo     "<form action='manageAdmin.php' method='post'>";
          echo     "<th><button type='submit'  class='btn btn-info btn-sm' value=".$row[COD_ATTIVITA]."  name='manage'>";
          echo     "<span class='fa fa-user'></span></button></form></th>";
          echo   "</tr>";
        }
        ?>

      </tbody>
      </table>
    </div>



    <div class="container">
      <h2>Storico Attività</h2>
      <div class="table-responsive">
      <table class="table table-bordered">
      <thead>
      <tr>
        <th>Tipo Attività</th>
        <th>Itinerario</th>
        <th>Costo</th>
        <th>Numero massimo partecipanti</th>
        <th>Partecipanti</th>
        <th>Data fine prenotazione</th>
        <th>Città appuntamento</th>
        <th>Luogo appuntamento</th>
        <th>Data appuntamento</th>
        <th>Ora appuntamento</th>
        <th>Voto</th>
      </tr>
    </thead>
      <?php
      $id=$_SESSION["user"]["idUtente"];
      $sql="SELECT costo,linguaMadre,linguaSecondaria,luogo,data,ora,dataFinePrenotazione,
            itinerario,numMaxPartecipanti,codAttivita,citta,partecipanti,
            tipoAttivita.descrizione as tDescri,
            attivita.descrizione as aDescri,
            attivita.descrizione as aDescri
            from (attivita inner join tipoAttivita
            ON tipoAttivita.codTipo=attivita.tipo)
            inner join appuntamento
            ON appuntamento.codAppuntamento=attivita.appuntamento
            where CURDATE() > data";
      $data=$db->query($sql)->fetchAll();
      foreach($data as $row){
        echo "<tbody><tr>";
        echo "<th>" .$row["tDescri"]. "</th>";
        echo "<th>" .$row["itinerario"]. "</th>";
        echo "<th>" .$row["costo"]. "</th>";
        echo "<th>" .$row["numMaxPartecipanti"]. "</th>";
        echo "<th>" .$row["partecipanti"]. "</th>";
        echo "<th>" .$row["dataFinePrenotazione"]. "</th>";
        echo "<th>" .$row["citta"]. "</th>";
        echo "<th>" .$row["luogo"]. "</th>";
        echo "<th>" .$row["data"]. "</th>";
        echo "<th>" .$row["ora"]. "</th>";
        echo "<th>". returnVoto($row["codAttivita"]). "</th>";
      }
      ?>

    </tbody>
    </table>
  </div>
</section>

<?php include("footerAdmin.php");?>
</body>
</html>
