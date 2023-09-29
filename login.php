<?php

/*
* Autor: https://programistyczny.blogspot.com
*/



 ini_set('display_errors', '1');
 
 error_reporting(E_ALL);
 
 if(!isset($_POST['username'])):
 
?>

<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.css" type="text/css" media="screen" />
  
  <title>Logowanie</title>
 </head>
 <body>
  <div class="container">
   <h1>Zaloguj się</h1>
   <form action="" method="post">
    <div class="form-group">
     <p><label for="username">Nazwa użytkownika</label><input type="text" name="username" id="username" class="form-control" placeholder="Nazwa użytkownika" required /></p>
    </div>
    <div class="form-group">
     <p><label for="password">Hasło</label><input type="password" name="password" id="password" class="form-control" placeholder="Hasło" required /></p>
    </div>
    <p><input type="submit" class="btn btn-primary" value="Zaloguj" /></p>
   </form>
  </div>
 </body>
</html>

<?php else: ?>

<?php

 if(!empty($_POST['username']) && !empty($_POST['password'])) {
 
  if(strlen($_POST['username']) >= 3) {
  
   if(strlen($_POST['username']) <= 30) {
   
    if(strlen($_POST['password']) >= 6) {
    
     if(strlen($_POST['password']) <= 16) {
     
      require 'set-db-connection.php';
      require 'class.user.php';
      
      $username = preg_replace('/[^\p{L}\p{N}]/iu', '', $_POST['username']);
      
      $user = new User($dbh);
      
      if($user->login($username, $_POST['password'])) {
      
       session_start();
       
       $_SESSION['logged'] = 1;
       $_SESSION['username'] = $username;
       
       header('Location: logged.php');
       
       exit;
       
      }
      
      else {
      
       echo '<p>Błędne dane logowania.</p>';
       
      }
      
     }
     
     else {
     
      echo '<p>Hasło jest zbyt długie.</p>';
      
     }
     
    }
    
    else {
    
     echo '<p>Hasło jest zbyt krótkie.</p>';
     
    }
    
   }
   
   else {
   
    echo '<p>Nazwa użytkownika jest zbyt długa.</p>';
    
   }
   
  }
  
  else {
  
   echo '<p>Nazwa użytkownika jest zbyt krótka.</p>';
   
  }
  
 }
 
 else {
 
  echo '<p>Wypełnij wszystkie pola, aby się zalogować.</p>';
  
 }
 
?>

<?php endif; ?>
