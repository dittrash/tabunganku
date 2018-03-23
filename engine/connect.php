<?php
/*Database connection script
writed by Dito Aldi SP 1151500054 | Technology Institute of Indonesia
for TabunganKu web application
in help by any other sources*/

//open connection
$host = 'localhost';
$username = 'tabunganku';
$pass = 's4rungw@d1m0r';
$conn = mysqli_connect($host, $username, $pass);
if (!$conn)
{
	die ('connection failed');
}
else
{
	//go to home.php;
}
//select database
$sql = mysqli_select_db($conn,'tabunganku');
if (!$sql)
{
	die ('failed to select database : tabunganku');
}
else
{
	//go to home.php;
}
?>
