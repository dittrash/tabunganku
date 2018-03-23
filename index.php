<?php
   include('engine/session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TabunganKu: Dasbor</title>
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
			<li class="active"><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dasbor</a></li>
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
							<h1>Total Saldo</h1>
							<div class="large">
								<?php
									$result= mysqli_query($conn,"SELECT SUM(saldo) AS value_sum FROM nasabah");
									$row = mysqli_fetch_array($result,MYSQLI_ASSOC); 
									$sum = $row['value_sum'];
									setlocale(LC_MONETARY, 'id_ID');
									echo money_format('%.2n', $sum);
								?>
							</div>
							<div class="text-muted">*dari seluruh nasabah</div>			
						</div>
					</div>
				</div>
				<div class="no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><h1>Total Nasabah</h1>
							<div class="large">
							<?php
								$result = mysqli_query($conn,"SELECT * FROM nasabah");
								$row = mysqli_num_rows($result);
								echo $row;
							?>
							</div>
							<div class="text-muted">nasabah yang terdaftar</div>
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
							$result = mysqli_query($conn,"SELECT CONCAT(nasabah.nama,' ', nasabah.nama_blk) AS nama, transaksi.jenis, transaksi.tanggal,  transaksi.saldo_awal, transaksi.nominal, transaksi.saldo_akhir FROM nasabah,transaksi WHERE transaksi.no_rek=nasabah.no_rek ORDER BY id DESC LIMIT 5");
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
				<!--div class="panel panel-default">
					<div class="panel-heading">
						To-do List
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-cogs"></em>
							</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 1
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 2
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 3
											</a></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body">
						<ul class="todo-list">
							<li class="todo-list-item">
								<div class="checkbox">
									<input type="checkbox" id="checkbox-1" />
									<label for="checkbox-1">Make coffee</label>
								</div>
								<div class="pull-right action-buttons"><a href="#" class="trash">
									<em class="fa fa-trash"></em>
								</a></div>
							</li>
							<li class="todo-list-item">
								<div class="checkbox">
									<input type="checkbox" id="checkbox-2" />
									<label for="checkbox-2">Check emails</label>
								</div>
								<div class="pull-right action-buttons"><a href="#" class="trash">
									<em class="fa fa-trash"></em>
								</a></div>
							</li>
							<li class="todo-list-item">
								<div class="checkbox">
									<input type="checkbox" id="checkbox-3" />
									<label for="checkbox-3">Reply to Jane</label>
								</div>
								<div class="pull-right action-buttons"><a href="#" class="trash">
									<em class="fa fa-trash"></em>
								</a></div>
							</li>
							<li class="todo-list-item">
								<div class="checkbox">
									<input type="checkbox" id="checkbox-4" />
									<label for="checkbox-4">Make more coffee</label>
								</div>
								<div class="pull-right action-buttons"><a href="#" class="trash">
									<em class="fa fa-trash"></em>
								</a></div>
							</li>
							<li class="todo-list-item">
								<div class="checkbox">
									<input type="checkbox" id="checkbox-5" />
									<label for="checkbox-5">Work on the new design</label>
								</div>
								<div class="pull-right action-buttons"><a href="#" class="trash">
									<em class="fa fa-trash"></em>
								</a></div>
							</li>
							<li class="todo-list-item">
								<div class="checkbox">
									<input type="checkbox" id="checkbox-6" />
									<label for="checkbox-6">Get feedback on design</label>
								</div>
								<div class="pull-right action-buttons"><a href="#" class="trash">
									<em class="fa fa-trash"></em>
								</a></div>
							</li>
						</ul>
					</div>
					<div class="panel-footer">
						<div class="input-group">
							<input id="btn-input" type="text" class="form-control input-md" placeholder="Add new task" /><span class="input-group-btn">
								<button class="btn btn-primary btn-md" id="btn-todo">Add</button>
						</span></div>
					</div>
				</div>
			</div><!--/.col-->
			
			
			<!--div class="col-md-6">
				<div class="panel panel-default ">
					<div class="panel-heading">
						Timeline
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-cogs"></em>
							</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 1
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 2
											</a></li>
											<li class="divider"></li>
											<li><a href="#">
												<em class="fa fa-cog"></em> Settings 3
											</a></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div class="panel-body timeline-container">
						<ul class="timeline">
							<li>
								<div class="timeline-badge"><em class="glyphicon glyphicon-pushpin"></em></div>
								<div class="timeline-panel">
									<div class="timeline-heading">
										<h4 class="timeline-title">Lorem ipsum dolor sit amet</h4>
									</div>
									<div class="timeline-body">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer at sodales nisl. Donec malesuada orci ornare risus finibus feugiat.</p>
									</div>
								</div>
							</li>
							<li>
								<div class="timeline-badge primary"><em class="glyphicon glyphicon-link"></em></div>
								<div class="timeline-panel">
									<div class="timeline-heading">
										<h4 class="timeline-title">Lorem ipsum dolor sit amet</h4>
									</div>
									<div class="timeline-body">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</div>
								</div>
							</li>
							<li>
								<div class="timeline-badge"><em class="glyphicon glyphicon-camera"></em></div>
								<div class="timeline-panel">
									<div class="timeline-heading">
										<h4 class="timeline-title">Lorem ipsum dolor sit amet</h4>
									</div>
									<div class="timeline-body">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer at sodales nisl. Donec malesuada orci ornare risus finibus feugiat.</p>
									</div>
								</div>
							</li>
							<li>
								<div class="timeline-badge"><em class="glyphicon glyphicon-paperclip"></em></div>
								<div class="timeline-panel">
									<div class="timeline-heading">
										<h4 class="timeline-title">Lorem ipsum dolor sit amet</h4>
									</div>
									<div class="timeline-body">
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div><!--/.col-->
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
