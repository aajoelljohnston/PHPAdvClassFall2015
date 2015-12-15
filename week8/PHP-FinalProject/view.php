<?php require_once './autoload.php';?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <style>
            .meme {
                width: 300px; 
                border: 1px solid silver;
                padding: 0.5em;
                text-align: center;
                margin: 0.5em;
                vertical-align: middle;
            }



        </style>
    </head>
    <body>
        <p><a href=".">Home</a></p>
        <p><a href="addfile.php">Upload Image</a></p>
        <?php
        if ((!isset($_SESSION['user_id'])) || ($_SESSION['user_id'] == null)) {
            
            $files = array();
            $directory = '.' . DIRECTORY_SEPARATOR . 'uploads';
            $dir = new DirectoryIterator($directory);
            foreach ($dir as $fileInfo) {
                if ($fileInfo->isFile()) {
                    $files[$fileInfo->getMTime()] = $fileInfo->getPathname();
                }
            }

            krsort($files);

            foreach ($files as $key => $path):
                ?>  
                <div class="meme"> 
                    <img src="<?php echo $path; ?>" /> <br />
                    <?php echo date("l F j, Y, g:i a", $key); ?>
                    <!-- Place this tag where you want the share button to render. -->
                    <div class="g-plus" data-action="share" data-href="<?php echo $path; ?>"></div>
                    <input type="submit" name="delete" value="Delete" />
                </div>
            <?php
            endforeach;
        }
        else {
             $util = new Util();
             $users_images = new Users_Images();
             $userimages = $users_images->showUsersImages($_SESSION['user_id']);
             
        }
        ?>
        
        <?php foreach ($userimages as $row): ?>
        <img src="./uploads/<?php echo $row['filename']; ?>" />
        <?php endforeach; ?>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>

    </body>
</html>