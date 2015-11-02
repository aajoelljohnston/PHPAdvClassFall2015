<?php
// Get the actor data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$birth_date = $_POST['birth_date'];

//function to validate Date format
function validateDate($date)
{
	$d = DateTime::createFromFormat('Y-m-d', $date);
	return $d && $d->format('Y-m-d') == $date;
}

// Validate inputs
if (empty($first_name) || empty($last_name)  || empty($gender) || empty($birth_date) ) {
    $error = "Invalid actor data. Check all fields and try again.";
    include('error.php');
}else if (validateDate($birth_date) == false){
	$error = "Invalid Date Format. Enter in yyyy-mm-dd format.";
	include('error.php');
}	
else {
    // If valid, add the actor to the database
    require_once('database.php');
    $query = "INSERT INTO actors
                 (firstName, lastName, actorGender, birthDate)
              VALUES
                 ('$first_name', '$last_name', '$gender', '$birth_date')";
	$db->exec($query);

    // Display the Actors page
    include('actors.php');
}
?>