<?php
require_once("../conn/auth.php");
require_once("../conn/config.php");
include("../php/myFunction.php");


if(isset($_POST['gofeedback'])){
  $codUtente=$_POST["codUtente"];
  $idAttivita=$_POST["idAttivita"];
}else{
  header("location: profile.php");
}
?>
<html>
    <?php include("headerUser.php"); ?>
   <body>
    <section class="background-gray-lightest">
      <div class="container">
        <h2>Feedback</h2>
        <div class="table-responsive">
        <table class="table table-bordered">
        <thead>

      </thead>

        <?php

                    echo'<tbody><tr>
                    <th><form action="../php/sendFeedback.php"  method="POST">
                      <div class="stars" data-rating="0">

                      <span class="star" name="rating">&nbsp;</span>
                  		<span class="star" name="rating">&nbsp;</span>
                  		<span class="star" name="rating">&nbsp;</span>
                  		<span class="star" name="rating">&nbsp;</span>
                  		<span class="star" name="rating">&nbsp;</span>
                      <input type="hidden" name="link" class="link" value="0">
                      <input type="hidden" name="codUtente" value="'.$codUtente.'">
                      <input type="hidden" name="idAttivita" value="'.$idAttivita.'">
                      </div>


                  		<p><input type="submit" name="rileva" value="conferma"></p>

                  	</form></th>';
?>

                    <script>

                        //initial setup
                        document.addEventListener('DOMContentLoaded', function(){
                            let stars = document.querySelectorAll('.star');
                            stars.forEach(function(star){
                                star.addEventListener('click', setRating);
                            });

                            let rating = parseInt(document.querySelector('.stars').getAttribute('data-rating'));
                            let target = stars[rating - 1];
                            target.dispatchEvent(new MouseEvent('click'));
                        });

                        function setRating(ev){
                            let span = ev.currentTarget;
                            let stars = document.querySelectorAll('.star');
                            let match = false;
                            let num = 0;
                            stars.forEach(function(star, index){
                                if(match){
                                    star.classList.remove('rated');
                                }else{
                                    star.classList.add('rated');
                                }

                                if(star === span){
                                    match = true;
                                    num = index + 1;
                                }
                            });
                            document.querySelector('.stars').setAttribute('data-rating', num);
                            document.querySelector('.link').setAttribute('value', num);


                        }

                    </script>

            </tbody>
            </table>
          </div>
          </section>
            </body>

      <?php include("footerUser.php");?>

      </html>
