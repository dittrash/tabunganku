<?php
   include('engine/session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TabunganKu: Pengaturan</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Tabungan</span>Ku</a>
		<!--menu panel-->
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<?php
				$result = $conn->query("SELECT foto FROM foto WHERE id_foto ='$login_NIK'");
				if($result->num_rows > 0){
				$imgData = $result->fetch_assoc();
				//Render image 
				echo '<img src="data:image/jpeg;base64,'.base64_encode( $imgData['foto'] ).'" class="img-responsive" alt=""/>'; 
				}else{
				echo '<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">';
				}
				?>
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo("{$login_name} {$login_lastName}") ?></div>
				<div class="profile-usertitle-status"><?php echo("NIK: {$login_NIK}") ?></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dasbor</a></li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-money">&nbsp;</em> Transaksi <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="transaction.php?show=1">
						<span class="fa fa-arrow-right">&nbsp;</span> Penyetoran
					</a></li>
					<li><a class="" href="transaction.php?show=2">
						<span class="fa fa-arrow-right">&nbsp;</span> Penarikan
					</a></li>
				</ul>
			</li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-users">&nbsp;</em> Nasabah <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-2">
					<li><a class="" href="member.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Data Nasabah
					</a></li>
					<li><a class="" href="member.php?show=1">
						<span class="fa fa-arrow-right">&nbsp;</span> Tambah Nasabah
					</a></li>
				</ul>
			</li>
			<li class="parent"><a data-toggle="collapse" href="#sub-item-3">
				<em class="fa fa-file-text">&nbsp;</em> Laporan <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-3">
					<li><a class="" href="report.php?show=deposit">
						<span class="fa fa-arrow-right">&nbsp;</span> Lap. Penyetoran
					</a></li>
					<li><a class="" href="report.php?show=withdrawal">
						<span class="fa fa-arrow-right">&nbsp;</span> Lap. Penarikan
					</a></li>
				</ul>
			</li>
			<li  class="active"><a href="#"><em class="fa fa-cog">&nbsp;</em> Pengaturan</a></li>
			<li><a href="engine/logout.php"><em class="fa fa-power-off">&nbsp;</em> Keluar</a></li>
		</ul>
	</div><!--/.sidebar-->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Pengaturan</li>
			</ol>
		</div><!--/.row-->
		<?php
		//fetch data
			$fetchAccInfo = mysqli_query($conn,"SELECT nik, username, password, nama, nama_blk, no_tlp, surel, alamat FROM admin WHERE username = '$user_check'");
			$accInfo = mysqli_fetch_array($fetchAccInfo,MYSQLI_ASSOC);
		
		
		if (isset($_GET['show']) and ($_GET["show"])=="1")
		{ 
			
		echo '
		
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default ">
					<div class="panel-heading">
						Profil
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<table width="100%">
									<form role="form" action="?show=editOnShow=1" method="post">
									<fieldset>
									<tr><td>Nama Depan</td><td>
										<input class="form-control" placeholder="name" id ="name" name="name" type="text" value="'.$accInfo['nama'].'"readonly>
										<br/>
									</td></tr>
									<tr><td>Nama Belakang</td><td>
										<input class="form-control" placeholder="lastname" id ="lastname" name="lastname" type="text" value="'.$accInfo['nama_blk'].'"readonly>
										<br/>
									</td></tr>
									<tr><td>No. Telepon</td><td>
										<input class="form-control" placeholder="No. Telepon" id="phone" name="phone" type="number" value="'.$accInfo['no_tlp'].'"readonly>
										<br/>
									</td></tr>
									<tr><td>Surel</td><td>
										<input class="form-control" placeholder="Surel" id="email" name="email" type="text" value="'.$accInfo['surel'].'"readonly>
										<br/>
									</td></tr>
									<tr><td>Alamat</td><td>
										<input class="form-control" placeholder="Alamat" id="address" name="address" type="textbox" value="'.$accInfo['alamat'].'"readonly>
										<br/>
									</td></tr>
									<tr><td align="right" colspan="2">
										<button class="btn btn-md btn-primary">Ubah</button>
									</td></tr>
									</form>	
									</table>
					</div>
					<div class="panel-heading">
						Foto Profil</div>
						<div class="panel-body">
						<center>
							<img width="30%" src="data:image/jpeg;base64,'.base64_encode( $imgData['foto'] ).'" class="img-responsive" alt=""/>
							<br/>
							<form role="form" action="?show=editOnShow=3" method="post">
							<fieldset>
							<button class="btn btn-md btn-primary">Ubah</button>
							</form>
							</center>
						</div>
				</div>
			</div><!--/.col-->
			
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Akun
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">';
						
								
								echo '
									<table width="100%">
									<form role="form" action="?show=editOnShow=2" method="post">
									<fieldset>
									<tr><td>NIK</td><td>
										<input class="form-control" placeholder="NIK" id ="id" name="id" type="text" value="'.$accInfo['nik'].'"readonly>
										<br/>
									</td></tr>
									<tr><td>Username</td><td>
										<input class="form-control" placeholder="Username" id="uname" name="uname" type="text" value="'.$accInfo['username'].'"readonly>
										<br/>
									</td></tr>
									<tr><td>Password</td><td>
										<input class="form-control" placeholder="Password" id="password" name="password" type="password" value="'.$accInfo['password'].'"readonly>
										<br/>
									</td></tr>
									<tr><td align="right" colspan="2">
										<button class="btn btn-md btn-primary">Ubah</button>
									</td></tr>
									</form>	
									</table>
					</div>
				</div>
	
			</div><!--/.col-->';
			
		}
		elseif (isset($_GET['show']) and ($_GET["show"])=="editOnShow=1")
		{ 
			echo '
				<div class="col-md-6">
				<div class="panel panel-default ">
					<div class="panel-heading">
						Profil
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<table width="100%">
									<form role="form" action="engine/recorder.php?status=submitEdit=1" method="post">
									<fieldset>
									<tr><td>Nama Depan</td><td>
										<input class="form-control" placeholder="name" id ="name" name="name" type="text" value="'.$accInfo['nama'].'">
										<br/>
									</td></tr>
									<tr><td>Nama Belakang</td><td>
										<input class="form-control" placeholder="lastname" id ="lastname" name="lastname" type="text" value="'.$accInfo['nama_blk'].'">
										<br/>
									</td></tr>
									<tr><td>No. Telepon</td><td>
										<input class="form-control" placeholder="No. Telepon" id="phone" name="phone" type="phone" value="'.$accInfo['no_tlp'].'">
										<br/>
									</td></tr>
									<tr><td>Surel</td><td>
										<input class="form-control" placeholder="Surel" id="email" name="email" type="text" value="'.$accInfo['surel'].'">
										<br/>
									</td></tr>
									<tr><td>Alamat</td><td>
										<input class="form-control" placeholder="Alamat" id="address" name="address" type="textbox" value="'.$accInfo['alamat'].'">
										<br/>
									</td></tr>
									<tr><td align="right" colspan="2">
										<button class="btn btn-md btn-primary">Kirim</button>
									</td></tr>
									</form>	
									</table>
					</div>
			</div><!--/.col-->';
		}
		elseif (isset($_GET['show']) and ($_GET["show"])=="editOnShow=2")
		{ 
			echo '
				<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Akun
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
									<table width="100%">
									<form role="form" action="engine/recorder.php?status=submitEdit=2" method="post">
									<fieldset>
									<tr><td>NIK</td><td>
										<input class="form-control" placeholder="NIK" id ="id" name="id" type="text" value="'.$accInfo['nik'].'"readonly>
										<br/>
									</td></tr>
									<tr><td>Username</td><td>
										<input class="form-control" placeholder="Username" id="uname" name="uname" type="text" value="'.$accInfo['username'].'">
										<br/>
									</td></tr>
									<tr><td>Password</td><td>
										<input class="form-control" placeholder="Password" id="password" name="password" type="password" value="'.$accInfo['password'].'">
										<br/>
									</td></tr>
									<tr><td align="right" colspan="2">
										<button class="btn btn-md btn-primary">kirim</button>
									</td></tr>
									</form>	
									</table>
					</div>
				</div>
	
			</div><!--/.col-->';
		}
		elseif (isset($_GET['show']) and ($_GET["show"])=="editOnShow=3")
		{ 
			echo '
				<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Foto Profil
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
					<center>
					<img width="30%" src="data:image/jpeg;base64,'.base64_encode( $imgData['foto'] ).'" class="img-responsive" alt=""/>
					</center>
					<br/>
					<form action="engine/recorder.php?status=submitEdit=3" method="post" enctype="multipart/form-data">
					Pilih file:
					<input class="form-control" type="file" name="image"/>
					<br/>
					<div align="right"><button class="btn btn-md btn-primary">Kirim</button></div>
					</form>
					</div>
				</div>
			</div><!--/.col-->';
		}
		?>
		<div class="col-sm-12">
				<p class="back-link">TabunganKu: Sistem Informasi Tabungan Kelas Ver. 0.0.1 BETA</p>
			</div>
		</div><!--/.row-->';
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/custom2.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>
