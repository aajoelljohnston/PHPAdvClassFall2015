<!doctype html>
<html>
<head>	
<title>Login</title>
</head>
<body>

<h3>Login Form</h3>
<form action="" method="POST">
Username: <input type=text name='user'><br/>
Password: <input type=password name='pass'><br/>	

<input type=submit value='Login' name='submit'>
</form>
<?php 
if (isset($_POST['submit'])){

if(!empty($_POST['user']) && !empty($_POST['pass'])) {

$user = $_POST['user'];
$pass=mysql_real_escape_string($_POST['pass']);

$encrypt_password=md5($pass);

$con=mysql_connect('localhost','root','') or die(mysql_error());
mysql_select_db('user') or die("cannot select DB");

$query=mysql_query("SELECT * FROM login WHERE user='$user' AND pass='$encrypt_password'");
$numrows=mysql_num_rows($query);
if($numrows!=0)
{
session_start();
$_SESSION['user']=$user;    

header("Location: actors.php");
}
else {
echo "Invalid username or password!";
}

} else {
	echo "All fields are required!";
}
}
?>
<p><a href="register.php">Register</a> | <a href="index.php">Login</a></p>
</body>
</html>