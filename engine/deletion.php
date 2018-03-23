<?php
include('connect.php');
include('session.php');
echo '<link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/font-awesome.min.css" rel="stylesheet">
	  <link href="../css/datepicker3.css" rel="stylesheet">
	  <link href="../css/styles.css" rel="stylesheet">
	  <script src="js/jquery-1.11.1.min.js"></script>
	  <script src="js/bootstrap.min.js"></script>
	  <script src="js/custom2.js"></script>';
$account= $_REQUEST['account'];
if (isset($_GET['status']) and ($_GET["status"])=="confirmation")
{
	$fetchInfo = mysqli_query($conn,"SELECT CONCAT(nama,' ', nama_blk) AS nama FROM nasabah WHERE no_rek = '$account'");
	$row = mysqli_fetch_array($fetchInfo,MYSQLI_ASSOC);
	$name = $row['nama'];
	echo '
			  <div class="row">
			  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="panel panel-danger">
					<div class="panel-heading">Hapus Akun Nasabah
						</div>
					<div class="panel-body">
						<p>Anda akan menghapus akun atas nama <br/>
						<form>
						<input class="form-control" id ="name" name="name" type="text" value="'.$name.'" readonly="readonly"><br/>
						<input class="form-control" id ="account" name="account" type="text" value="'.$account.'" readonly="readonly"><br/>
						</form>
					
						
				</div>
			</div>
					</div>
				</div>
			
			</div>
			<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="panel panel-danger">
			<div class="panel-heading">Masukkan Password Anda</div>
				<div class="panel-body">
					<form role="form" action="?status=auth" method="post">
						<fieldset>
							<input class="form-control" id ="account" name="account" type="hidden" value="'.$account.'" readonly="readonly">
							<input class="form-control" placeholder="Password" id="password" name="password" type="password" value="">
							<input type="checkbox" onclick="showPwd()">&nbsp Lihat password
							<div align="right">
							<a href="../detail.php?account='.$account.'&show=details"><button class="btn btn-md btn-warning" type="button">Kembali</button></a>&nbsp;
							<button class="btn btn-md btn-danger">Hapus</button></fieldset>
							</div>
					</form>
					</div>
					</div>
					</div>	
			</div><!-- /.row -->	
			';
}
if (isset($_GET['status']) and ($_GET["status"])=="auth")
{
	$account = $_POST['account'];
	$pass = $_POST['password'];
	$query = "SELECT id FROM admin WHERE username = '$user_check' and password = '$pass'";
	$result = mysqli_query($conn,$query);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
      
	if($count == 1)
	{
		$query1 = "DELETE FROM nasabah WHERE no_rek='$account'";
		$sql1 = mysqli_query($conn,$query1);
		$query2 = "DELETE FROM foto WHERE id_foto='$account'";
		$sql2 = mysqli_query($conn,$query2);
		if (!$sql1 and !$sql2)
		{
			die ('failed to delete');
		}else{
			echo '<div class="row">
			  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
					<div class="panel panel-info">
						<div class="panel-heading">Penghapusan Akun Sukses
							</div>
						<div class="panel-body">
							<p>Penghapusan akun nasabah berhasil dilakukan<br/>Mohon tunggu...</p>
						</div>
					</div>
				</div>
			   </div><!-- /.row -->	
			';
			header('refresh:3;url=../member.php');
		}
    }else {
        header("location: deletion.php?account=$account&status=confirmation");
    }
}
?>
