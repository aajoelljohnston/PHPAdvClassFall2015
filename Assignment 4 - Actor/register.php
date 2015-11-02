<!doctype html>
<html>
<head>	
<title>Register</title>
</head>
<body>

<h3>Registration Form</h3>
<form action="" method="POST">
Username: <input type=text name='user'><br/>
Password: <input type=password name='pass'><br/>	

<input type=submit value='Register' name='submit'>
</form>
<?php 
if (isset($_POST['submit'])){

if(!empty($_POST['user']) && !empty($_POST['pass'])) {

//mysql_real_escape_string() escapes special characters in a string for use in an SQL statement
$user = $_POST['user']; 
$pass=mysql_real_escape_string($_POST['pass']);

$con=mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db('user') or die("cannot select DB");

$query=mysql_query("SELECT * FROM login WHERE user='".$user."'");
$numrows=mysql_num_rows($query);
if($numrows==0)
{
//md5() calculates the MD5 hash of a string
$encrypt_password=md5($pass);

$sql="INSERT INTO login
		(user, pass)
	VALUES
		('$user','$encrypt_password')";

$result=mysql_query($sql);


if($result!=1) 
{
echo "Failure!";
}
else{
echo "Account Successfully Created";
}
} else {
echo "That username already exists! Please try again with another.";
}

} else {
	echo "All fields are required!";
}
}
?>
<p><a href="register.php">Register</a> | <a href="index.php">Login</a></p>
</body>
</html>