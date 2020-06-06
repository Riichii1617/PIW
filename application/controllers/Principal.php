<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {

	//--------------------Se carga el modelo------------------//
	function __construct()
	{
		parent::__construct();
		$this->load->model('modelo');
	}
	//--------------------------------------------------------//

	//---------------------Vistas iniciales-------------------//

	//--Página de bienvenida--// Pendiente también editar navigation para no inicio de sesión
	public function index()
	{
		$this->load->view('header');
		$this->load->view('navigation');
		$this->load->view('welcome_message');
		$this->load->view('footer');
	}

	//--Formularios para registrar nuevos usuarios--//
	public function registrarUsuario(){
		$this->load->view('header');
		$this->load->view('navigation');
		$this->load->view('registration');
		$this->load->view('footer');
	}

	//--Panel de inicio--//
	public function vistaInicial()
	{
		$this->load->view('header');
		$this->load->view('navigation');
		if ($this->session->userdata('nombre')!='') {
			$this->load->view('initial');
		}
		else{
			$this->load->view('unathorized');
		}
		$this->load->view('footer');
	}

	//--Solicitudes de dentistas (sólo visible por el administrador)--//
	public function solicitudes()
	{
		$this->load->view('header');
		$this->load->view('navigation');
		if ($this->session->userdata('tipo')=='Administrador') {
			$data["solicitudes"]=$this->modelo->obtenerSolicitudes();
			$this->load->view('requests',$data);
		}
		else{
			$this->load->view('unathorized');
		}
		$this->load->view('footer');
	}

	//--Citas agendadas--//
	public function citas(){
		$this->load->view('header');
		$this->load->view('navigation');
		if ($this->session->userdata('nombre')!='') {
			$data["citas"]=$this->modelo->obtenerCitas();
			$data["dentistas"]=$this->modelo->obtenerDentistas();
			$data["usuarios"]=$this->modelo->obtenerUsuarios();
			$this->load->view('appointments',$data);
		}
		else{
			$this->load->view('unathorized');
		}
		$this->load->view('footer');
	}

	//--Agendar una nueva cita--//
	public function agendarCita(){
		$this->load->view('header');
		$this->load->view('navigation');
		if ($this->session->userdata('tipo')=='Usuario') {
			$data["dentistas"]=$this->modelo->obtenerDentistas();
			$this->load->view('appointment',$data);
		}
		else{
			$this->load->view('unathorized');
		}
		$this->load->view('footer');
	}

	//--Perfil del usuario--//
	public function perfil(){
		$this->load->view('header');
		$this->load->view('navigation');
		if ($this->session->userdata('tipo')=='Dentista') {
			$data = [
				'idDentista' => $this->session->userdata('id')
			];

			$data["dentistas"]=$this->modelo->obtenerDentista($data);

			$this->load->view('profile',$data);
		}
		else if($this->session->userdata('tipo')=='Usuario'){
			$data = [
				'idUsuario' => $this->session->userdata('id')
			];

			$data["usuarios"]=$this->modelo->obtenerUsuario($data);

			$this->load->view('profile',$data);
		}
		else{
			$this->load->view('unathorized');
		}
		$this->load->view('footer');
	}

	//--Dentistas registrados (sólo visible por el administrador y el paciente)--//
	public function dentistas(){
		$this->load->view('header');
		$this->load->view('navigation');
		if (($this->session->userdata('tipo')=='Administrador') || ($this->session->userdata('tipo')=='Usuario')) {
			$data["dentistas"]=$this->modelo->obtenerDentistas();
			$this->load->view('dentists',$data);
		}
		else{
			$this->load->view('unathorized');
		}
		$this->load->view('footer');
	}

	//--Usuarios registrados (sólo visible por el administrador)--//
	public function usuarios(){
		$this->load->view('header');
		$this->load->view('navigation');
		if ($this->session->userdata('tipo')=='Administrador') {
			$data["usuarios"]=$this->modelo->obtenerUsuarios();
			$this->load->view('users',$data);
		}
		else{
			$this->load->view('unathorized');
		}
		$this->load->view('footer');
	}
	//--------------------------------------------------------//

	//--------------Funciones para manejar citas--------------//

	//--Crear una cita--//
	public function crearCita(){

		//--Se obtienen los valores del formulario con POST--//
		$fecha=$this->input->post('fecha',TRUE);
		$hora=$this->input->post('hora',TRUE);
		$dentista=$this->input->post('dentista',TRUE);

		//--Se hace un arreglo con los datos para enviarlos al modelo y crear la cita--/
		
		$data = [
			'idUsuario' => $this->session->userdata('id'),
			'fecha' => $fecha,
			'hora' => $hora,
			'dentista' => $dentista
		];

		$this->modelo->añadirCita($data);

		redirect("Principal/citas");
	}

	//--Crear una cita desde el directorio--//
	public function crearCitaS(){
		//--Se obtienen los valores del formulario con POST--//
		$fecha=$this->input->post('fecha',TRUE);
		$hora=$this->input->post('hora',TRUE);
		$dentista= $this->uri->segment(3);

		//--Se hace un arreglo con los datos para enviarlos al modelo y crear la cita--/
		
		$data = [
			'idUsuario' => $this->session->userdata('id'),
			'fecha' => $fecha,
			'hora' => $hora,
			'dentista' => $dentista
		];

		$this->modelo->añadirCita($data);

		redirect("Principal/citas");
	}

	//--Actualizar los datos de la cita--//
	public function modificarCita(){
		$data["idCita"] = $this->uri->segment(3);

		//--Se obtienen los valores del formulario con POST--//
		$fecha=$this->input->post('fechaN',TRUE);
		$hora=$this->input->post('horaN',TRUE);

		//--Se hace un arreglo con los datos para enviarlos al modelo para actualizarlo--/
		$data = [
			'idCita' =>$data["idCita"],
			'fecha' => $fecha,
			'hora' => $hora
		];

		$this->modelo->modificarCita($data);

		redirect('Principal/citas/');
	}

	//--Eliminar la cita--//
	public function cancelarCita(){
		$data["idCita"] = $this->uri->segment(3);
		
		$this->modelo->eliminarCita($data);

		redirect('Principal/citas/');
	}
	//--------------------------------------------------------//


	//------------Funciones para manejar registros------------//

	//--Registrar un nuevo usuario (paciente)--//
	public function registrarNuevoUsuario(){

		//--Se obtienen los valores del formulario con POST--//
		$nombre=$this->input->post('nombre',TRUE);
		$apellidos=$this->input->post('apellidos',TRUE);
		$telefono=$this->input->post('telefono',TRUE);
		$direccion=$this->input->post('direccion',TRUE);
		$correo=$this->input->post('correo',TRUE);
		$contraseña=$this->input->post('contraseña',TRUE);

		//--Se hace un arreglo con los datos para enviarlos al modelo y registrar al usuario--/
		$data = [
			'nombre' => $nombre,
			'apellidos' => $apellidos,
			'telefono' => $telefono,
			'direccion' => $direccion,
			'correo' => $correo,
			'contraseña' => $contraseña
		];

		$this->modelo->agregarUsuario($data);

		redirect("Principal/vistaInicial");
	}

	//--Actualizar datos de contacto del usuario--//
	public function actualizarUsuario(){
		//--Se obtienen los valores del formulario con POST--//
		$telefono=$this->input->post('telefono',TRUE);
		$direccion=$this->input->post('direccion',TRUE);
		$correo=$this->input->post('correo',TRUE);

		//--Se hace un arreglo con los datos para enviarlos al modelo y registrar al usuario--/
		$data = [
			'idUsuario' => $this->session->userdata('id'),
			'telefono' => $telefono,
			'direccion' => $direccion,
			'correo' => $correo
		];

		$this->modelo->actualizarUsuario($data);

		redirect("Principal/perfil");
	}

	//--Enviar la solicitud de un dentista--//
	public function solicitarRegistroDentista(){

		//--Se obtienen los valores del formulario con POST--//
		$nombre=$this->input->post('nombre',TRUE);
		$apellidos=$this->input->post('apellidos',TRUE);
		$cedula=$this->input->post('cedula',TRUE);
		$telefono=$this->input->post('telefono',TRUE);
		$direccion=$this->input->post('direccion',TRUE);
		$descripcion=$this->input->post('descripcion',TRUE);
		$correo=$this->input->post('correo',TRUE);
		$contraseña=$this->input->post('contraseña',TRUE);

		//--Se hace un arreglo con los datos para enviarlos al modelo y registrar al usuario--/
		$data = [
			'nombre' => $nombre,
			'apellidos' => $apellidos,
			'cedula' => $cedula,
			'telefono' => $telefono,
			'direccion' => $direccion,
			'descripcion' => $descripcion,
			'correo' => $correo,
			'contraseña' => $contraseña
		];

		$this->modelo->agregarSolicitudDentista($data);

		redirect("Principal/index", 'location');
	}

	//--Registrar nuevo dentista después de que su solicitud fue aceptada--//
	public function registrarNuevoDentista(){

		//--Se obtiene el ID de la solicitud--//
		$data["idSolicitud"] = $this->uri->segment(3);
		$data2["idSolicitud"] = $this->uri->segment(3);
		
		//--Se obtienen los datos de la solicitud--//
		$data["solicitudes"]=$this->modelo->obtenerDatosSolicitud($data);

		//--Si no se encuentra--//
		if ($data["solicitudes"]==FALSE) {
			redirect("Principal/index", 'location');
		}

		//--Si es que se encuentra retorna sus datos--//
		else{

			$usuario=$data["solicitudes"]->row_array(0);

			//--Se hace un arreglo con los datos para crear la sesión--//
			$data =  [
				'nombre' => $usuario["nombre"],
				'apellidos' => $usuario["apellidos"],
				'cedula' => $usuario["cedula"],
				'telefono' => $usuario["telefono"],
				'direccion' => $usuario["direccion"],
				'descripcion' => $usuario["descripcion"],
				'correo' => $usuario["correo"],
				'contraseña' => $usuario["contraseña"],
				'tipo' => $usuario["tipo"],
				'url' => base_url()
			];

			//$this->modelo->agregarDentista($data);

			//--Contenido del correo HTML--//
			$contenido = '<!DOCTYPE html>
							<html>
							<head>
							    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
							    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
							    <meta name="viewport" content="width=600,initial-scale = 2.3,user-scalable=no">
							    <link href='.'https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700 ' .'rel="stylesheet">
							    <link href='.'https://fonts.googleapis.com/css?family=Quicksand:300,400,700 ' .'rel="stylesheet">
							    
							    <title>Correo de confirmaci&oacute;n</title>

							    <style type="text/css">
							        body {
							            width: 100%;
							            background-color: #ffffff;
							            margin: 0;
							            padding: 0;
							            -webkit-font-smoothing: antialiased;
							            mso-margin-top-alt: 0px;
							            mso-margin-bottom-alt: 0px;
							            mso-padding-alt: 0px 0px 0px 0px;
							        }

							        p,
							        h1,
							        h2,
							        h3,
							        h4 {
							            margin-top: 0;
							            margin-bottom: 0;
							            padding-top: 0;
							            padding-bottom: 0;
							        }

							        span.preheader {
							            display: none;
							            font-size: 1px;
							        }

							        html {
							            width: 100%;
							        }

							        table {
							            font-size: 14px;
							            border: 0;
							        }

							        @media only screen and (max-width: 640px) {
							            /*------ top header ------ */
							            .main-header {
							                font-size: 20px !important;
							            }
							            .main-section-header {
							                font-size: 28px !important;
							            }
							            .show {
							                display: block !important;
							            }
							            .hide {
							                display: none !important;
							            }
							            .align-center {
							                text-align: center !important;
							            }
							            .no-bg {
							                background: none !important;
							            }
							            /*----- main image -------*/
							            .main-image img {
							                width: 440px !important;
							                height: auto !important;
							            }
							            /* ====== divider ====== */
							            .divider img {
							                width: 440px !important;
							            }
							            /*-------- container --------*/
							            .container590 {
							                width: 440px !important;
							            }
							            .container580 {
							                width: 400px !important;
							            }
							            .main-button {
							                width: 220px !important;
							            }
							            /*-------- secions ----------*/
							            .section-img img {
							                width: 320px !important;
							                height: auto !important;
							            }
							            .team-img img {
							                width: 100% !important;
							                height: auto !important;
							            }
							        }

							        @media only screen and (max-width: 479px) {
							            /*------ top header ------ */
							            .main-header {
							                font-size: 18px !important;
							            }
							            .main-section-header {
							                font-size: 26px !important;
							            }
							            /* ====== divider ====== */
							            .divider img {
							                width: 280px !important;
							            }
							            /*-------- container --------*/
							            .container590 {
							                width: 280px !important;
							            }
							            .container590 {
							                width: 280px !important;
							            }
							            .container580 {
							                width: 260px !important;
							            }
							            /*-------- secions ----------*/
							            .section-img img {
							                width: 280px !important;
							                height: auto !important;
							            }
							        }
							    </style>
							</head>

							<body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

							    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">
							        <tr>
							            <td align="center">
							                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

							                    <tr>
							                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
							                    </tr>

							                    <tr>
							                        <td align="center">

							                            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

							                                <tr>
							                                    <td align="center" height="70" style="height:70px;">
							                                        <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="100" border="0" style="display: block; width: 100px;" src="https://columbiadentalcaresc.com/files/2014/04/tooth.png" alt="" /></a>
							                                    </td>
							                                </tr>

							                            </table>
							                        </td>
							                    </tr>

							                    <tr>
							                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
							                    </tr>

							                </table>
							            </td>
							        </tr>
							    </table>

							    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
							        <tr>
							            <td align="center">
							                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

							                    <tr>
							                        <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;"
							                            class="main-header">

							                            <div style="line-height: 35px">

							                                Gracias por habernos escogido

							                            </div>
							                        </td>
							                    </tr>

							                    <tr>
							                        <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
							                    </tr>

							                    <tr>
							                        <td align="center">
							                            <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
							                                <tr>
							                                    <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
							                                </tr>
							                            </table>
							                        </td>
							                    </tr>

							                    <tr>
							                        <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
							                    </tr>

							                    <tr>
							                        <td align="left">
							                            <table border="0" width="590" align="center" cellpadding="0" cellspacing="0" class="container590">
							                                <tr>
							                                    <td align="left" style="color: #888888; font-size: 16px; font-family: '.'Work Sans'.', Calibri, sans-serif; line-height: 24px;">

							                                        <p style="line-height: 24px; margin-bottom:15px;">

							                                            Hola '.$data['nombre'].',

							                                        </p>
							                                        <p style="line-height: 24px;margin-bottom:15px;">
							                                            Le informamos que su cuenta ha sido aprovada y creada con éxito.
							                                        </p>
							                                        <p style="line-height: 24px; margin-bottom:20px;">
							                                            A partir de ahora puede acceder a su cuenta.
							                                        </p>
							                                        <table border="0" align="center" width="180" cellpadding="0" cellspacing="0" bgcolor="5caad2" style="margin-bottom:20px;">

							                                            <tr>
							                                                <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
							                                            </tr>

							                                            <tr>
							                                                <td align="center" style="color: #ffffff; font-size: 14px; font-family: '.'Work Sans'.', Calibri, sans-serif; line-height: 22px; letter-spacing: 2px;">

							                                                    <div style="line-height: 22px;">
							                                                        <a href="'.$data['url'].'" style="color: #ffffff; text-decoration: none;">Acceder</a>
							                                                    </div>
							                                                </td>
							                                            </tr>

							                                            <tr>
							                                                <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
							                                            </tr>

							                                        </table>
							                                        <p style="line-height: 24px">
							                                            Administraci&oacute;n</br>
							                                            Equipo Dental Care
							                                        </p>
							                                    </td>
							                                </tr>
							                            </table>
							                        </td>
							                    </tr>
							                </table>
							            </td>
							        </tr>
							        <tr><td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td></tr>
							    </table>

							    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f4f4f4">
							        <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
							        <tr>
							            <td align="center">
							                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
							                    <tr>
							                        <td>
							                            <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
							                                class="container590">
							                                <tr>
							                                    <td align="left" style="color: #aaaaaa; font-size: 14px; font-family: '.'Work Sans'.', Calibri, sans-serif; line-height: 24px;">
							                                        <div style="line-height: 24px;">
							                                            <span style="color: #333333;">Copyright &copy; 2019 JRL & RUV
							                                            <br>Ingeniería Web.</span>
							                                        </div>
							                                    </td>
							                                </tr>
							                            </table>
							                        </td>
							                    </tr>
							                </table>
							            </td>
							        </tr>
							        <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
							    </table>
							</body>
							</html>';

			//--Se carga la librería de email--//
			$this->load->library('email');

			//--Se cera un arreglo con las configuraciones--//
			$config = [
				/*
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'correo',
				'smtp_pass' => 'contraseña',
				*/
				'smtp_crypto' => 'tls',
				'mailtype' => 'html',
				'charset' => 'UTF-8'
			];

			//--Se inicializa--//
			$this->email->initialize($config);
			
			//--Se proporciona el contenido del correo a enviar--//
			$this->email->from('jahircuealt@gmail.com', 'Administrador');
			$this->email->to($data['correo']);
			$this->email->subject('Cuenta Dental Care');
			$this->email->message($contenido);

			//--Se envia el correo--//
			$this->email->send();

			//--Se elimina la solicitud de la base de datos--//
			//$this->modelo->eliminarSolicitud($data2);

			//redirect('Principal/solicitudes/');
		}
	}

	//--Actualizar datos de contacto del dentista--//
	public function actualizarDentista(){
		//--Se obtienen los valores del formulario con POST--//
		$direccion=$this->input->post('direccion',TRUE);
		$telefono=$this->input->post('telefono',TRUE);
		$correo=$this->input->post('correo',TRUE);
		$descripcion=$this->input->post('descripcion',TRUE);

		//--Se hace un arreglo con los datos para enviarlos al modelo y registrar al usuario--/
		$data = [
			'idDentista' => $this->session->userdata('id'),
			'telefono' => $telefono,
			'direccion' => $direccion,
			'correo' => $correo,
			'descripcion' => $descripcion
		];

		$this->modelo->actualizarDentista($data);

		redirect("Principal/perfil");
	}

	//--Eliminar la solicitud del dentista--//
	public function rechazarSolicitud()
	{
		//--Se obtiene el ID de la solicitud--//
		$data["idSolicitud"] = $this->uri->segment(3);

		//--Se obtienen los datos de la solicitud--//
		$data["solicitudes"]=$this->modelo->obtenerDatosSolicitud($data);

		//--Si no se encuentra--//
		if ($data["solicitudes"]==FALSE) {
			redirect("Principal/index", 'location');
		}

		//--Si es que se encuentra retorna sus datos--//
		else{

			$usuario=$data["solicitudes"]->row_array(0);

			//--Se hace un arreglo con los datos para crear la sesión--//
			$data =  [
				'nombre' => $usuario["nombre"],
				'correo' => $usuario["correo"],
				'url' => base_url()
			];

			//--Contenido del correo HTML--//
			$contenido = '<!DOCTYPE html>
							<html>
							<head>
							    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
							    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
							    <meta name="viewport" content="width=600,initial-scale = 2.3,user-scalable=no">
							    <link href='.'https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700 ' .'rel="stylesheet">
							    <link href='.'https://fonts.googleapis.com/css?family=Quicksand:300,400,700 ' .'rel="stylesheet">
							    
							    <title>Correo de confirmaci&oacute;n</title>

							    <style type="text/css">
							        body {
							            width: 100%;
							            background-color: #ffffff;
							            margin: 0;
							            padding: 0;
							            -webkit-font-smoothing: antialiased;
							            mso-margin-top-alt: 0px;
							            mso-margin-bottom-alt: 0px;
							            mso-padding-alt: 0px 0px 0px 0px;
							        }

							        p,
							        h1,
							        h2,
							        h3,
							        h4 {
							            margin-top: 0;
							            margin-bottom: 0;
							            padding-top: 0;
							            padding-bottom: 0;
							        }

							        span.preheader {
							            display: none;
							            font-size: 1px;
							        }

							        html {
							            width: 100%;
							        }

							        table {
							            font-size: 14px;
							            border: 0;
							        }

							        @media only screen and (max-width: 640px) {
							            /*------ top header ------ */
							            .main-header {
							                font-size: 20px !important;
							            }
							            .main-section-header {
							                font-size: 28px !important;
							            }
							            .show {
							                display: block !important;
							            }
							            .hide {
							                display: none !important;
							            }
							            .align-center {
							                text-align: center !important;
							            }
							            .no-bg {
							                background: none !important;
							            }
							            /*----- main image -------*/
							            .main-image img {
							                width: 440px !important;
							                height: auto !important;
							            }
							            /* ====== divider ====== */
							            .divider img {
							                width: 440px !important;
							            }
							            /*-------- container --------*/
							            .container590 {
							                width: 440px !important;
							            }
							            .container580 {
							                width: 400px !important;
							            }
							            .main-button {
							                width: 220px !important;
							            }
							            /*-------- secions ----------*/
							            .section-img img {
							                width: 320px !important;
							                height: auto !important;
							            }
							            .team-img img {
							                width: 100% !important;
							                height: auto !important;
							            }
							        }

							        @media only screen and (max-width: 479px) {
							            /*------ top header ------ */
							            .main-header {
							                font-size: 18px !important;
							            }
							            .main-section-header {
							                font-size: 26px !important;
							            }
							            /* ====== divider ====== */
							            .divider img {
							                width: 280px !important;
							            }
							            /*-------- container --------*/
							            .container590 {
							                width: 280px !important;
							            }
							            .container590 {
							                width: 280px !important;
							            }
							            .container580 {
							                width: 260px !important;
							            }
							            /*-------- secions ----------*/
							            .section-img img {
							                width: 280px !important;
							                height: auto !important;
							            }
							        }
							    </style>
							</head>

							<body class="respond" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

							    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff">
							        <tr>
							            <td align="center">
							                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

							                    <tr>
							                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
							                    </tr>

							                    <tr>
							                        <td align="center">

							                            <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

							                                <tr>
							                                    <td align="center" height="70" style="height:70px;">
							                                        <a href="" style="display: block; border-style: none !important; border: 0 !important;"><img width="100" border="0" style="display: block; width: 100px;" src="https://columbiadentalcaresc.com/files/2014/04/tooth.png" alt="" /></a>
							                                    </td>
							                                </tr>

							                            </table>
							                        </td>
							                    </tr>

							                    <tr>
							                        <td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td>
							                    </tr>

							                </table>
							            </td>
							        </tr>
							    </table>

							    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="ffffff" class="bg_color">
							        <tr>
							            <td align="center">
							                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">

							                    <tr>
							                        <td align="center" style="color: #343434; font-size: 24px; font-family: Quicksand, Calibri, sans-serif; font-weight:700;letter-spacing: 3px; line-height: 35px;"
							                            class="main-header">

							                            <div style="line-height: 35px">

							                                Gracias por habernos escogido

							                            </div>
							                        </td>
							                    </tr>

							                    <tr>
							                        <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
							                    </tr>

							                    <tr>
							                        <td align="center">
							                            <table border="0" width="40" align="center" cellpadding="0" cellspacing="0" bgcolor="eeeeee">
							                                <tr>
							                                    <td height="2" style="font-size: 2px; line-height: 2px;">&nbsp;</td>
							                                </tr>
							                            </table>
							                        </td>
							                    </tr>

							                    <tr>
							                        <td height="20" style="font-size: 20px; line-height: 20px;">&nbsp;</td>
							                    </tr>

							                    <tr>
							                        <td align="left">
							                            <table border="0" width="590" align="center" cellpadding="0" cellspacing="0" class="container590">
							                                <tr>
							                                    <td align="left" style="color: #888888; font-size: 16px; font-family: '.'Work Sans'.', Calibri, sans-serif; line-height: 24px;">

							                                        <p style="line-height: 24px; margin-bottom:15px;">

							                                            Hola '.$data['nombre'].',

							                                        </p>
							                                        <p style="line-height: 24px;margin-bottom:15px;">
							                                            Lamentamos informarle que su solicitud ha sido rechazada.
							                                        </p>
							                                        <p style="line-height: 24px; margin-bottom:20px;">
							                                            Si usted considera que fue un error por favor pongase en contacto con nosotros.
							                                        </p>
							                                        <table border="0" align="center" width="180" cellpadding="0" cellspacing="0" bgcolor="5caad2" style="margin-bottom:20px;">

							                                            <tr>
							                                                <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
							                                            </tr>

							                                            <tr>
							                                                <td align="center" style="color: #ffffff; font-size: 14px; font-family: '.'Work Sans'.', Calibri, sans-serif; line-height: 22px; letter-spacing: 2px;">

							                                                    <div style="line-height: 22px;">
							                                                        <a href="'.$data['url'].'" style="color: #ffffff; text-decoration: none;">Visitar sitio web</a>
							                                                    </div>
							                                                </td>
							                                            </tr>

							                                            <tr>
							                                                <td height="10" style="font-size: 10px; line-height: 10px;">&nbsp;</td>
							                                            </tr>

							                                        </table>
							                                        <p style="line-height: 24px">
							                                            Administraci&oacute;n</br>
							                                            Equipo Dental Care
							                                        </p>
							                                    </td>
							                                </tr>
							                            </table>
							                        </td>
							                    </tr>
							                </table>
							            </td>
							        </tr>
							        <tr><td height="40" style="font-size: 40px; line-height: 40px;">&nbsp;</td></tr>
							    </table>

							    <table border="0" width="100%" cellpadding="0" cellspacing="0" bgcolor="f4f4f4">
							        <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
							        <tr>
							            <td align="center">
							                <table border="0" align="center" width="590" cellpadding="0" cellspacing="0" class="container590">
							                    <tr>
							                        <td>
							                            <table border="0" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
							                                class="container590">
							                                <tr>
							                                    <td align="left" style="color: #aaaaaa; font-size: 14px; font-family: '.'Work Sans'.', Calibri, sans-serif; line-height: 24px;">
							                                        <div style="line-height: 24px;">
							                                            <span style="color: #333333;">Copyright &copy; 2019 JRL & RUV
							                                            <br>Ingeniería Web.</span>
							                                        </div>
							                                    </td>
							                                </tr>
							                            </table>
							                        </td>
							                    </tr>
							                </table>
							            </td>
							        </tr>
							        <tr><td height="25" style="font-size: 25px; line-height: 25px;">&nbsp;</td></tr>
							    </table>
							</body>
							</html>';

			//--Se carga la librería de email--//
			$this->load->library('email');

			//--Se cera un arreglo con las configuraciones--//
			$config = [
				/*
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'correo',
				'smtp_pass' => 'contraseña',
				*/
				'smtp_crypto' => 'tls',
				'mailtype' => 'html',
				'charset' => 'UTF-8'
			];



			//--Se inicializa--//
			$this->email->initialize($config);
			
			//--Se proporciona el contenido del correo a enviar--//
			$this->email->from('jahircuealt@gmail.com', 'Administrador');
			$this->email->to($data['correo']);
			$this->email->subject('Cuenta Dental Care');
			$this->email->message($contenido);

			//--Se envia el correo--//
			$this->email->send();

			echo $data['correo'];

			//$this->modelo->eliminarSolicitud($data);
			//redirect('Principal/solicitudes/');
		}
	}
	//--------------------------------------------------------//

	//-------------Funciones para manejar sesiones------------//

	//--Crear sesión de usuario--//
	public function validaUsuario()
	{
		//--Se obtienen los valores del formulario con POST--//
		$correo=$this->input->post('correo',TRUE);
		$contraseña=$this->input->post('contraseña',TRUE);

		//--Se hace un arreglo con los datos para enviarlos al modelo y hacer la consulta--/
		$data = [
			'correo' => $correo,
			'contraseña' => $contraseña
		];

		//--Se llama a la función en el modelo--//
		$data["user"]=$this->modelo->validaUsuario($data);

		//--Si no se encuentra--//
		if ($data["user"]==FALSE) {
			redirect("Principal/index", 'location');
		}

		//--Si es que se encuentra retorna sus datos--//
		else{
			
			$usuario=$data["user"]->row_array(0);

			//--Se hace un arreglo con los datos para crear la sesión--//
			$datasession =  [
				'id' => $usuario["idAdministrador"],
				'nombre' => $usuario["nombre"],
				'tipo' => $usuario["tipo"]
			];

			//--Se crea la sesión--//
			$this->session->set_userdata($datasession);

			//print_r($this->session->userdata); 

			redirect("Principal/vistaInicial", 'location');
		}
	}

	//--Eliminar sesión de usuario--//
	public function cerrarSesion()
	{
		//--Se vacían los datos--//
		$datasession = [
			'id' => "",
			'nombre' => "",
			'tipo' => ""
		];

		//--Se elimina la sesión--//
		$this->session->unset_userdata($datasession);
		$this->session->sess_destroy();

		//--Se regresa al inicio--//
		redirect('Principal/index/', 'refresh');
	}
	//--------------------------------------------------------//

}