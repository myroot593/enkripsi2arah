<?php 

class mainenkripsi extends database
{
	# fungsi untuk mengenkripsi password
	public function enkripsi($data)
	{
		$arr=range('a','z'); //nilai yang akan dienkripsi a-z
		$arr2=range(100,126); //hasil nilai enkripsi direplace kedalam bentuk angka 100-126
		$result=str_replace($arr, $arr2, $data);
		return $result;
	}
	
	public function dekripsi($data)
	{
		$arr=range(100,126);
		$arr2=range('a','z');
		$result=str_replace($arr, $arr2, $data);
		return $result;
	}
	public function simpan_password($username, $pass)
	{
		try
		{
			$sql = "INSERT INTO login_user (username, password) VALUES (:username, :password)";
			$stmt=$this->koneksi->prepare($sql);
			$stmt->bindParam(":username", $username);
			$stmt->bindParam(":password", $this->enkripsi($pass)); //menyimpan password berdasarkan enkripsi
			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	//fungsi untuk mengecek kecocokan password yang telah dienkripsi dengan 2 arah
	public function login_hash($username, $pass)
	{
		try
		{
			$sql = "SELECT username, password FROM login_user WHERE username=:username";
			$stmt=$this->koneksi->prepare($sql);
			$stmt->bindParam(":username", $username);
			$stmt->execute();
			$stmt->bindColumn("username", $this->username);
			$stmt->bindColumn("password", $this->pass);
			$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount()==1)
			{
				//mencocokan $pass input user dengan $this->pass hasil enkripsi 2 arah
				if($this->enkripsi($pass)==$this->pass)
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	//menampilkan username dan password yang sudah tersimpan
	public function tampil_enkripsi()
	{
		try
		{
			$sql = "SELECT username, password FROM login_user";
			$stmt=$this->koneksi->prepare($sql);
			$stmt->execute();
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

}
