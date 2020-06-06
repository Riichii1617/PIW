<?php

	$conexion=mysql_connect('localhost','root','','piw');

	$nombre=$_POST['NOMBRE'];
	$apellido=$_POST['APELLIDO'];
	$direccion=$_POST['DIRECCION'];
	$telefono=$_POST['TELEFONO'];
	$email=$_POST['EMAIL'];
	$contraseña=sha1($_POST['CONTRASEÑA']);
	
	$sql="INSERT into usuario (nombre,apellido,direccion,telefono,correo,contraseña)
			values('$nombre','$apellido','$direccion','$telefono','$email','$contraseña')";
	echo mysqli_query($conexion,$sql);

?>