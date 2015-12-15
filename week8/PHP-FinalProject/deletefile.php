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
        <p><a href="addfile.php">Upload Image</a></p>
        <p><a href="index.php">View All Images</a></p>
        
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
if (!isset($_SESSION['user_id'])) {
    header('Location:login.php');
}
?>

<?php
    $util = new Util();
    $users_images = new Users_Images();
    $userimages = $users_images->showUsersImages($_SESSION['user_id']);
?>
        
<?php
$util = new Util();
if ($util->isPostRequest()) {
$filename = filter_input(INPUT_POST, 'filename');
$deleteFromFolder = new Delete();
$deleteFromFolder->deleteFile($filename);
$deleteFromDB = new Delete();
$deleteFromDB->deleteUserPhotos($filename);
}
?>
        
    <?php foreach ($userimages as $row): ?>
        
        <div class="meme">;
            <img src="./uploads/<?php echo $row['filename']; ?>" /> <br />
            <?php echo date("l F j, Y, g:i a"); ?>
            <!-- Place this tag where you want the share button to render. -->
            <div class="g-plus" data-action="share" data-href="<?php echo $row; ?>"></div>
            <div class="fb-share-button" data-href="' . $path . '" data-layout="button_count"></div> <br /><br />
            <form action="#" method="POST">
                <input class="btn" type="submit" value="Delete" />
                <input type="hidden" value="' . $row['filename'] . '" name="filename"/>
                </form>
        </div>;
                
    <?php endforeach; ?>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    
    </body>
</html>