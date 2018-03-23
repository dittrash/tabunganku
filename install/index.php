<?php
/*installer page
writed by Dito Aldi SP 1151500054 | Technology Institute of Indonesia
for TabunganKu web application
in help by any other sources*/

if (isset($_GET['show']) and ($_GET["show"])=="1")
{
	//form
	echo '<html>
			<head><title>Instalasi Program TabunganKu: Tabungan Kelas Kami</title></head>
			<body>
			<center/><br/><br/><br/>
				<form action="/tabunganku/install/filldata.php?status=1" method="post">
					<table>
						<tr><td colspan="2" align="center">
						<h2>Pengisian Data</h2><br/>
						<h3>Isi Data Administrator</h3>
						</td></tr>
						<tr><td>Nama</td><td>: <input type="text" name="name" id="name"></td></tr>
						<tr><td>No. Induk</td><td>: <input type="text" name="id" id="id"></td></tr>
						<tr><td>Alamat</td><td>: <input type="text" name="address" id="address"></td></tr>
						<tr><td>No. Telp</td><td>: <input type="text" name="phone" id="phone"></td></tr>
						<tr><td>Email</td><td>: <input type="text" name="email" id="email"></td></tr>
						<tr><td>Username</td><td>: <input type="text" name="uname" id="uname"></td></tr>
						<tr><td>Password</td><td>: <input type="password" name="pass" id="pass"></td></tr>
						<tr><td colspan="2" align="right"><input type="submit" value="Kirim"></td></tr>
					</table>
				</form>
			</body>
		</html>';
}
elseif (isset($_GET['show']) and ($_GET["show"])=="2")
{
	echo '<html>
			<head><title>Instalasi Program TabunganKu: Tabungan Kelas Kami</title></head>
			<body>
			<center/><br/><br/><br/>
				<form action="/tabunganku/install/filldata.php?status=2" method="post">
					<table>
						<tr><td colspan="2" align="center">
						<h2>Pengisian Data</h2><br/>
						<h3>Isi Data Sekolah</h3>
						</td></tr>
						<tr><td>Nama Sekolah</td><td>: <input type="text" name="name" id="name"></td></tr>
						<tr><td>Alamat</td><td>: <input type="text" name="address" id="address"></td></tr>
						<tr><td>No. Telp</td><td>: <input type="text" name="phone" id="phone"></td></tr>
						<tr><td>Email</td><td>: <input type="text" name="email" id="email"></td></tr>
						<tr><td>Website</td><td>: <input type="text" name="website" id="website"></td></tr>
						<tr><td colspan="2" align="right"><input type="submit" value="Kirim"></td></tr>
					</table>
				</form>
			</body>
		</html>';
}
else
{
	echo'<html>
			<head><title>Instalasi Program TabunganKu: Tabungan Kelas Kami</title></head>
			<body>
			<center/><br/><br/><br/>
				<form action="/tabunganku/install/createdb.php" method="post">
					<table>
						<tr><td colspan="2">
						<h2>Buat Pangkalan Data</h2><br/>
						</td></tr>
						<tr><td>Host</td><td>: <input type="text" name="host" id="host" value="localhost"></td></tr>
						<tr><td>Username</td><td>: <input type="text" name="uname" id="uname" value="root"></td></tr>
						<tr><td>Password</td><td>: <input type="password" name="pass" id="pass" value=""></td></tr>
						<tr><td colspan="2" align="right"><input type="submit" value="Kirim"></td></tr>
					</table>
				</form>
			</body>
		</html>';
}
?>
