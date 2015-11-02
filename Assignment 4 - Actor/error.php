<?php

session_start();     
   echo 'Username: '.$_SESSION['user'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- the head section -->
<head>
    <title>Actors</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
    <div id="page">
        <div id="header">
            <h1>Actors</h1>
        </div>

        <div id="main">
            <h2 class="top">Error</h2>
            <p><?php echo $error; ?></p>
			<td><a href="actors.php">Main Page - Actors</a></td>
        </div>

    </div><!-- end page -->
</body>
</html>