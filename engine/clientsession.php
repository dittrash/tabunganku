<?php
include('connect.php');
session_start();
$user_check = $_SESSION['login_client']; 
	$ses_sql = mysqli_query($conn,"select no_rek from nasabah where no_rek = '$user_check' ");   
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);   
	$login_session = $row['no_rek'];
	$fetchName = mysqli_query($conn,"SELECT nama, nama_blk FROM nasabah WHERE no_rek = '$user_check'");
	$row = mysqli_fetch_array($fetchName,MYSQLI_ASSOC);
	$login_name = $row['nama'];
	$login_lastName = $row['nama_blk'];
	$fetchAcnum = mysqli_query($conn,"SELECT no_rek FROM nasabah WHERE no_rek = '$user_check'");
	$row = mysqli_fetch_array($fetchAcnum,MYSQLI_ASSOC);
	$login_acnum = $row['no_rek'];
	$fetchSchool = mysqli_query($conn,"SELECT nama FROM data_sekolah");
	$row = mysqli_fetch_array($fetchSchool,MYSQLI_ASSOC);
	$school = $row['nama'];
	if(!isset($_SESSION['login_client']))
	{
		header("location:./loginpage.php");
	}
	?>
