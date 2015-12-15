<?php require_once './autoload.php';?>
<!DOCTYPE html>
<html>
    <head>
        <h1>AAA Meme Generator</h1>
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
        <p><a href="login.php">Login</a></p>
        <p><a href="addfile.php">Upload Image</a></p>
        <p><a href="deletefile.php">Delete Your Images</a></p>
        
        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        
        <?php
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
                    <div class="g-plus" data-action="share" data-href="' . $path . '"></div>
                    <div class="fb-share-button" data-href="' . $path . '" data-layout="button_count"></div>
                </div>
            <?php endforeach; ?>

        <!-- Place this tag in your head or just before your close body tag. -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>

    </body>
</html>