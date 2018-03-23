<?php
/*data insertion script
writed by Dito Aldi SP 1151500054 | Technology Institute of Indonesia
for TabunganKu web application
in help by any other sources*/


//data insertion for table: nasabah
include('connect.php');
include('session.php');
echo '<link href="../css/bootstrap.min.css" rel="stylesheet">
			  <link href="../css/font-awesome.min.css" rel="stylesheet">
			  <link href="../css/datepicker3.css" rel="stylesheet">
			  <link href="../css/styles.css" rel="stylesheet">';
if (isset($_GET['status']) and ($_GET["status"])=="1")
{
	//retrieving data
	$acnum = $_POST['acnum'];
	$name = $_POST['name'];
	$lastname = $_POST['lastname'];
	$pass = $_POST['password'];
	$gender = $_POST['gender'];
	$class = $_POST['class'];
	$bal = $_POST['bal'];
	//record data into table: nasabah
	$sql = "insert into nasabah (no_rek,nama,nama_blk,password,gender,kelas,saldo) 
			values ('$acnum','$name', '$lastname','$pass','$gender','$class','$bal')";
	$query = mysqli_query($conn,$sql);
	if (!$query)
	{
		die ('<br/>failed to record data to table : nasabah'  .mysqli_error($conn));
	}
	else
	{
		echo '<div class="row">
			  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
					<div class="panel panel-info">
						<div class="panel-heading">Penambahan Data Sukses!
							</div>
						<div class="panel-body">
							<p>Penambahan data nasabah berhasil dilakukan<br/>Mohon tunggu...</p>
						</div>
					</div>
				</div>
			   </div><!-- /.row -->	
			';

	}
	header('refresh:3;url=../member.php?show=1');
}
elseif (isset($_GET['status']) and ($_GET["status"])=="submitEdit=1")
{
	//retrieving data
	$name = $_POST['name'];
	$lastName = $_POST['lastname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	//record data into table: nasabah
	$sql = "UPDATE admin SET nama='$name', nama_blk='$lastName', no_tlp='$phone', surel='$email',alamat='$address' WHERE nik='$login_NIK'";
	$query = mysqli_query($conn,$sql);
	if (!$query)
	{
		die ('<br/>failed to record data to table : admin'  .mysqli_error($conn));
	}
	else
	{
		echo '<div class="row">
			  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
					<div class="panel panel-info">
						<div class="panel-heading">Sukses
							</div>
						<div class="panel-body">
							<p>Pengubahan profil anda berhasil dilakukan<br/>Mohon Tunggu</p>
						</div>
					</div>
				</div>
			   </div><!-- /.row -->	
			';
			header('refresh:3;url=../settings.php?show=1');

	}
}
elseif (isset($_GET['status']) and ($_GET["status"])=="submitEdit=2")
{
	//retrieving data
	$pass = $_POST['password'];
	$uname = $_POST['uname'];
	//record data into table: nasabah
	$sql = "UPDATE admin SET username='$uname', password='$pass' WHERE nik='$login_NIK'";
	$query = mysqli_query($conn,$sql);
	if (!$query)
	{
		die ('<br/>failed to record data to table : nasabah'  .mysqli_error($conn));
	}
	else
	{
		echo '<div class="row">
			  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
					<div class="panel panel-info">
						<div class="panel-heading">Sukses
							</div>
						<div class="panel-body">
							<p>Pengubahan informasi akun anda berhasil dilakukan<br/>Silahkan login kembali.</p>
							<form action="logout.php">
							<div align="right"><button class="btn btn-md btn-primary">Login</button></div>
							</form>
						</div>
					</div>
				</div>
			   </div><!-- /.row -->	
			';

	}
}
elseif (isset($_GET['status']) and ($_GET["status"])=="submitEdit=3")
{
	$check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        
        $sql = "UPDATE foto SET foto='$imgContent' WHERE id_foto='$login_NIK'";
		$query = mysqli_query($conn,$sql);
		if (!$query)
	{
		die ('<br/>failed to record data to table : admin' .mysqli_error($conn));
	}
	else
	header('refresh:2;url=../settings.php?show=1');
	}
}
if (isset($_GET['status']) and ($_GET["status"])=="submitEdit=1")
{
	//retrieving data
	$name = $_POST['name'];
	$lastName = $_POST['lastname'];
	$gender = $_POST['gender'];
	$class = $_POST['class'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	//record data into table: nasabah
	$sql = "UPDATE nasabah SET nama='$name', nama_blk='$lastName', gender='$gender', kelas='$class', no_tlp='$phone', surel='$email',alamat='$address' WHERE no_rek='$login_acnum'";
	$query = mysqli_query($conn,$sql);
	if (!$query)
	{
		die ('<br/>failed to record data to table : nasabah'  .mysqli_error($conn));
	}
	else
	{
		echo '<div class="row">
			  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
					<div class="panel panel-info">
						<div class="panel-heading">Sukses
							</div>
						<div class="panel-body">
							<p>Pengubahan profil anda berhasil dilakukan<br/>Mohon Tunggu</p>
						</div>
					</div>
				</div>
			   </div><!-- /.row -->	
			';
			header('refresh:3;url=../client/settings.php?show=1');

	}
}
	

echo '<script src="js/jquery-1.11.1.min.js"></script>
			<script src="js/bootstrap.min.js"></script>';
?>
