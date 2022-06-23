<?php 
	require_once('database.php');
	require_once('function.php');
	$obj=new mainenkripsi;
	$error = array();
	if(isset($_POST['simpan_password']))
	{
		if(empty($_POST['username']))
		{
			array_push($error, 'Username harus diisi');
		}
		else
		{
			$username = $_POST['username'];

		}
		if(empty($_POST['password']))
		{
			array_push($error, 'password tidak boleh kosong');
		}
		else{
			$password = trim($_POST['password']);
			
		}
		if(count($error)==0)
		{
			if($obj->simpan_password($username, $password))
			{
				echo 'password berhasil disimpan';
			}
			else
			{
				echo 'password gagal disimpan';

			}
		}
		if(count($error)>0)
		{
			foreach ($data as $error) {
				echo  $error;
			}
		}

	}
	if(isset($_POST['cek_password']))
	{
		if(empty($_POST['username']))
		{
			array_push($error, 'Username harus diisi');
		}
		else
		{
			$username = $_POST['username'];

		}
		if(empty($_POST['password']))
		{
			array_push($error, 'password tidak boleh kosong');
		}
		else{
			$password = trim($_POST['password']);
			
		}
		if(count($error)==0)
		{
			if($obj->login_hash($username, $password))
			{
				echo 'password cocok';
			}
			else
			{
				echo 'password tidak cocok';

			}
		}
		if(count($error)>0)
		{
			foreach ($data as $error) {
				echo  $error;
			}
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Enkripsi 2 Arah</title>
	<style type="text/css">
		table.items {
		  font-size: 12pt; 
		  border-collapse: collapse;
		  border: 3px solid #880000; 
		}
		td { vertical-align: top; 
		}
		table thead th { background-color: #EEEEEE;
		  text-align: center;
		}
		table tfoot td { background-color: #AAFFEE;
		  text-align: center;
		}
		.container{ margin: 15px; }
		
	</style>
</head>
<body>
<div class="container" align="center">
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">	
		<table class="items" width="50%" cellpadding="8" border="1">
			<thead>
				<th colspan="3"><h3>Test Menyimpan Password Enkripsi 2 Arah - root93.co.id</h3></th>
			</thead>
			<tr>
				<td><input type="text" name="username" placeholder="username" required="" /></td>
				<td><input type="password" name="password"/></td>
				<td><input type="submit" value="simpan" name="simpan_password" placeholder="password" required="" /></td>
			</tr>
		</table>
	</form>
	</table>
	<table class="items" width="50%" cellpadding="8" border="1">
		<thead>

			<tr>
				<th colspan="3"><h3>Cara membuat enkripsi 2 arah dengan PHP - root93.co.id</h3></th>
			</tr>

		</thead>
		<tbody>
			<tr>
				<th>Username</th>
				<th>Hasil Enkripsi</th>
				<th>Hasil Dekripsi</th>
			</tr>
			<?php 

				$data=$obj->tampil_enkripsi();
				while($row=$data->fetch(PDO::FETCH_ASSOC))
				{
					?>
					<tr>
						<td><?=$row['username']?></td>
						<td><?=$row['password']?></td>
						<td><?=$obj->dekripsi($row['password'])?></td>
					</tr>
				<?php }?>
			

		</tbody>
		
	</table>
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">	
		<table class="items" width="50%" cellpadding="8" border="1">
			<thead>
				<th colspan="3"><h3>Test Penecocokan Password Enkripsi 2 Arah - root93.co.id</h3></th>
			</thead>
			<tr>
				<td><input type="text" name="username" placeholder="username" required="" /></td>
				<td><input type="password" name="password" placeholder="password"  required="" /></td>
				<td><input type="submit" value="test" name="cek_password" placeholder="password" required="" /></td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>



