<?php $conn=mysqli_connect('localhost','chanaka','1234','niyana_php');
	//check connection
	if(!$conn){
		echo 'Connection Error'.mysqli_connect_error();
	}
?>