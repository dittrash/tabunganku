<?php
/*Database creator script
writed by Dito Aldi SP 1151500054 | Technology Institute of Indonesia
for TabunganKu web application
in help by any other sources*/


require 'connect.php';
session_start();
$uname = $_POST['uname'];
$pass = $_POST['password'];
$query = "SELECT id FROM admin WHERE username = '$uname' and password = '$pass'";
$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$active = $row['active'];
$count = mysqli_num_rows($result);
      
if($count == 1)
{
	$_SESSION['login_user'] = $uname;
         
         header("location: ../index.php");
      }else {
        header("location: ../loginpage.php");
      }
if (isset($_GET['status']) and ($_GET["status"])=="client")
{
	session_start();
	$acnum = $_POST['acnum'];
	$pass = $_POST['password'];
	$query = "SELECT no_rek FROM nasabah WHERE no_rek = '$acnum' and password = '$pass'";
	$result = mysqli_query($conn,$query);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$active = $row['active'];
	$count = mysqli_num_rows($result);      
	if($count == 1)
	{
		$_SESSION['login_client'] = $acnum;
         
			header("location: ../client/index.php");
		}
		else
		{
			header("location: ../client/loginpage.php");
		}
}
	
?>
