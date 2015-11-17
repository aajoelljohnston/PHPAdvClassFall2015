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
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        //$user_id = $login->verify($email, $password);
        $util = new Util();
        $dbc = new DB($util->getDBConfig());
        $validator = new Validator();
        $db = $dbc->getDB();
        $login = new Login();

        $errors = array();

        if ($util->isPostRequest()) {

            if ($validator->emailIsEmpty($email)) {
                $errors[] = 'Email must be filled in';
            }

            if (!$validator->emailIsValid($email)) {
                $errors[] = 'Email must be in the correct format';
            }
            if ($validator->passwordIsEmpty($password)) {
                $errors[] = 'You must enter a password';
            }
            if (!$login->emailDoesnotExist($email)) {
                $errors[] = 'User does not exist please signup';
            }

            if (count($errors) <= 0) {

                $user_id = $login->verify($email, $password);
                if ($user_id > 0) {
                    $_SESSION['user_id'] = $user_id;
                    header('Location:adminpage.php');
                } else {
                    $errors = 'Failed to Login!';
                }
            }
        
        }
            /* if ( $user_id > 0 ) {
              $_SESSION['user_id'] = intval($user_id);

              header('Location: admin.php');
              } */
            ?>

            <h1>Login Form</h1>

    <?php include './templates/login-form.html.php'; ?>
            <?php include './templates/errors.html.php'; ?>
            <?php include './templates/messages.html.php'; ?>

        <a href="signup.php">Sign Up</a>
    </body>
</html>