<?php
session_start();
$userlogin=$_SESSION['login'];
include("../bd.php");


	class img
	{
		private $image;
		private $ox;
		private $oy;
		private $ny;
		private $final_width_of_image=256;
		private $nm;
		private $fname;
		
		public function dovar()
		{
			$this->ox=imagesx($this->image);
			$this->oy=imagesy($this->image);
			$this->ny=floor($this->oy * ($this->final_width_of_image / $this->ox));
			$this->nm=imagecreatetruecolor($this->final_width_of_image, $this->ny);
		}
		
		public function __construct($filename)
		{
			switch($this->getextension($filename))
			{
				case "jpg":$this->image=imagecreatefromjpeg($filename);break;
				case "jpeg":$this->image=imagecreatefromjpeg($filename);break;
				case "png":$this->image=imagecreatefrompng($filename);break;
				case "gif":$this->image=imagecreatefromgif($filename);break;
				case "bmp":$this->image=imagecreatefromwbmp($filename);break;
				case "JPG":$this->image=imagecreatefromjpeg($filename);break;
				case "JPEG":$this->image=imagecreatefromjpeg($filename);break;
				case "PNG":$this->image=imagecreatefrompng($filename);break;
				case "GIF":$this->image=imagecreatefromgif($filename);break;
				case "BMP":$this->image=imagecreatefromwbmp($filename);break;
				default:die();break;
			}
			$this->fname=$filename;
			$this->dovar();
		}
		
		public function getextension($filename)
		{
			return array_pop(explode(".",$filename));
		}
		
		public function resize()
		{
			imagecopyresampled($this->nm, $this->image, 0,0,0,0,$this->final_width_of_image,$this->ny,$this->ox,$this->oy);
			if(imagejpeg($this->nm,$this->fname))return true;else return false;
		}
	}
	
	if(isset($_FILES['avatar']['tmp_name']))
	{
	if(is_uploaded_file($_FILES['avatar']['tmp_name']))
	{
		function getextension($filename)
		{
			return array_pop(explode(".",$filename));
		}


		$ext=getextension($_FILES['avatar']['name']);
		switch($ext)
			{
				case "jpg":;break;
				case "jpeg":;break;
				case "png":;break;
				case "gif":;break;
				case "bmp":;break;
				case "JPG":;break;
				case "JPEG":;break;
				case "PNG":;break;
				case "GIF":;break;
				case "BMP":;break;
				default:die();break;
			}


		$t=mysql_query("SELECT `avatar` FROM `users` WHERE `login`='$login' ");
		$y=mysql_fetch_array($t);
		$old=$y['avatar'];
		unlink("../avatars/".$old);
		
		$rand=rand(11111,99999);
		 $name=$userlogin.$rand;
		 $onlyname=$name.".".getextension($_FILES['avatar']['name']);
		 $avaname="../avatars/".$name.".".getextension($_FILES['avatar']['name']);

		 move_uploaded_file($_FILES['avatar']['tmp_name'],$avaname);
		 
		 $imgres=new img($avaname);
		 $imgres->resize();
 
		$r=mysql_query("UPDATE `users` SET `avatar`='$onlyname'  WHERE `login`='$userlogin' ");
		
		
	}
	else die("Вы должны загрузить все файлы!");
	}
	else
	{
		die("Вы должны загрузить все файлы!");
	}
?>













