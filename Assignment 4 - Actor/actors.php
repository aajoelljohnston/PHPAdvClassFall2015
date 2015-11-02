<?php

session_start();     
   echo 'Username: '.$_SESSION['user']; 

    require_once('database.php');

    // Get all actors
    $query = "SELECT * FROM actors
              ORDER BY firstName";
    $actors = $db->query($query);

//get and format today's date
$now = date('F d', time());

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
		
		<label>First Name:</label>
        <input type="input" name="search_first_name" />
		<br />
        
        <label>Last Name:</label>
        <input type="input" name="search_last_name" />
        
        <label>&nbsp;</label>
        <input type="submit" value="Search" />
        <br /><br />

        <div id="content">
            <!-- display a table of actors -->
            <table>
                <?php foreach ($actors as $actor) : ?>
				<?php if (date('F d', strtotime($actor['birthDate']))==$now):?>
                <tr id="birthDate">
                    <td><?php echo $actor['firstName'] . ' ' . $actor['lastName'] ; ?></td>
					<td><?php echo $actor['actorGender']; ?></td>
                    <td class="right"><?php echo date('F d, Y', strtotime($actor['birthDate'])); ?></td>
					
                    <td><form action="edit_actor.php" method="post"
                              id="edit_actor_form">
				
						<a href="edit_actor.php?actor_id=<?php echo $actor['actorID'];?>">Edit</a>
                    </form></td>
                </tr>
				<?php else: ?><tr>
                    <td><?php echo $actor['firstName'] . ' ' . $actor['lastName'] ; ?></td>
					<td><?php echo $actor['actorGender']; ?></td>
                    <td class="right"><?php echo date('F d, Y', strtotime($actor['birthDate'])); ?></td>
					
                    <td><form action="edit_actor.php" method="post"
                              id="edit_actor_form">
				
						<a href="edit_actor.php?actor_id=<?php echo $actor['actorID'];?>">Edit</a>
                    </form></td></tr>
				<?php endif; ?>
                <?php endforeach; ?>
            </table>
        </div>
		<br />
		
		<form action="add_actor.php" method="post"
       	  	  id="actors">
		<label>First Name:</label>
        <input type="text" name="first_name" />
		
		<label>Last Name:</label>
        <input type="text" name="last_name" />
		<br />
        
        <label>Birth Date:</label>
        <input type="text" name="birth_date" />
		<br />
		
		<label>Gender:</label>
        <input type="radio" name="gender" value="M" />
        Male
        <input type="radio" name="gender" value="F" />
        Female<br />	
		
		
		<input id="actors_button" type="submit" value="Add Actor" />
		</form>
		
    </div>

    </div><!-- end page -->
</body>
</html>