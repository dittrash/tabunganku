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
					<li><a class="" href="report.php?show=deposit">
						<span class="fa fa-arrow-right">&nbsp;</span> Lap. Penyetoran
					</a></li>
					<li><a class="" href="report.php?show=withdrawal">
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
				<li class="active">Data Nasabah</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<!--page title-->
			</div>
		</div><!--/.row-->
		
	<div class="panel panel-container">
			<div class="row">
				<div class="no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding">
			<div class="col-md-12">
					<div class="panel-body">
			<?php
				if (isset($_GET['show']) and ($_GET["show"])=="1")
				{
					echo '
					<h2 align="left">Tambah Data Nasabah</h2>
					<table>
					<form role="form" action="engine/recorder.php?status=1" method="post">
						<fieldset>
							<tr><td colspan="2">
							<input class="form-control" placeholder="No. Rekening" id ="acnum" name="acnum" type="number" required>
							<br/>
							</td></tr>
							<tr><td colspan="2">
								<input class="form-control" placeholder="Password" id="password" name="password" type="password" required>
							</td></tr>
							<tr><td colspan="2" align="right">
							<input type="checkbox" onclick="showPwd()">&nbsp Lihat password
							<br/><br/>
							</td></tr>
							<tr><td>
								<input class="form-control" placeholder="Nama Depan" id="name" name="name" type="text" value="" required>
								<br/>
							</td>
							<td>
								<input class="form-control" placeholder="Nama Belakang" id="lastname" name="lastname" type="text" value="" required>
								<br/>
							</td>
							</tr>
							<tr><td colspan="2">
								<select class="form-control" name="gender" id="gender" required>
								<option value="L">Laki-Laki</option>
								<option value="P">Perempuan</option>
								</select>
								<br/>
							</td></tr>
							<tr><td colspan="2">
								<input class="form-control" placeholder="Kelas" id="class" name="class" type="text" required>
								<br/>
							</td></tr>
							<tr><td><font size="14">Rp.</font></td>
							<td>
								<input class="form-control" placeholder="Saldo Awal" id="bal" name="bal" type="number" required>
								<br/>
								</td></tr>
							<tr><td align="right" colspan="2">
								<button class="btn btn-md btn-primary">Kirim</button>
								</td></tr>
							
					</form>	
					</table>
					';
					
				}
				else
				{
					echo '
						<h2 align="left">Tabel Data Nasabah</h2> 
						<table width="100%">
						<tr>
						<td><i class="fa fa-search" aria-hidden="true"></i></td>
						<td>
						<input class="form-control" type="number" id="filterAcnum" onkeyup="filterData()" placeholder="Cari Nomor Rekening...">
						</td>
						<td>&nbsp</td>
						<td>
						<input class="form-control" type="text" id="filterName" onkeyup="filterDname()" placeholder="Cari Nama...">
						</td>
						</tr></table>
						<br/>
					';
					echo '<div align="right"><table class="table" id="dataTable">';
					echo '<tr><td>No. Rekening</td><td>Nama</td><td>Kelas</td><td>Saldo</td><td>Opsi</td></tr>';
					$result = mysqli_query($conn,"SELECT no_rek, CONCAT(nama,' ', nama_blk) AS nama, kelas, saldo FROM nasabah");
					while ($row = mysqli_fetch_array($result))
						{
							echo '<tr><td>'.$row['no_rek'].'</td>';
							echo '<td>'.$row['nama'].'</td>';
							echo '<td>'.$row['kelas'].'</td>';
							echo '<td>'; echo money_format('%.2n', $row['saldo']);echo '</td>';
							echo '<td><a href="detail.php?account='.$row['no_rek'].'&show=details"><button class="btn btn-md btn-primary">Detail</button></a></td>';
						}
					echo '</tr></table>';
					echo '</table></div>';
					mysqli_close($conn);
				}
			?>
			</div>
				
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
