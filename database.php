<?php 

class database
{
	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $db = "enkripsi2arah";
	protected $koneksi;
	public function __construct()
	{
		try
		{
			$this->koneksi = new PDO("mysql:host=$this->host; dbname=$this->db",$this->user, $this->pass);
			$this->koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $this->koneksi;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		

	}
}
?>
