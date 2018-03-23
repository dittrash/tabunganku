<?php
/*data recorder script
writed by Dito Aldi SP 1151500054 | Technology Institute of Indonesia
for TabunganKu web application
in help by any other sources*/

//open connection
$conn = mysqli_connect('localhost','tabunganku','s4rungw@d1m0r');
if (!$conn)
{
	die ('connection failed');
}
else
{
	echo 'connection success<br/>';
}
//select database
$query = mysqli_select_db($conn,'tabunganku');
if (!$query)
{
	die ('failed to select database : tabunganku');
}
else
{
	echo 'success to select database: tabunganku';
}
//data filling for table : admin
if (isset($_GET['status']) and ($_GET["status"])=="1")
{
	//retrieving data
	$id = $_POST['id'];
	$name = $_POST['name'];
	$uname = $_POST['uname'];
	$pass = $_POST['pass'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	//record data into table: admin
	$sql = "insert into admin (nik,username,password,nama,no_tlp,surel,alamat) 
			values ('$id','$uname','$pass','$name','$phone','$email','$address')";
	$query = mysqli_query($conn,$sql);
	if (!$query)
	{
		die ('<br/>failed to record data to table : admin') .mysqli_error($conn);
	}
	else
	{
		echo '<br/>succeed to record data to table: admin<br/>Redirecting in 3 seconds...';
	}
	header('refresh:3;url=index.php?show=2');
}
//data filling for table : data_sekolah
elseif (isset($_GET['status']) and ($_GET["status"])=="2")
{
	//retrieving data
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$website = $_POST['website'];
	//record data into table: data_sekolah
	$sql = "insert into data_sekolah (nama,alamat,no_tlp,surel,situs_web) 
			values ('$name','$address','$phone','$email','$website')";
	$query = mysqli_query($conn,$sql);
	if (!$query)
	{
		die ('<br/>failed to record data to table : data_sekolah') .mysqli_error($conn);
	}
	else
	{
		echo '<br/>succeed to record data to table: data_sekolah<br/>Redirecting in 3 seconds...';
	}
	header('refresh:3;url=../index.php');
}
?>
