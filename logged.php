<?php

/*
* Autor: https://programistyczny.blogspot.com
*/



 session_start();
 
 if(!isset($_SESSION['logged'])) {
 
  header('Location: login.php');
  
  exit;
  
 }
 
?>

<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  
  <title>Zalogowany</title>
  
 </head>
 <body>
  <div>
  <?php
  
  if(isset($_SESSION['logged'])):
  
  ?>
  
  <p>Jesteś zalogowany jako <strong><?= $_SESSION['username']; ?></strong>.</p>
  <p><a href="logout.php">Wyloguj się</a></p>
  
  <?php endif; ?>
  </div>
 </body>
</html>
