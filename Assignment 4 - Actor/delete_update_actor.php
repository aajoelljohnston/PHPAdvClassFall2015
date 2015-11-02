<?php

switch ( $_POST['edit'] ) {
	case 'Delete Actor':
// Get IDs
$actor_id = $_POST['update_actor_id'];

// Delete the product from the database
require_once('database.php');
$query = "DELETE FROM actors
          WHERE actorID = '$actor_id'";
$db->exec($query);

// display the Actors page
include('actors.php');
	break;
	
	case 'Update Actor':
	// Get the actor data
		$update_actor_id = $_POST['update_actor_id'];
		$update_first_name = $_POST['update_first_name'];
		$update_last_name = $_POST['update_last_name'];
		$update_gender = $_POST['update_gender'];
		$update_birth_date = $_POST['update_birth_date'];

		//function to validate Date format
		function validateDate($date)
		{
			$d = DateTime::createFromFormat('Y-m-d', $date);
			return $d && $d->format('Y-m-d') == $date;
		}

		// Validate inputs
		if (empty($update_first_name) || empty($update_last_name) || empty($update_birth_date) || empty($update_gender)) {
			$error = "To Update Actors, All Updating Fields Must Be Entered.";
			include('error.php');
		}
		else if (validateDate($update_birth_date) == false){
			$error = "Invalid Date Format. Enter in yyyy-mm-dd format.";
			include('error.php');
		}
		else {
		// If valid, update the actor to the database
			require_once('database.php');
			$query = "UPDATE actors
					  SET firstName = '$update_first_name',
					      lastName = '$update_last_name',
						  birthDate = '$update_birth_date',
						  actorGender = '$update_gender'
					  WHERE actorID = '$update_actor_id' ";
			$db->exec($query);
			$actor_to_edit = '';
		}
	// display the Actors page
	include('actors.php');
	break;
}
?>