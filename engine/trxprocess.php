<?php
/*transaction process script
writen by Dito Aldi SP 1151500054 | Technology Institute of Indonesia
for TabunganKu web application
in help by any other sources*/

require 'connect.php';
include 'session.php';
echo '<link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../css/font-awesome.min.css" rel="stylesheet">
	  <link href="../css/datepicker3.css" rel="stylesheet">
	  <link href="../css/styles.css" rel="stylesheet">
	  <script src="js/jquery-1.11.1.min.js"></script>
	  <script src="js/bootstrap.min.js"></script>
	  <script src="js/custom2.js"></script>';
//deposit  
if (isset($_GET['status']) and ($_GET["status"])=="1")
{
	$acnum = $_POST['acnum'];
	$amount = $_POST['bal'];
	//data lookup
	$query = "SELECT no_rek FROM nasabah WHERE no_rek = '$acnum'";
	$result = mysqli_query($conn,$query);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	$fetchName = mysqli_query($conn,"SELECT nama FROM nasabah WHERE no_rek = '$acnum'");
	$row = mysqli_fetch_array($fetchName,MYSQLI_ASSOC);
	$name = $row['nama'];

	if ($count == 0)
	{
		echo '
			  <div class="row">
			  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="panel panel-danger">
					<div class="panel-heading">Nomor Rekening Tidak Ditemukan
						</div>
					<div class="panel-body">
						<p>Nomor rekening yang dimasukkan salah atau tidak ada.<br/>Mohon kembali ke halaman penyetoran dan masukkan nomor rekening yang benar.</p><br/><br/>
						<div align="right"><a href="../transaction.php?show=1"><button class="btn btn-md btn-primary">Kembali</button></a></div>
					</div>
				</div>
			
			</div>
			</div><!-- /.row -->'	
			;
	}
	else
	{
		if ($count == 1)
		{
			echo '
			  <div class="row">
			  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="panel panel-info">
					<div class="panel-heading">Transaksi Penyetoran
						</div>
					<div class="panel-body">
						<p>Anda akan melakukan penyetoran atas nama <br/>
						<form action="?status=yesOnDeposit" method="post">
						<input class="form-control" id ="name" name="name" type="text" value="'.$name.'" readonly="readonly"><br/>
						<input class="form-control" id ="account" name="account" type="text" value="'.$acnum.'" readonly="readonly"><br/>
						<p>Sebesar</p><input class="form-control" id ="deposit" name="deposit" type="number" value="'.$amount.'" readonly="readonly">
						<br/>
						<div align="right"><a href="../transaction.php?show=1"><button class="btn btn-md btn-danger" type="button" tabindex="2">Kembali</button></a>&nbsp;
						<button class="btn btn-md btn-primary" tabindex="1">Konfirmasi</button></div>
						</form>
					</div>
				</div>
			
			</div>
			</div><!-- /.row -->
			';
		}
	}
}
if (isset($_GET['status']) and ($_GET["status"])=="yesOnDeposit")
{
	//fetch balance
	$account = $_POST['account'];
	$deposit = $_POST['deposit'];
	$fetchBal = mysqli_query($conn,"SELECT saldo FROM nasabah WHERE no_rek = '$account'");
	$row = mysqli_fetch_array($fetchBal,MYSQLI_ASSOC);
	$bal = $row['saldo'];
	$lastBal = $bal;
	//counting
	$total = $bal+$deposit;
	$query = "UPDATE nasabah SET saldo='$total' WHERE no_rek='$account'";
	$sql = mysqli_query($conn,$query);
	if (!$sql)
	{
		die ('failed to update data'. mysqli_error($conn));
	}
	else
	{
		echo '
			  <div class="row">
			  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="panel panel-info">
					<div class="panel-heading">Transaksi Berhasil
						</div>
					<div class="panel-body">
						<p>Transaksi penyetoran berhasil dilakukan<br/>Mohon tunggu...</p>
					</div>
					</div>
			
				</div>
			</div><!-- /.row -->';
		/*recording data to table: transaksi*/
		$date = date("d/m/Y");
		$time = date("h:i:sa");
		$sql = "insert into transaksi (no_rek,tanggal,jam, nik, jenis,saldo_awal,nominal,saldo_akhir) 
				values ('$account','$date','$time','$login_NIK','setor','$lastBal','$deposit','$total')";
		$query = mysqli_query($conn,$sql);
		if (!$query)
		{
			die ('<br/>failed to record data to table : transaksi'. mysqli_error($conn));
		}
		
			header('refresh:1;url=../transaction.php?show=1');
	}
}
//withdrawal
if (isset($_GET['status']) and ($_GET["status"])=="2")
{
	$acnum = $_POST['acnum'];
	$amount = $_POST['bal'];
	//data lookup
	$query = "SELECT no_rek FROM nasabah WHERE no_rek = '$acnum'";
	$result = mysqli_query($conn,$query);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$count = mysqli_num_rows($result);
	$fetchName = mysqli_query($conn,"SELECT nama FROM nasabah WHERE no_rek = '$acnum'");
	$row = mysqli_fetch_array($fetchName,MYSQLI_ASSOC);
	$name = $row['nama'];
	if ($count == 0)
	{
		echo '
			  <div class="row">
			  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="panel panel-danger">
					<div class="panel-heading">Nomor Rekening Tidak Ditemukan
						</div>
					<div class="panel-body">
						<p>Nomor rekening yang dimasukkan salah atau tidak ada.<br/>Mohon kembali ke halaman transaksi penarikan dan masukkan nomor rekening yang benar.</p><br/><br/>
						<div align="right"><a href="../transaction.php?show=2"><button class="btn btn-md btn-primary">Kembali</button></a></div>
					</div>
				</div>
			
			</div>
			</div><!-- /.row -->'	
			;
	}
	else
	{
		if ($count == 1)
		{
			echo '
			  <div class="row">
			  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="panel panel-info">
					<div class="panel-heading">Transaksi Penarikan
						</div>
					<div class="panel-body">
						<p>Anda akan melakukan penarikan atas nama <br/>
						<form action="?status=yesOnWithdrawal" method="post">
						<input class="form-control" id ="name" name="name" type="text" value="'.$name.'" readonly="readonly"><br/>
						<input class="form-control" id ="account" name="account" type="text" value="'.$acnum.'" readonly="readonly"><br/>
						<p>Sebesar</p><input class="form-control" id ="deposit" name="deposit" type="number" value="'.$amount.'" readonly="readonly">
						<br/>
						<div align="right"><a href="../transaction.php?show=2"><button class="btn btn-md btn-danger" type="button" tabindex="2">Kembali</button></a>&nbsp;
						<button class="btn btn-md btn-primary" tabindex="1">Konfirmasi</button></div>
						</form>
					</div>
				</div>
			
			</div>
			</div><!-- /.row -->	
			';
		}
	}
}
if (isset($_GET['status']) and ($_GET["status"])=="yesOnWithdrawal")
{
	//fetch balance
	$account = $_POST['account'];
	$deposit = $_POST['deposit'];
	$fetchBal = mysqli_query($conn,"SELECT saldo FROM nasabah WHERE no_rek = '$account'");
	$row = mysqli_fetch_array($fetchBal,MYSQLI_ASSOC);
	$bal = $row['saldo'];
	$lastBal = $bal;
	//counting
	$total = $bal-$deposit;
	$query = "UPDATE nasabah SET saldo='$total' WHERE no_rek='$account'";
	$sql = mysqli_query($conn,$query);
	if (!$sql)
	{
		die ('failed to update data'. mysqli_error($conn));
	}
	else
	{
		echo '
			  <div class="row">
			  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
				<div class="panel panel-info">
					<div class="panel-heading">Transaksi Berhasil
						</div>
					<div class="panel-body">
						<p>Transaksi penarikan berhasil dilakukan<br/>Mohon tunggu...</p>
					</div>
					</div>
			
				</div>
			</div><!-- /.row -->';
			/*recording data to table: transaksi*/
		$date = date("d/m/Y");
		$time = date("h:i:sa");
		$sql = "insert into transaksi (no_rek,tanggal,jam,nik,jenis,saldo_awal,nominal,saldo_akhir) 
				values ('$account','$date','$time','$login_NIK','tarik','$lastBal','$deposit','$total')";
		$query = mysqli_query($conn,$sql);
		if (!$query)
		{
			die ('<br/>failed to record data to table : transaksi'. mysqli_error($conn));
		}
			header('refresh:1;url=../transaction.php?show=2');
}
	}
?>
