<?php
   include('engine/session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TabunganKu: Data Nasabah</title>
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
			<li class="parent active"><a data-toggle="collapse" href="#sub-item-2">
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
			<li class="parent "><a data-toggle="collapse" href="#sub-item-3">
				<em class="fa fa-file-text">&nbsp;</em> Laporan <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-3">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Lap. Penyetoran
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Lap. Penarikan
					</a></li>
				</ul>
			</li>
			<li><a href="settings.php?show=1"><em class="fa fa-cog">&nbsp;</em> Pengaturan</a></li>
			<li><a href="engine/logout.php"><em class="fa fa-power-off">&nbsp;</em> Keluar</a></li>
		</ul>
	</div><!--/.sidebar-->
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Data Nasabah / Detail</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<!--page title-->
			</div>
		</div><!--/.row-->
		
	<div class="panel panel-container">
			<?php
			$acnum = $_REQUEST['account'];
			$fetchAccInfo = mysqli_query($conn,"SELECT no_rek, nama, nama_blk, password, gender, kelas, no_tlp,alamat,surel FROM nasabah WHERE no_rek = '$acnum'");
			$accInfo = mysqli_fetch_array($fetchAccInfo,MYSQLI_ASSOC);
			if (isset($_GET['show']) and ($_GET["show"])=="details")
		{
		echo '
		
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default ">
					<div class="panel-heading">
						Detail
					</div>
					<div class="panel-body">
						<table width="100%">
									<form role="form" method="post" action="engine/clientedit.php?status=1">
									<fieldset><tr><td>No. Rekening</td><td>
										<input class="form-control" placeholder="No. Rekening" id ="id" name="id" type="text" value="'.$accInfo['no_rek'].'" readonly>
										<br/>
									</td></tr>
									<tr><td>Password</td><td>
										<input class="form-control" placeholder="Password" id="password" name="password" type="password" value="'.$accInfo['password'].'"readonly>
										<br/>
									</td></tr>
									<tr><td>Nama Depan</td><td>
										<input class="form-control" placeholder="name" id ="name" name="name" type="text" value="'.$accInfo['nama'].'"readonly>
										<br/>
									</td></tr>
									<tr><td>Nama Belakang</td><td>
										<input class="form-control" placeholder="lastname" id ="lastname" name="lastname" type="text" value="'.$accInfo['nama_blk'].'"readonly>
										<br/>
									</td></tr>
									<tr><td>Gender</td><td>
										<select class="form-control" name="gender" id="gender" readonly>
										<option value="'.$accInfo['gender'].'">'.$accInfo['gender'].'</option>
								</select>
										<br/>
									</td></tr>
									<tr><td>Kelas</td><td>
										<input class="form-control" placeholder="kelas" id ="class" name="class" type="text" value="'.$accInfo['kelas'].'"readonly>
										<br/>
									</td></tr>
									<tr><td>No. Telepon</td><td>
										<input class="form-control" placeholder="No. Telepon" id="uname" name="phone" type="number" value="'.$accInfo['no_tlp'].'"readonly>
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
										<button class="btn btn-md btn-primary" id="editProfile" style="visibility:hidden;">Ubah</button>
									</td></tr>
									</form>	
									</table>
					</div>
				</div>
			</div><!--/.col-->
			
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						
						</div>
					<div class="panel-body">';
								echo '<center>';
									$result = $conn->query("SELECT foto FROM foto WHERE id_foto ='$acnum'");
									if($result->num_rows > 0){
										$imgData = $result->fetch_assoc();
										//Render image 
										echo '<img src="data:image/jpeg;base64,'.base64_encode( $imgData['foto'] ).'" class="img-responsive" alt="" width="300px"/>'; 
									}else{
										echo '<img src="engine/userdefault.png" class="img-responsive" alt="" width="300px">';
									}
										echo '
											<br/>
											
													<a href="?account='.$acnum.'&show=editClientPhoto"><button class="btn btn-md btn-primary" id="editPhoto" style="visibility:hidden;">Ubah</button></a>
											
											</center>
					</div>
				
				</div>
					
			</div><!--/.col-->
			<div class="panel-body" align="right">
		<div class="col-md-12">
			<button class="btn btn-md btn-warning" id="cancel" style="visibility:hidden;">Batal</button>
			<button class="btn btn-md btn-primary" id="edit">Ubah</button>
			<a href="engine/deletion.php?account='.$acnum.'&status=confirmation"><button class="btn btn-md btn-danger" id="delete"><em class="fa fa-lock"></em> Hapus</button></a>
		</div>
		</div>
		';
	}
		if (isset($_GET['show']) and ($_GET["show"])=="editClientPhoto")
		{ 
			echo '
				<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Foto Profil
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
					<center>';
					$result = $conn->query("SELECT foto FROM foto WHERE id_foto ='$acnum'");
					if($result->num_rows > 0){
					$imgData = $result->fetch_assoc();
					//Render image 
					echo '<img src="data:image/jpeg;base64,'.base64_encode( $imgData['foto'] ).'" class="img-responsive" alt=""/>';
					echo '
					</center>
					<br/>
					<form action="engine/clientedit.php?status=editClientPhoto" method="post" enctype="multipart/form-data">
					<input class="form-control" placeholder="No. Rekening" id ="id" name="id" type="hidden" value="'.$accInfo['no_rek'].'" readonly>
					Pilih file:
					<input class="form-control" type="file" name="image"/>
					<br/>
					<div align="right"><button class="btn btn-md btn-primary">Kirim</button></div>
					</form>
					</div>
					</div>
					</div><!--/.col-->';
					}
					else
					{
						echo '<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">';
						echo '
							</center>
							<br/>
							<form action="../engine/clientrecorder.php?status=submitNew=1" method="post" enctype="multipart/form-data">
							Pilih file:
							<input class="form-control" type="file" name="image"/>
							<br/>
							<div align="right"><button class="btn btn-md btn-primary">Kirim</button></div>
							</form>
							</div>
							</div>
							</div><!--/.col-->';
					}
					;
		}
			?>
			</div><!--/.row-->
		</div>
	<!--panels were here-->
			<div class="col-sm-12">
				<p class="back-link">TabunganKu: Sistem Informasi Tabungan Kelas Ver. 0.0.1 BETA <!--a href="https://www.medialoot.com">Medialoot</a--></p>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/lookup.js"></script>
	<script src="js/formhideshow.js"></script>
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
