<?php require_once './autoload.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    </head>
    <body>
        <?php
            
            //Variables for Email and Password are Declared
            $email= filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');
            
            //instance of class created
            $util = new Util();
            $validator = new Validator();
            $signup = new Signup();
            
            //Array of Error Messages
            $errors = array();
            
            if ( $util->isPostRequest() ) {
             
                if ( !$validator->emailIsValid($email) ) {
                    $errors[] = 'Email is not valid';
                }
                if ($validator->emailIsEmpty($email)) {
                    $errors[] = 'Email is required';
                }
                if ($validator->passwordIsEmpty($password)) {
                    $errors[] = 'Password is required';
                }
                if ($signup->doesEmailExist($email)) {
                    $errors[] = 'Email already exisits';
                }
            
                if ( count($errors) <= 0) {
                
                    if ( $signup->save($email,$password) ) {
                        $message = 'Signup complete';
                    } else {
                        $message = 'Signup failed';
                    }
                }
                
                
            }
            
            ?>
        
         <?php include './templates/errors.html.php'; ?>
         <?php include './templates/messages.html.php'; ?>
        <h1>Sign Up Form</h1>
        <?php include './templates/login-form.html.php'; ?>
        
        <a href="index.php">Login</a>
        
    </body>
</html>
