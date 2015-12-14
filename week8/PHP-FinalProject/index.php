<?php require_once './autoload.php'; ?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!--Links in header allow bootstrap for styling  -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <style type="text/css">
                 #files-img {
                border: 5px dashed #D9D9D9;
                border-radius: 10px;
                padding: 1em 2em;
                text-align: center;

            }
            .over {
                background: #F7F7F7;
            }

            input {
                margin: 0.5em;
                padding: 0.5em;
            }

            #img-file-content img {
                max-width: 100%;
            }
        </style>
    </head>
    <body>
        <?php
        
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        
        //Creates and Instance of the Class
        $util = new Util();
        $dbc = new DB($util->getDBConfig());
        $validtor = new Validator(); //
        $db = $dbc->getDB();
        $login = new Login(); // New Login Class Instance

        $errors = array();

        if ($util->isPostRequest()) {

            if ($validtor->emailIsEmpty($email)) {
                $errors[] = 'Email must be Entered';
            }

            if (!$validtor->emailIsValid($email)) {
                $errors[] = 'Email is not in the Correct Format';
            }
            if ($validtor->passwordIsEmpty($password)) {
                $errors[] = 'Password Must be Entered';
            }
             if (!$login->emailDoesnotExist($email)) {
                $errors[] = 'Email Does not Exist. Please Signup.';
            }
     
            if (count($errors) <= 0) {

                $user_id = $login->verifyCheck($email, $password);
                if ($user_id > 0) {
                    $_SESSION['user_id'] = $user_id;
                    header('Location:addfile.php');
                } else {
                    $errors = 'Login Failed!';
                }
            }
//               
        }
        ?>
        
        <?php include './templates/login-form.html.php'; ?>
        <?php include './templates/messages.html.php'; ?>
        <?php include './templates/errors.html.php'; ?>
        <!--Link to the Sign Up Page-->
          <a href="signup.php">Sign Up</a>

    </body>
</html>
