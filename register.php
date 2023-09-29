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
 
 <title>Rejestracja</title>
</head>
<body>
 <div class="container">
  <h1>Rejestracja</h1>
  <form action="" method="post">
   <div class="form-group">
    <p><label for="username">Nazwa użytkownika</label><input type="text" name="username" id="username" class="form-control" placeholder="Nazwa użytkownika" required /></p>
   </div>
   <div class="form-group">
    <p><label for="email">E-mail</label><input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required /></p>
   </div>
   <div class="form-group">
    <p><label for="password">Hasło</label><input type="password" name="password" id="password" class="form-control" placeholder="Hasło" required /></p>
   </div>
   <div class="form-group">
    <p><label for="repeated_password">Powtórz hasło</label><input type="password" name="repeated_password" id="repeated_password" class="form-control" placeholder="Powtórz hasło" required /></p>
   </div>
   <p><input type="submit" class="btn btn-primary" value="Zarejestruj" /></p>
  </form>
 </div>
</body>
</html>

<?php else: ?>

<?php

if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {

 $username = preg_replace('/[^\p{L}\p{N}]/iu', '', $_POST['username']);
 $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
 $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
 $ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
 
 if(strlen($_POST['username']) >= 3) {
 
  if(strlen($_POST['username']) <= 30) {
  
   if(strlen($_POST['email']) >= 6) {
   
    if(strlen($_POST['email']) <= 30) {
    
     if(strlen($_POST['password']) >= 6) {
     
      if(strlen($_POST['password']) <= 16) {
      
       if(hash_equals($_POST['password'], $_POST['repeated_password'])) {
       
        require 'set-db-connection.php';
        require 'class.user.php';
        
        $user = new User($dbh);
        
        if(!$user->user_exist($username, $email)) {
        
         if($user->insert_user($username, $email, $password, $ip)) {
         
          echo '<p>Konto zostało założone.</p>';
          
         }
         
         else {
         
          echo '<p>Nie udało się zarejestrować.</p>';
          
         }
         
        }
        
        else {
        
         echo '<p>Taki użytkownik już istnieje.</p>';
         
        }
        
       }
       
       else {
       
        echo '<p>Hasła się nie zgadzają.</p>';
        
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
    
     echo '<p>E-mail jest zbyt długi.</p>';
     
    }
    
   }
   
   else {
   
    echo '<p>E-mail jest zbyt krótki.</p>';
    
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

 echo '<p>Wypełnij wszystkie pola, aby się zarejestrować.</p>';
 
}

?>

<?php endif; ?>
