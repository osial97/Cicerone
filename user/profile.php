<?php
include("../conn/config.php");
require_once("../conn/auth.php");?>
<html>
<head>
<title>Cicerone- Profilo utente</title>
</head>
<?php
$default=base64_encode(file_get_contents("../img/img1.jpg"));
$query = "SELECT image FROM utenti WHERE idUtente=:idUtente";
$params = array(":idUtente"=>$_SESSION["user"]["idUtente"]);
$stmt = $db->prepare($query);
$update =$stmt->execute($params);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$img = $row['image'];
include("headerUser.php");
?>

<body>
<section class="background-gray-lightest">
  <div class="container">
    <h1>Il mio Profilo</h1>
  </div>
</section>
<div class="container emp-profile">

            <form action="../php/uploadImage.php" method="POST" enctype="multipart/form-data" id="upload_form">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img   src="data:image/jpeg;base64,<?php if($img!=""){ echo $img;}else {echo $default;} ?>" alt="errore" />
                            <div class="file btn btn-lg btn-primary">
                                Cambia foto
                                <input type="file" name="file"/>
                            </div>
                            <input type="submit" style="display: none;">
                          </div>
                        <br>
                        <br>
                      </div>
                </form>
                    <div class="col-md-6">
                        <div class="profile-head">

                            <h5><?php echo $_SESSION["user"]["nome"]," ",$_SESSION["user"]["cognome"];?></h5>
                            <h6><?php if($_SESSION["user"]["guida"]==1) echo"Cicerone";
                                      else echo"Globetrotter";
                                ?></h6>

                           <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane  show active" id="home" role="tabpanel" aria-labelledby="home-tab">



                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Nome</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $_SESSION["user"]["nome"];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Cognome</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $_SESSION["user"]["cognome"]; ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $_SESSION["user"]["email"];?></p>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>data di nascita</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $_SESSION["user"]["dataNascita"];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>indirizzo</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $_SESSION["user"]["indirizzo"];?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>sesso</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php if($_SESSION["user"]["sesso"]=='M') echo"Maschio";
                                                          else echo"Femmina";
                                                    ?></p>
                                            </div>
                                        </div>
                            </div>

                        </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                      <div class="btn-group-vertical">
                        <a href="updateProfile.php"><input type="button" class="btn btn-primary" name="btnAddMore" value="MODIFICA PROFILO"/></a>
                        <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"value="RIMUOVI PROFILO"/>
                      </div>

                            <div id="myModal" class="modal fade in">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                            <div class="modal-header" >
                                                <a class="btn btn-close"  data-dismiss="modal"><span class="fa fa-remove" ></span></a>
                                                    <h4 class="modal-title">Eliminazione profilo</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Sei sicuro di volerti eliminare da Cicerone?<p>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="btn-group">
                                                    <form action="../php/deleteProfile.php" method="POST">
                                                      <button class="btn btn-danger" >
                                                        <input type="submit" name="elimina" id="b-n" class="btn btn-danger" value="elimina">
                                                          <span class="fa fa-ban"></span>
                                                        </input>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                    </div>
                                </div>
                        </div>


                    </div>
                </div>


                </div>
        </div>

<?php
unset($db);
$stm=null;
?>
  </body>
  <footer><?php include("footerUser.php")?></footer>
</html>
<script type="text/javascript">
  document.getElementById("upload_form").onchange = function() {
      // submitting the form
      document.getElementById("upload_form").submit();
  };
</script>
