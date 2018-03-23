<?php
include('connect.php');
session_start();
$user_check = $_SESSION['login_user']; 
$ses_sql = mysqli_query($conn,"select username from admin where username = '$user_check' ");   
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);   
$login_session = $row['username'];
$fetchName = mysqli_query($conn,"SELECT nama, nama_blk FROM admin WHERE username = '$user_check'");
$row = mysqli_fetch_array($fetchName,MYSQLI_ASSOC);
$login_name = $row['nama'];
$login_lastName = $row['nama_blk'];
$fetchNIK = mysqli_query($conn,"SELECT nik FROM admin WHERE username = '$user_check'");
$row = mysqli_fetch_array($fetchNIK,MYSQLI_ASSOC);
$login_NIK = $row['nik'];
$fetchSchool = mysqli_query($conn,"SELECT nama FROM data_sekolah");
$row = mysqli_fetch_array($fetchSchool,MYSQLI_ASSOC);
$school = $row['nama'];
if(!isset($_SESSION['login_user']))
{
	header("location:./loginpage.php");
}
?>
