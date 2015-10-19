<?php require_once './autoload.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
       
            $util = new Util();           
            
            $login = new Login();
            
            $email= filter_input(INPUT_POST, 'email');
            
            $user_id = $login->verify($email, $password);
            
            if ( $user_id > 0 ) {
                $_SESSION['user_id'] = intval($user_id);
                
                header('Location: admin.php');
            }
        ?>
        
        <h1>Login Form</h1>
        
        <?php include './templates/login-form.html.php'; ?>
        
    </body>
</html>