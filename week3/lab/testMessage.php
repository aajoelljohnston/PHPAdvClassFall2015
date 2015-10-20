<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        
        <div class="text-primary">
        <?php
        // put your code here
        include './models/IMessage.php';
        include './models/Message.php';
        
        $message = new Message();
        
        $message->addMessage('test', 'my test message');
                
        var_dump($message->getAllMessages());
        echo '<br />';
        var_dump($message instanceof IMessage);
        echo '<br />';
        var_dump($message->removeMessage('test'));
        echo '<br />';
        var_dump($message->getAllMessages());
        echo '<br />';
        
        ?>
            
        </div>
    </body>
</html>
