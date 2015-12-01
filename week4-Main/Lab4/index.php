<?php require_once './autoload.php'; ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <title></title>
    </head>
    <body>
        <!--put in some formatting -->
        <nav class="">
            <div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="View.php">View Files</a></li> 
                </ul>
            </div>
        </nav>
        <form enctype="multipart/form-data" action="#" method="POST">
            
            Send this file: <input name="upfile" type="file" />
            <input type="submit" value="Save File" />              
        </form>
        <?php
        // Util Class New Instance        
        $util = new Util();

        // Check to see if there is a POST request on the page from the Util Class 
        if ($util->isPostRequest()) {
            try {
                $upfile = 'upfile';
                $file_upload = new File_upload();
                $file_upload->addFile($upfile); 
            } catch (RuntimeException $e) {
                echo $e->getMessage();
            }
        }
        ?>
    </body>
</html>
