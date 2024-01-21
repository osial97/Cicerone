<html>
<head>
<title>Cicerone - Registrazione</title>
</head>
<?php
include("header.php");
?>
<body>
    <section class="background-gray-lightest">
      <div class="container">
        <div class="breadcrumbs">
          <ul class="breadcrumb">
            <li><a href="index.php">Home</a></li>
            <li>Registrati</li>
          </ul>
        </div>
        <h1>Registrati</h1>
        <form action="php/registration.php" method="POST">

            <div class="form-group">
                <label for="nome">Nome</label>
                <input class="form-control" type="text" name="nome" placeholder="Nome" />
            </div>

            <div class="form-group">
                <label for="cognome">Cognome</label>
                <input class="form-control" type="text" name="cognome" placeholder="Cognome" />
            </div>
            <div class="form-group">
                <label for="sesso">Sesso  </label>
                <select name="sesso" class="form-control">
                  <option  value="M">Maschio</option>
                  <option  value="F">Femmina</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" placeholder="Email" />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control" type="password" name="password" placeholder="Password" />
            </div>

            <div class="form-group">
                <label for="dataNascita">Data di nascita</label>
                <input class="form-control" type="date" name="dataNascita" placeholder="data di nascita" />
            </div>

            <div class="form-group">
                <label for="indirizzo">Indirizzo</label>
                <input class="form-control" type="indirizzo" name="indirizzo" placeholder="Indirizzo" />
            </div>

            <div class="form-group">
                <label for="guida">Vuoi essere abilitato ad effettuare servizi di Cicerone?  </label>
                <select  name="guida" class="form-control">
                  <option value=0>No</option>
                  <option  value=1>Si</option>
                </select>
            </div>

            <input type="submit" class="btn btn-success btn-block" name="register" value="Registrati" />

        </form>
      </div>
    </section>
    <?php include("footer.php")?>
  </body>
</html>
