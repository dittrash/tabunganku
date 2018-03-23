<?php
/*Database creator script
writed by Dito Aldi SP 1151500054 | Technology Institute of Indonesia
for TabunganKu web application
in help by any other sources*/

//open connection
$host = $_POST['host'];
$uname = $_POST['uname'];
$pass = $_POST['pass'];
$conn = mysqli_connect($host,$uname,$pass);
if (!$conn)
{
	die ('connection failed');
}
else
{
	echo 'connection success';
}
//create database
$sql = mysqli_query($conn,'create database tabunganku');
if (!$sql)
{
	die ('failed to create database : tabunganku');
}
else
{
	echo '<br/>succeed to create database : tabunganku';
}
//select database
$sql = mysqli_select_db($conn,'tabunganku');
if (!$sql)
{
	die ('failed to select database : tabunganku');
}
else
{
	echo '<br/>succeed to select database : tabunganku';
}
//create table: nasabah
$sql = 'create table nasabah (no_rek varchar(12) not null,
			      nama varchar(30) not null,
			      password varchar(30) not null,
			      gender varchar(1) not null,
			      kelas varchar(5) not null,
			      no_tlp varchar(14) not null,
			      alamat varchar(50) not null,
			      surel varchar(15) not null,
			      saldo int not null,
			      primary key (no_rek));';
$query = mysqli_query($conn, $sql);
if (!$query)
{
	die ('failed to create table : nasabah');
}
else
{
	echo '<br/>succeed to create table : nasabah';   
}
//create table: admin
$sql = 'create table admin (id int auto_increment,
				nik varchar(12) not null,
			    username varchar(30) not null,
			    password varchar(30) not null,
			    nama varchar(30) not null,
			    no_tlp varchar(14) not null,
			    surel varchar(15) not null,
			    alamat varchar(50) not null,
			    primary key (id));';
$query = mysqli_query($conn, $sql);
if (!$query)
{
	die ('failed to create table : admin');
}
else
{
	echo '<br/>succeed to create table : admin';   
}
//create table: transaksi
$sql = 'create table transaksi (id int auto_increment,
			    no_rek varchar(12) not null,
			    tanggal varchar(10) not null,
			    jam varchar(5) not null,
			    jenis varchar(5) not null,
			    saldo_awal int not null,
			    nominal int not null,
			    saldo_akhir int not null,
			    primary key (id));';
$query = mysqli_query($conn, $sql);
if (!$query)
{
	die ('failed to create table : setor');
}
else
{
	echo '<br/>succeed to create table : setor';   
}
//create table: data sekolah
$sql = 'create table data_sekolah (id int auto_increment,
				     nama varchar(50) not null,
				     no_tlp varchar(14) not null,
				     alamat varchar(50) not null,
				     surel varchar(15) not null,
				     situs_web varchar(15) not null,
				     primary key (id));';
$query = mysqli_query($conn, $sql);
if (!$query)
{
	die ('failed to create table : data_sekolah');
}
else
{
	echo '<br/>succeed to create table : data_sekolah';   
}
//create user
$sql = "create user 'tabunganku'@'localhost' identified by 's4rungw@d1m0r';";
$query = mysqli_query($conn, $sql);
if (!$query)
{
	die ('failed to create user: tabunganku');
}
else
{
	echo '<br/>Succeed create user: tabunganku';
}
//set user privilege
$sql = "grant all on tabunganku.* TO 'tabunganku'@'localhost'";
$query = mysqli_query($conn, $sql);
if (!$query)
{
	die ('failed to set privilege on user: tabunganku');
}
else
{
	echo '<br/>Succeed to set privilege on user: tabunganku';
}
//close connection
mysqli_close($conn);
//redirection
echo '<br/><brx/>Redirecting in 3 seconds...';
header('refresh:3;url=index.php?show=1');
?>
