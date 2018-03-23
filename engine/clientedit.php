<?php
include('connect.php');
include('session.php');
echo '<link href="../css/bootstrap.min.css" rel="stylesheet">
			  <link href="../css/font-awesome.min.css" rel="stylesheet">
			  <link href="../css/datepicker3.css" rel="stylesheet">
			  <link href="../css/styles.css" rel="stylesheet">';

if (isset($_GET['status']) and ($_GET["status"])=="1")
{
	//retrieving data
	$account = $_POST['id'];
	$pass = $_POST['password'];
	$name = $_POST['name'];
	$lastName = $_POST['lastname'];
	$gender = $_POST['gender'];
	$class = $_POST['class'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	//record data into table: nasabah
	$sql = "UPDATE nasabah SET nama='$name', nama_blk='$lastName', password='$pass', gender='$gender', kelas='$class', no_tlp='$phone', surel='$email',alamat='$address' WHERE no_rek='$account'";
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
							<p>Pengubahan detail akun nasabah berhasil dilakukan<br/>Mohon Tunggu</p>
						</div>
					</div>
				</div>
			   </div><!-- /.row -->	
			';
			header("refresh:3;url=../detail.php?account=$account&show=details");

	}
}
elseif (isset($_GET['status']) and ($_GET["status"])=="editClientPhoto")
{
	$account = $_POST['id'];
	$check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        
        $sql = "UPDATE foto SET foto='$imgContent' WHERE id_foto='$account'";
		$query = mysqli_query($conn,$sql);
		if (!$query)
	{
		die ('<br/>failed to record data to table : nasabah' .mysqli_error($conn));
	}
	else
	header("refresh:1;url=../detail.php?account=$account&show=details");
	}
}
elseif (isset($_GET['status']) and ($_GET["status"])=="submitClientPhoto")
{
	$check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        $sql = "insert into foto (id_foto, foto) 
				values ('$login_acnum','$imgContent')";
		$query = mysqli_query($conn,$sql);
		if (!$query)
	{
		die ('<br/>failed to record data to table : nasabah' .mysqli_error($conn));
	}
	else
	header('refresh:1;url=../detail.php?account=$account&show=details');
	}
}
?>
