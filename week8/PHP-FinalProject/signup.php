<?php require_once './autoload.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Photo Sign Up</title>
        <!--Links in header allow bootstrap for styling  -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        $util = new Util();
        $validtor = new Validator();
        $signup = new Signup();

        $errors = array();

        if ($util->isPostRequest()) {

            if ($validtor->emailIsEmpty($email)) {
                $errors[] = 'Email is required';
            }

            if (!$validtor->emailIsValid($email)) {
                $errors[] = 'Email is not valid';
            }
            if ($validtor->passwordIsEmpty($password)) {
                $errors[] = 'Password is required';
            }
            if ($signup->doesEmailExist($email)) {
                $errors[] = 'Email already exisits';
            }
            /** if $errors are less than or equal to 0 is TRUE a signup completed
             * message id displayed.
             * else a sign
             */
            if (count($errors) <= 0) {

                if ($signup->save($email, $password)) {
                    $message = 'Signup complete';
                } else {
                    $errors = 'Signup failed';
                }
            }
        }
        ?>        
        
        <?php include './templates/sign_up-form.php'; ?>
        <?php include './templates/messages.html.php'; ?>
        <?php include './templates/errors.html.php'; ?> 

        <a href="index.php">Login</a>

    </body>
</html>


