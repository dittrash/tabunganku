<?php
   include('../engine/clientsession.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TabunganKu: Dasbor</title>
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css" rel="stylesheet">
	
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
				$result = $conn->query("SELECT foto FROM foto WHERE id_foto ='$login_acnum'");
				if($result->num_rows > 0){
				$imgData = $result->fetch_assoc();
				//Render image 
				echo '<img src="data:image/jpeg;base64,'.base64_encode( $imgData['foto'] ).'" class="img-responsive" alt=""/>'; 
				}else{
				echo '<img src="../engine/userdefault.png" class="img-responsive" alt="">';
				}
				?>
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo("{$login_name} {$login_lastName}") ?></div>
				<div class="profile-usertitle-status"><?php echo("Rek: {$login_acnum}") ?></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<!--form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form-->
		<ul class="nav menu">
			<li class="active"><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dasbor</a></li>
			
			</li>
			
			</li>
			</li>
			<li><a href="settings.php?show=1"><em class="fa fa-cog">&nbsp;</em> Pengaturan</a></li>
			<li><a href="../engine/logout.php?status=client"><em class="fa fa-power-off">&nbsp;</em> Keluar</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Beranda</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Halo, <?php echo("{$login_name}") ?></h1>
			</div>
		</div><!--/.row-->
		
	<div class="panel panel-container">
			<div class="row">
				<div class="no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding">
							<h1>Saldo</h1>
							<div class="large">
								<?php
									$result= mysqli_query($conn,"SELECT saldo FROM nasabah WHERE no_rek = '$login_acnum'");
									$row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
									$bal = $row['saldo'];
									setlocale(LC_MONETARY, 'id_ID');
									echo money_format('%.2n', $bal);
								?>
							</div>	
						</div>
					</div>
				</div>
			</div><!--/.row-->
		</div>
		<div class="row">
			<div class="col-md-12">

			</div>
		</div><!--/.row-->
		

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default chat">
					<div class="panel-heading">
						Transaksi Terakhir
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<!--data table-->
						<?php
							echo '<table class="table">';
							echo '<tr><td>Nama</td><td>Jenis</td><td>Tanggal</td><td>Saldo Awal</td><td>Nominal</td><td>Saldo Akhir</td></tr>';
							$result = mysqli_query($conn,"SELECT nasabah.nama, transaksi.jenis, transaksi.tanggal,  transaksi.saldo_awal, transaksi.nominal, transaksi.saldo_akhir FROM nasabah,transaksi WHERE transaksi.no_rek=nasabah.no_rek AND transaksi.no_rek='$login_acnum' ORDER BY id DESC LIMIT 5");
							for ($i=5;$i>0;$i--)
							{
								while ($row = mysqli_fetch_array($result))
								{
									echo '<tr><td>'.$row['nama'].'</td>';
									echo '<td>'.$row['jenis'].'</td>';
									echo '<td>'.$row['tanggal'].'</td>';
									echo '<td>'; echo money_format('%.2n', $row['saldo_awal']);echo '</td>';
									echo '<td>'; echo money_format('%.2n', $row['nominal']);echo '</td>';
									echo '<td>'; echo money_format('%.2n', $row['saldo_akhir']);echo '</td>';
								}
							}
							echo '</tr></table>';
						?>
					</div>
				</div>
		
			</div><!--/.col-->
			
			
			
			<div class="col-sm-12">
				<p class="back-link">TabunganKu: Sistem Informasi Tabungan Kelas Ver. 0.0.1 BETA <!--a href="https://www.medialoot.com">Medialoot</a--></p>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	
	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/chart.min.js"></script>
	<script src="../js/chart-data.js"></script>
	<script src="../js/easypiechart.js"></script>
	<script src="../js/easypiechart-data.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="../js/custom.js"></script>
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
