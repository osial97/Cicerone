<html>

<?php
//session_start();
if(isset($_SESSION["user"])) {
  header("Location: user/profile.php");
  exit();
}


?>
<head>
<title>Cicerone - La guida che fa per te</title>
<?php include("header.php");?>
</head>
<div id="carousel-home" data-ride="carousel" class="carousel slide carousel-fullscreen carousel-fade">
  <div role="listbox" class="carousel-inner">
    <div style="background-image: url('img/img1.jpg');" class="item active">
      <div class="overlay"></div>
      <div class="carousel-caption">
        <h1 class="super-heading">Cicerone</h1>
        <p class="super-paragraph">La guida che fa per te</p>
      </div>
    </div>
  </div>
</div>

<!--   *** SERVICES GLOBETROTTER ***-->
<section class="background-gray-lightest">
  <div class="container clearfix">
    <div class="row services">
      <div class="col-md-12">
        <h2>Servizi per Globetrotter</h2>
        <p class="lead margin-bottom--medium">Cicerone offre la possibilità di vivere un'esperienza di viaggio poco standardizzata e scarsamente conformista.</p>
        <div class="row">
          <div class="col-sm-4">
            <div class="box box-services">
              <div class="icon"><em class="pe-7s-news-paper" ></em></div>
              <h4 class="services-heading">Attività</h4>
              <p>Potrai partecipare a qualsiasi attività di tuo piacimento</p>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="box box-services">
              <div class="icon"><em class="pe-7s-coffee"></em></div>
              <h4 class="services-heading">Incontri</h4>
              <p>Incontrerai e conoscerai nuove persone e culture.</p>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="box box-services">
              <div class="icon"><em class="pe-7s-piggy"></em></div>
              <h4 class="services-heading">Risparmia</h4>
              <p>Potrai organizzare e pianificare il tuo viaggio. </p>
            </div>
          </div>
        </div>
              <!--   *** SERVICES GLOBETROTTER END ***-->
              <!--   *** SERVICES CICERONE ***-->
              <h2>Servizi per Cicerone</h2>
              <p class="lead margin-bottom--medium">Con Cicerone hai la possibilità di iscriverti come Cicerone ovvero una vera e propria guida turistica.</p>
            <div class="row">
              <div class="col-sm-4">
                <div class="box box-services">
                  <div class="icon"><em class="pe-7s-map-2"></em></div>
                  <h4 class="services-heading">Organizza</h4>
                  <p>Gestisci attività organizzandole a tuo piacimento.</p>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="box box-services">
                  <div class="icon"><em class="pe-7s-cash"></em></div>
                  <h4 class="services-heading">Guadagna</h4>
                  <p>Potrai a tuo modo guadagnare sia in denaro che di esperienza.</p>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="box box-services">
                  <div class="icon"><em class="pe-7s-flag"></em></div>
                  <h4 class="services-heading">Guida</h4>
                  <p>Sarai tu a scegliere l'itinerario e a guidare i tuoi Globetrotters. </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--   *** SERVICES CICERONE END ***-->
</body>

<?php include("footer.php")?>
  </body>
</html>
