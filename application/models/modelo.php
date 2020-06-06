<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class modelo extends CI_Model{
	
	function __construct(){
		parent::__construct();
	}

	//---------------Consultas en la base de datos------------//
	public function validaUsuario($data){

		$cadena="select idAdministrador, nombre, tipo from Administrador where ((correo='".$data['correo']."' or nombre = '".$data['correo']."') and contraseña='".$data['contraseña']."') union select idUsuario, nombre, tipo from Usuario where (correo='".$data['correo']."' and contraseña='".$data['contraseña']."') union select idDentista, nombre, tipo from Dentista where (correo='".$data['correo']."' and contraseña='".$data['contraseña']."')";
		
		$query = $this->db->query($cadena);
		
		if ($query->num_rows() > 0){
			return $query;
		}
		else{
			return FALSE;
		}
	}

	public function obtenerSolicitudes(){
		$cadena="select * from Solicitudes order by idSolicitud";

		$query = $this->db->query($cadena);

		if ($query->num_rows() > 0){
			return $query;
		}
		else{
			return FALSE;
		}
	}

	public function obtenerDatosSolicitud($data){
		$cadena="select * from Solicitudes where idSolicitud=".$data["idSolicitud"];

		$query = $this->db->query($cadena);

		if ($query->num_rows() > 0){
			return $query;
		}
		else{
			return FALSE;
		}
	}

	public function obtenerCitas(){

		$cadena="select * from Citas order by fecha, hora";

		$query = $this->db->query($cadena);

		if ($query->num_rows() > 0){
			return $query;
		}
		else{
			return FALSE;
		}
	}

	public function obtenerDentistas(){
		$cadena="select * from Dentista order by idDentista";

		$query = $this->db->query($cadena);

		if ($query->num_rows() > 0){
			return $query;
		}
		else{
			return FALSE;
		}
	}

	public function obtenerUsuarios(){
		$cadena="select * from Usuario order by idUsuario";

		$query = $this->db->query($cadena);

		if ($query->num_rows() > 0){
			return $query;
		}
		else{
			return FALSE;
		}
	}

	public function obtenerUsuario($data){
		$cadena="select * from Usuario where idUsuario=".$data["idUsuario"];

		$query = $this->db->query($cadena);

		if ($query->num_rows() > 0){
			return $query;
		}
		else{
			return FALSE;
		}
	}

	public function obtenerDentista($data){
		$cadena="select * from Dentista where idDentista=".$data["idDentista"];

		$query = $this->db->query($cadena);

		if ($query->num_rows() > 0){
			return $query;
		}
		else{
			return FALSE;
		}
	}
	//--------------------------------------------------------//

	//----------Manejar usuarios en la base de datos----------//
	public function añadirCita($data){
		$cadena="insert into Citas(fecha, hora, idUsuario, idDentista) values('".$data["fecha"]."', '".$data["hora"]."', ".$data["idUsuario"].",".$data["dentista"].")";
		
		$this->db->query($cadena);
	}

	public function modificarCita($data){
		$cadena="update Citas set fecha='".$data["fecha"]."', hora='".$data["hora"]."' where idCita=".$data["idCita"];

		$this->db->query($cadena);
	}

	public function eliminarCita($data){

		$cadena="delete from Citas where idCita=".$data['idCita'];
		
		$this->db->query($cadena);
	}
	//--------------------------------------------------------//

	//----------Manejar usuarios en la base de datos----------//
	public function agregarUsuario($data){
		$cadena="insert into Usuario(nombre, apellidos, telefono, direccion, correo, contraseña) values('".$data["nombre"]."', '".$data["apellidos"]."', ".$data["telefono"].",'".$data["direccion"]."','".$data["correo"]."','".$data["contraseña"]."')";
		
		$this->db->query($cadena);
	}

	public function actualizarUsuario($data){
		$cadena="update Usuario set telefono=".$data["telefono"].", direccion='".$data["direccion"]."', correo='".$data["correo"]."' where idUsuario=".$data["idUsuario"];
		
		$this->db->query($cadena);
	}

	public function agregarSolicitudDentista($data){
		$cadena="insert into Solicitudes(nombre, apellidos, cedula, telefono, direccion, descripcion, correo, contraseña) values('".$data["nombre"]."', '".$data["apellidos"]."', ".$data["cedula"].",".$data["telefono"].",'".$data["direccion"]."','".$data["descripcion"]."','".$data["correo"]."','".$data["contraseña"]."')";
		
		$this->db->query($cadena);
	}

	public function agregarDentista($data){
		$cadena="insert into Dentista(nombre, apellidos, cedula, telefono, direccion, descripcion, correo, contraseña) values('".$data["nombre"]."', '".$data["apellidos"]."', ".$data["cedula"].",".$data["telefono"].",'".$data["direccion"]."','".$data["descripcion"]."','".$data["correo"]."','".$data["contraseña"]."')";
		
		$this->db->query($cadena);
	}

	public function actualizarDentista($data){
		$cadena="update Dentista set telefono=".$data["telefono"].", direccion='".$data["direccion"]."', descripcion='".$data["descripcion"]."', correo='".$data["correo"]."' where idDentista=".$data["idDentista"];
		
		$this->db->query($cadena);
	}

	public function eliminarSolicitud($data){

		$cadena="delete from Solicitudes where idSolicitud=".$data["idSolicitud"];

		$this->db->query($cadena);
	}
	//--------------------------------------------------------//
}