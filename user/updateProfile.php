<?php
require_once("costant.php");
require("../conn/auth.php");
require_once("../conn/config.php");
include("../php/myFunction.php");
  if(isset($_POST['cambia_dati'])){
    if(checkActivitiesEnded($_SESSION["user"]["idUtente"])==1){
      $nome = $_POST['nome'];
      $cognome = filter_input(INPUT_POST, COGNOME, FILTER_SANITIZE_STRING);
      $sesso = $_POST["sesso"];
      $email = filter_input(INPUT_POST, EMAIL, FILTER_VALIDATE_EMAIL);
      $dataNascita = filter_input(INPUT_POST, DATA_NASCITA, FILTER_SANITIZE_STRING);
      $indirizzo= filter_input(INPUT_POST, INDIRIZZO, FILTER_SANITIZE_STRING);
      $guida = $_POST["guida1"];
      $idUtente=$_SESSION["user"]["idUtente"];
      $sql = "UPDATE utenti SET nome=:nome, cognome=:cognome, sesso=:sesso, email=:email, dataNascita=:dataNascita, indirizzo=:indirizzo, guida=:guida WHERE idUtente=:idUtente";
      $stmt = $db->prepare($sql);

      $params = array(
          ":nome" => $nome,
          ":cognome" => $cognome,
          ":sesso" => $sesso,
          ":email" => $email,
          ":dataNascita" => $dataNascita,
          ":indirizzo" => $indirizzo,
          ":guida" => $guida,
          ":idUtente"=>$idUtente
      );

      $update = $stmt->execute($params);
        if($update) {
          $sql2 = "SELECT * FROM utenti WHERE idUtente=:idUtente";
          $stmt1 = $db->prepare($sql2);

          // bind parameter ke query
          $params = array(
              ":idUtente"=>$idUtente
          );
          $stmt1->execute($params);
          $user = $stmt1->fetch(PDO::FETCH_ASSOC);
          if($user) {

            $_SESSION["user"]=$user;
          }
          header("Location: profile.php");
        }
      }else{ echo'<div class="alert-danger">
      <span class="closebtn" onclick="this.parentElement.style.display='; echo "'none'"; echo';">&times;</span>
      <strong><center>Per passare a Globetrotter devi concludere le attivita!</center></strong> </div>';
    }
      }

?>

<html>
<head>
<title>modifica Profilo</title>
<?php include("headerUser.php"); ?>
</head>
  <body>
    <section class="background-gray-lightest">
      <div class="container">
        <h1>Modifica Profilo</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input class="form-control" type="text" name="nome" placeholder="<?php echo  $_SESSION["user"]["nome"]?>" value="<?php echo  $_SESSION["user"]["nome"]?>" />
            </div>

            <div class="form-group">
                <label for="cognome">Cognome</label>
                <input class="form-control" type="text" name="cognome" placeholder="<?php echo  $_SESSION["user"]["cognome"]?>" value="<?php echo  $_SESSION["user"]["cognome"]?>" />
            </div>
            <div class="form-group">
                <label for="sesso">Sesso</label>
                <select name="sesso" class="form-control">
                  <?php
                  if($_SESSION["user"]["sesso"]=='M') {
                  echo '<option  value="M">Maschio</option>
                        <option  value="F">Femmina</option>';
                  } else {echo '<option  value="F">Femmina</option>
                                <option  value="M">Maschio</option>';
                    }
                  ?>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" placeholder="<?php echo $_SESSION["user"]["email"]?>" value="<?php echo $_SESSION["user"]["email"]?>" />
            </div>

            <div class="form-group">
                <label for="dataNascita">Data di nascita</label>
                <input class="form-control" type="date" name="dataNascita" placeholder="<?php echo  $_SESSION["user"]["dataNascita"]?>"  value="<?php echo  $_SESSION["user"]["dataNascita"]?>"/>
            </div>

            <div class="form-group">
                <label for="indirizzo">Indirizzo</label>
                <input class="form-control" type="indirizzo" name="indirizzo" placeholder="<?php echo  $_SESSION["user"]["indirizzo"]?>" value="<?php echo  $_SESSION["user"]["indirizzo"]?>"/>
            </div>


            <div class="form-group">
                <label for="guida">Vuoi essere abilitato come Cicerone</label>
                <select  name="guida1" class="form-control">
                  <option value=0>No</option>
                  <option  value=1>Si</option>
                </select>
            </div>
            <input type="submit" class="btn btn-success btn-block" name="cambia_dati" value="cambia dati" />

        </form>
      </div>
    </section>


<?php include("footerUser.php"); ?>
  </body>
</html>
