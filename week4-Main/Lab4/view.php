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
        <title>View</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    </head>
    <body>
        
        <?php
        $util = new Util();

        if ($util->isPostRequest()) {
              $folder = './pic_upload/';
            $delete_file = filter_input(INPUT_POST, 'delete_file');
            try {
                $filename = new Delete_file();
                $filename->f_Delete($delete_file);
            } catch (RuntimeException $e) {               
            }
        }

        //DirSep

        $folder = './pic_upload/';
        $directory = scandir('./pic_upload/');
        //var_dump($directory);
        ?> 
         
        <table class="table "><thead><td>File Name </td> <td> File Size </td><td> File Type </td><td> Delete </td> </thead>
        <?php foreach ($directory as $file) : ?>         
            <?php
            $size = filesize('./pic_upload/' . $file);
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $type = $finfo->file('./pic_upload/' . $file);
            ?>
            <?php if (is_file($folder . DIRECTORY_SEPARATOR . $file)) : ?>
        
                <tr><td> <a href="<?php echo $folder . DIRECTORY_SEPARATOR . $file; ?>"><?php echo $file; ?></a></td>
                   
                    <td>  <?php echo $size; ?></td>                                      
                    <td><?php echo $type; ?>
                    </td>  
                    <td> <form action="#" method="POST">         
                            <input type="submit" class="btn btn-primary" value="Delete"/> 
                            <input type="hidden" value="<?php echo basename($file) ?>" name="delete_file"/>
                            
                             <a href="Index.php">Upload Pictures</a>
                        </form>
                    </td>
                </tr>   
            <?php endif; ?>             
        <?php endforeach; ?>

    </table>     


    </body>
</html>
