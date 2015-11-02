
<?php session_start() ?>

<?php
if(!isset($_SESSION['loggedin']))
{
    header('Location:login-form.html.php');
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
