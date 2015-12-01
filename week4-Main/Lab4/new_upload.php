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
        <!-- -->
        <title></title>
    </head>
    <body>
        <?php
        try {

            // Check File Size 
            if ($_FILES['upfile']['size'] > 1000000) {
                throw new RuntimeException('Exceeded filesize limit.');
            }
            // Check mime Type
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $validExts = array(
                'html' => 'text/html',
                'pdf' => 'application/pdf',
                'doc' => 'application/msword',
                'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'xls' => 'application/vnd.ms-excel',
                'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'jpg' => 'image/jpeg',
                'png' => 'image/png',
                'gif' => 'image/gif'
            );
            $ext = array_search($finfo->file($_FILES['upfile']['tmp_name']), $validExts, true);


            if (false === $ext) {
                throw new RuntimeException('Invalid file format.');
            }
           
            
            // Give files unique names

            $fileName = sha1_file($_FILES['upfile']['tmp_name']);
            $location = sprintf('./pic_upload/%s.%s', $fileName, $ext);

            // is_dir — Lets you know if the name of the file is in the directory
            if (!is_dir('./pic_upload')) {

                //mkdir — Makes a new directory
                mkdir('./pic_upload');
            }

            if (!move_uploaded_file($_FILES['upfile']['tmp_name'], $location)) {
                throw new RuntimeException('Moving uploaded file Failed.');
            }


            echo 'File has been uploaded successfully.';
        } catch (RuntimeException $e) {
            echo $e->getMessage();
        }
        ?>
    </body>
</html>
