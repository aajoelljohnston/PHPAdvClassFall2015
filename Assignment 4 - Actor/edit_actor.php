<?php

session_start();     
   echo 'Username: '.$_SESSION['user'];

require_once('database.php');

$actor_id = $_GET['actor_id'];
$query = "SELECT * 
		  FROM actors
		  WHERE actorID = '$actor_id'";
$actors = $db->query($query);
$actor = $actors->fetch();
$first_name = $actor['firstName'];
$last_name = $actor['lastName'];
$gender = $actor['actorGender'];
$birth_date = $actor['birthDate'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- the head section -->
<head>
    <title>Edit Actor</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->
<body>
    <div id="page">
         <form action="delete_update_actor.php" method="post"
               id="actors">

    <div id="header">
        <h1>Edit Actor</h1>
    </div>
		
		<input type="hidden" name="update_actor_id" value="<?php echo $actor_id; ?>"/>
		<label>First Name:</label>
        <input type="text" name="update_first_name" value="<?php echo $first_name; ?>"/>
		
		<label>Last Name:</label>
        <input type="text" name="update_last_name" value="<?php echo $last_name; ?>"/>
		<br />
        
        <label>Birth Date:</label>
        <input type="text" name="update_birth_date" value="<?php echo $birth_date; ?>"/>
		<br />
		
		<label>Gender:</label>
        <input type="radio" name="update_gender" value="M" <?php echo ($gender=='M')?'checked':''?>/>
        Male
        <input type="radio" name="update_gender" value="F" <?php echo ($gender=='F')?'checked':''?>/>
        Female<br />	
		
		<input type="submit" name="edit" value="Update Actor" />	
		<input type="submit" name="edit" value="Delete Actor" />
		</form>

    </div><!-- end page -->
</body>
</html>