<?php
session_start();
require_once("config.php");
if(isset($_POST['login'])){

      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

      $sql = "SELECT * FROM utenti WHERE email=:email";
      $stmt = $db->prepare($sql);

      // bind parameter
      $params = array(
          ":email" => $email
      );

      $stmt->execute($params);

      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if($user){


          // verifica password
          if(password_verify($password, $user['password'])){


              $_SESSION["user"] = $user;
              if($user['guida']==2){
                header("Location: ../admin/adminView.php");
              }else{
              header("Location: ../user/profile.php");
            }
          }else {
            echo '
              <div class="alert-danger">
              <span class="closebtn" onclick="this.parentElement.style.display='; echo"'none'"; echo';">&times;</span>
              <strong><center>Password o EMail Errata!</center></strong> </div>
              <meta http-equiv="refresh" content="2.00; ../index.php" />';
          }
      }else{echo '
      <div class="alert-danger">
      <span class="closebtn" onclick="this.parentElement.style.display='; echo"'none'"; echo';">&times;</span>
      <strong><center>Password o EMail Errata!</center></strong> </div>
      <meta http-equiv="refresh" content="3.00; ../index.php" />';}
  }else{
    echo '
      <div class="alert-danger">
      <span class="closebtn" onclick="this.parentElement.style.display='; echo"'none'"; echo';">&times;</span>
      <strong><center>Password o EMail Errata!</center></strong> </div>
      <meta http-equiv="refresh" content="3.00; ../index.php" />';
  }
?>
