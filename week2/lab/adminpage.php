<?php
require_once './autoload.php';

if(!isset($_SESSION['user_id']))
{
    header('Location:login-form.html.php');
}


$logout = filter_input(INPUT_GET, 'logout');

if ($logout == true) {
    $_SESSION['user_id'] = null;
}

if (!isset($_SESSION['user_id'])) {
    header('Location:index.php');
}

else if (isset($_SESSION['user_id'])) {
    echo '<H2><a href="?logout=true" >Log Out</a></H2>';
}
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Administrator Page</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
