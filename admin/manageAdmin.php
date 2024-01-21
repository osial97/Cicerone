<?php
require_once("../conn/auth.php");
require_once("../conn/config.php");
include("../php/myFunction.php");
?>

<html>
<head>
<title>Cicerone - Gestisci Attività</title>
<?php
include("headerAdmin.php");
if(isset($_POST['manage'])) {$id=$_POST["manage"];}
else {$id=$_GET["codice"];}
?>
</head>

  <body>
    <section class="background-gray-lightest">
      <div class="container">
        <h2>Gestione Partecipazioni</h2>
        <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
        <tr>
          <th>Nome</th>
          <th>Cognome</th>
          <th>Email</th>
          <th>Stato</th>
        </tr>
      </thead>

        <?php
        $sql="SELECT codPartecipazione, nome, cognome, email, partecipazione.stato as stato
              from (attivita inner join partecipazione
              ON attivita.codAttivita=partecipazione.codAttivita)
              inner join utenti
              ON utenti.idUtente=partecipazione.codUtente
              where partecipazione.codAttivita=$id AND stato!=2 ";

        $data=$db->query($sql)->fetchAll();
        foreach($data as $row){
              echo'<tbody><tr>
              <th>'.$row["nome"].'</th>
              <th>'.$row["cognome"].'</th>
              <th>'.$row["email"].'</th>
              <th>'.convertStato($row["stato"]).'</th>';
              if($row['stato']==0){
              echo "<td><form action='../php/manageRequest.php' method='post'>";
              echo   "<button type='submit' class='btn btn-danger btn-sm' value='$row[codPartecipazione]'  name='refuse'>";
              echo   "<span class='fa fa-remove'></span></button>";
              echo   "<button type='submit'  class='btn btn-success btn-sm' value='$row[codPartecipazione]'  name='accept'>";
              echo   "<span class='fa fa-check'></span></button>";
              echo   "<input type='hidden' value='$id' name='id'></form></td></tr>";}
        }

        ?>
      </tbody>
      </table>
    </div>
    </section>
      </body>

<?php include("footerAdmin.php");?>

</html>
