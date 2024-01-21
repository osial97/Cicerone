


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="all,follow">
<!-- Bootstrap CSS-->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Font Awesome & Pixeden Icon Stroke icon font-->
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/pe-icon-7-stroke.css">
<!-- Google fonts - Roboto Condensed & Roboto-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed:700|Roboto:300,400">
<!-- lightbox-->
<link rel="stylesheet" href="css/lightbox.min.css">
<!-- theme stylesheet-->
<link rel="stylesheet" href="css/style.blue.css" id="theme-stylesheet">
<!-- Custom stylesheet - for your changes-->
<link rel="stylesheet" href="css/custom.css">
<!--My Style css -->
<link rel="stylesheet" href="css/alert.css">
<!-- Favicon-->
<link rel="shortcut icon" href="favicon.png">
<!-- Tweaks for older IEs--><!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
<!-- navbar-->
<header class="header">
  <div role="navigation" class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header"><a href="index.php" class="navbar-brand">Cicerone.</a>
        <div class="navbar-buttons">
          <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle navbar-btn">Menu<em class="fa fa-align-justify"></em></button>
        </div>
      </div>
      <div id="navigation" class="collapse navbar-collapse navbar-right">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="contact.php">Contatti</a></li>
          <li><a href='#' data-toggle='modal' data-target='#login-modal'><em class='fa fa-sign-in'></em>Log in</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>

<!-- *** LOGIN MODAL ***_________________________________________________________
-->

<div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true" class="modal fade">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="close">×</button>
        <h4 id="Login" class="modal-title">Log in</h4>
      </div>
      <div class="modal-body">
        <form action="./conn/login.php" method="post">
          <div class="form-group">
            <input id="email_modal" type="text" placeholder="email"  name="email" class="form-control">
          </div>
          <div class="form-group">
            <input id="password_modal" type="password" placeholder="password" name="password"  class="form-control">
          </div>
          <p class="text-center">
            <input type="submit" class="btn btn-success btn-block" name="login" value="Login" />
          </p>
        </form>
        <p class="text-center text-muted">Non sei ancora registrato?</p>
        <p class="text-center text-muted"><a href="register.php"><strong>Registrati!</strong></a><br>È facile e in un minuto avrai il tuo accesso speciale!</p>
      </div>
    </div>
  </div>
</div>

<!-- *** LOGIN MODAL END ***-->
</head>
