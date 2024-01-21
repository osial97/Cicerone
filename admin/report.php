<?php
require_once("../user/costant.php");
require_once("../conn/auth.php");
require_once("../conn/config.php");
?>

<html>
<head>
<title>Cicerone -Administration Reports</title>
<?php include("headerAdmin.php");?>
</head>
  <body>

    <section class="background-gray-lightest">
      <div class="container">
        <h2>Segnalazioni</h2>
        <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th>ID Segnalazione</th>
          <th>ID Utente</th>
          <th>Data</th>
          <th>Oggetto</th>
          <th>Messaggio</th>
          <th>Stato</th>
          <th>CHIUDI</th>
        </tr>
      </thead>
        <?php
        $sql="SELECT * FROM segnalazioni";
        $data=$db->query($sql)->fetchAll();
        foreach($data as $row){
          echo "<tbody><tr>";
          echo "<th>" .$row["idSegnalazione"]. "</th>";
          echo "<th>" .$row["idUtente"]. "</th>";
          echo "<th>" .$row["dataInvio"]. "</th>";
          echo "<th>" .$row["oggetto"]. "</th>";
          echo "<th>" .$row["messaggio"]. "</th>";
          echo "<th>" .$row["stato"]. "</th>";
          echo "<form action='../php/closeReport.php' method='post'>";
          echo   "<th><button type='submit' class='btn btn-danger btn-sm' value=".$row['idSegnalazione']."  name='close'>";
          echo     "<span class='fa fa-calendar-check-o'></span></button></form></th>";
          echo   "</tr>";
        }
        ?>

      </tbody>
      </table>
    </div>
  </div>
</section>

<?php include("footerAdmin.php");?>
</body>
</html>
