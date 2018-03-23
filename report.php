<?php
   include('engine/session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TabunganKu: Laporan</title>
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
			<li class="parent"><a data-toggle="collapse" href="#sub-item-2">
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
			<li class="parent active"><a data-toggle="collapse" href="#sub-item-3">
				<em class="fa fa-file-text">&nbsp;</em> Laporan <span data-toggle="collapse" href="#sub-item-3" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-3">
					<li><a class="" href="?show=deposit">
						<span class="fa fa-arrow-right">&nbsp;</span> Lap. Penyetoran
					</a></li>
					<li><a class="" href="?show=withdrawal">
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
					<div class="panel-body" align="left">
			<?php
				if (isset($_GET['show']) and ($_GET["show"])=="deposit")
				{
					$date = date("d/m/Y");
					echo '
						<h2 align="left">Laporan Penyetoran</h2> 
						<table>
						<tr>
						<td>Dari Tanggal&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>
						<input class="form-control" type="date" id="dt" onchange="mydate1();" />
						<input class="form-control" type="hidden" value="'.$date.'" id="ndt" name="date1" onclick="mydate();" />
						<td>&nbsp</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;sampai Tanggal&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>
						<input class="form-control" type="date" id="dt2" onchange="mydate1();" />
						<input class="form-control" type="hidden" value="'.$date.'" id="ndt2" name="date2" onclick="mydate();" />
						</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-md btn-primary" id="show" onclick="showByDate()">Cari</button></td>
						</tr></table>
						<br/>
					';
					echo '<div align="right"><table class="table" id="reportTable">';
					echo '<tr><td>No. Rekening</td><td>Nama</td><td>Tanggal</td><td>Jam</td><td>Saldo Awal</td><td>Nominal</td><td>Saldo Akhir</td></tr>';
					$query = "SELECT transaksi.no_rek, CONCAT(nasabah.nama,' ', nasabah.nama_blk) AS nama, transaksi.tanggal, transaksi.jam,  transaksi.saldo_awal, transaksi.nominal, transaksi.saldo_akhir 
								FROM nasabah,transaksi WHERE transaksi.no_rek=nasabah.no_rek AND transaksi.jenis='setor'";
					$result = mysqli_query($conn,$query);
					while ($row = mysqli_fetch_array($result))
						{
							echo '<tr><td>'.$row['no_rek'].'</td>';
							echo '<td>'.$row['nama'].'</td>';
							echo '<td>'.$row['tanggal'].'</td>';
							echo '<td>'.$row['jam'].'</td>';
							echo '<td>'; echo money_format('%.2n', $row['saldo_awal']);echo '</td>';
							echo '<td>'; echo money_format('%.2n', $row['nominal']);echo '</td>';
							echo '<td>'; echo money_format('%.2n', $row['saldo_akhir']);echo '</td>';
						}
					echo '</tr></table>';
					echo '</table></div>';
					mysqli_close($conn);
				}
				if (isset($_GET['show']) and ($_GET["show"])=="withdrawal")
				{
					$date = date("d/m/Y");
					echo '
						<h2 align="left">Laporan Penarikan</h2> 
						<table>
						<tr>
						<td>Dari Tanggal&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>
						<input class="form-control" type="date" id="dt" onchange="mydate1();" />
						<input class="form-control" type="hidden" value="'.$date.'" id="ndt" name="date1" onclick="mydate();" />
						<td>&nbsp</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;sampai Tanggal&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>
						<input class="form-control" type="date" id="dt2" onchange="mydate1();" />
						<input class="form-control" type="hidden" value="'.$date.'" id="ndt2" name="date2" onclick="mydate();" />
						</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-md btn-primary" id="show" onclick="showByDate()">Cari</button></td>
						</tr></table>
						<br/>
					';
					echo '<div align="right"><table class="table" id="reportTable">';
					echo '<tr><td>No. Rekening</td><td>Nama</td><td>Tanggal</td><td>Jam</td><td>Saldo Awal</td><td>Nominal</td><td>Saldo Akhir</td></tr>';
					$query = "SELECT transaksi.no_rek, CONCAT(nasabah.nama,' ', nasabah.nama_blk) AS nama, transaksi.tanggal, transaksi.jam,  transaksi.saldo_awal, transaksi.nominal, transaksi.saldo_akhir 
								FROM nasabah,transaksi WHERE transaksi.no_rek=nasabah.no_rek AND transaksi.jenis='tarik'";
					$result = mysqli_query($conn,$query);
					while ($row = mysqli_fetch_array($result))
						{
							echo '<tr><td>'.$row['no_rek'].'</td>';
							echo '<td>'.$row['nama'].'</td>';
							echo '<td>'.$row['tanggal'].'</td>';
							echo '<td>'.$row['jam'].'</td>';
							echo '<td>'; echo money_format('%.2n', $row['saldo_awal']);echo '</td>';
							echo '<td>'; echo money_format('%.2n', $row['nominal']);echo '</td>';
							echo '<td>'; echo money_format('%.2n', $row['saldo_akhir']);echo '</td>';
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
	<script>
	function mydate()
	{
  //alert("");
		document.getElementById("dt").hidden=false;
		document.getElementById("ndt").hidden=true;
		document.getElementById("dt2").hidden=false;
		document.getElementById("ndt2").hidden=true;
	}
	function mydate1()
	{
		d=new Date(document.getElementById("dt").value);
		dt=d.getDate();
		mn=d.getMonth();
		mn++;
		yy=d.getFullYear();
		document.getElementById("ndt").value=dt+"/"+mn+"/"+yy
		document.getElementById("ndt").hidden=false;
		document.getElementById("dt").hidden=true;
		
		t=new Date(document.getElementById("dt2").value);
		dt2=t.getDate();
		mn2=t.getMonth();
		mn2++;
		yy2=t.getFullYear();
		document.getElementById("ndt2").value=dt2+"/"+mn2+"/"+yy2
		document.getElementById("ndt2").hidden=false;
		document.getElementById("dt2").hidden=true;
}
	</script>
		
</body>
</html>
