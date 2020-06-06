<style>
	.registrar{
		border-radius: 8px;
    	background-color: #1d65ac;
    	border: none;
    	color: white;
    	padding: 0.6em 0.6em;
    	text-align: center;
    	font-weight: bold;
    }
</style>

<div class="container" style="margin-top:1em">

	<div class="row">
		<div class="col-sm-12">
			<h1 class="text-center font-weight-bold">Elegir el tipo de usuario</h1>
		</div>
	</div>
</div>

	<div class="row">

		<div class="col-md-6">

			<div class="container text-center">
				<h2>Dentista</h2>
				<img src="<?php echo base_url(); ?>img/dentista.png" class="img-fluid mx-auto d-block" style="width:89%">
				<br>
				<!--Botón para registrar un dentista (Modal)-->
			    <button type="button" class="registrar btn navbar-brand" data-toggle="modal" data-target="#ModalD">
			      <i class="fas fa-notes-medical"></i> Registrarse
			    </button>
			</div>
		</div>

		<div class="col-md-6">
			<div class="container justify-content-center aling-items-center text-center">
				
				<h2>Paciente</h2>
				<img src="<?php echo base_url(); ?>img/usuario.png" class="img-fluid mx-auto d-block" style="width:89%">
				<br>

				<!--Botón para registrar un usuario (Modal)-->
			    <button type="button" class="registrar btn navbar-brand" data-toggle="modal" data-target="#ModalU">
			      <i class="fas fa-user-plus"></i> Registrarse
			    </button>
			    <br>

			</div>
		</div>

	</div>

</div>

<!--Modal para registrar un nuevo dentista-->
<div class="modal fade" id="ModalD" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <!--Botón para cerrar el modal-->
      <div><button type="button" class="btn" data-dismiss="modal"><span aria-hidden="true">&times;</span></button></div>
      
      <div class="modal-body border-rounded my-1 p-4">

      	<!--Título-->
        <h4 class="text-center font-weight-bold">Registro de nuevo dentista</h4>

        <!--Imágen de perfil-->
        <div class="text-center">
          <img src="<?php echo base_url(); ?>img/dentista.png" class="img-fluid mx-auto d-block rounded-circle img-responsive" style="width:40%">
        </div>
        
        <!--Formulario para solicitar su registro-->
        <form action="<?php echo base_url(); ?>index.php/Principal/solicitarRegistroDentista" method="post">
          <div class="md-form">

            <i class="fas fa-user-md"></i><label for="nombre">&nbsp;Nombre</label>
            <input id="nombre" name="nombre" class="form-control" type="text" required="" placeholder="Javier">

            <br>

            <i class="fas fa-user-md"></i><label for="apellidos">&nbsp;Apellidos</label>
            <input id="apellidos" name="apellidos" class="form-control" type="text" required="" placeholder="Garc&iacute;a Mart&iacute;nez">

            <br>

            <i class="fas fa-user-graduate"></i><label for="cedula">&nbsp;C&eacute;dula profesional</label>
            <input id="cedula" name="cedula" class="form-control" type="text" required="" placeholder="123456">

            <br>

            <i class="fas fa-phone-alt"></i><label for="telefono">&nbsp;Tel&eacute;fono</label>
            <input id="telefono" name="telefono" class="form-control" type="text" required="" placeholder="222123456">

            <br>

            <i class="fas fa-map-marked"></i><label for="direccion">&nbsp;Direcci&oacute;n</label>
            <input id="direccion" name="direccion" class="form-control" type="text" required="" placeholder="Calle A #1234 Colonia: ABCD CP:00000">
            
            <br>

            <i class="fas fa-university"></i><label for="descripcion">&nbsp;Descripci&oacute;n</label>
            <input id="descripcion" name="descripcion" class="form-control" type="text" required="" placeholder="Graduado de la BUAP en el 2019 con honores...">

            <br>

            <i class="fas fa-envelope fa-lg"></i><label for="correo">&nbsp;Correo electr&oacute;nico</label>
            <input id="correo" name="correo" class="form-control" type="text" required="" placeholder="example@gmail.com">

            <br>

            <i class="fas fa-lock"></i><label for="contraseña">&nbsp;Contraseña</label>
            <input id="contraseña" name="contraseña" class="form-control" type="password" required="" placeholder="·····">
          </div>
          
          <br>

          <div class="container-fluid" style="margin-top:1em">
          	<div class="row">
          		<div class="col">
          			<div class="text-center">
          				<button type="submit" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="fas fa-window-close"></i>&nbsp;Cancelar</button>
          			</div>	
          		</div>
          		<div class="col">
          			<div class="text-center">
          				<button type="submit" class="btn btn-secondary btn-lg active"><i class="fas fa-key"></i> Registrarse</button>
          			</div>
          		</div>
          	</div>
          </div>

          <div class="text-center">
            <br><p>La creación de su perfil esta sujeta a la aprobación del administrador.</p>
          </div>

        </form>

      </div>

    </div>
  </div>
</div>

<!--Modal para registrar un nuevo usuario-->
<div class="modal fade" id="ModalU" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <!--Botón para cerrar el modal-->
      <div><button type="button" class="btn" data-dismiss="modal"><span aria-hidden="true">&times;</span></button></div>
      
      <div class="modal-body border-rounded my-1 p-4">

      	<!--Título-->
        <h4 class="text-center font-weight-bold">Registro de nuevo usuario</h4>

        <!--Imágen de perfil-->
        <div class="text-center">
          <img src="<?php echo base_url(); ?>img/usuario.png" class="img-fluid mx-auto d-block rounded-circle img-responsive" style="width:40%">
        </div>
        
        <!--Formulario para solicitar su registro-->
        <form action="<?php echo base_url(); ?>index.php/Principal/registrarNuevoUsuario" method="post">
          <div class="md-form">

            <i class="fas fa-user"></i><label for="nombre">&nbsp;Nombre</label>
            <input id="nombre" name="nombre" class="form-control" type="text" required="" placeholder="Javier">

            <br>

            <i class="fas fa-user"></i><label for="apellidos">&nbsp;Apellidos</label>
            <input id="apellidos" name="apellidos" class="form-control" type="text" required="" placeholder="Garc&iacute;a Mart&iacute;nez">

            <br>

            <i class="fas fa-phone-alt"></i><label for="telefono">&nbsp;Tel&eacute;fono</label>
            <input id="telefono" name="telefono" class="form-control" type="text" required="" placeholder="222123456">

            <br>

            <i class="fas fa-map-marked"></i><label for="direccion">&nbsp;Direcci&oacute;n</label>
            <input id="direccion" name="direccion" class="form-control" type="text" required="" placeholder="Calle A #1234 Colonia: ABCD CP:00000">
            
            <br>

            <i class="fas fa-envelope fa-lg"></i><label for="correo">&nbsp;Correo electr&oacute;nico</label>
            <input id="correo" name="correo" class="form-control" type="text" required="" placeholder="example@gmail.com">

            <br>

            <i class="fas fa-lock"></i><label for="contraseña">&nbsp;Contraseña</label>
            <input id="contraseña" name="contraseña" class="form-control" type="password" required="" placeholder="·····">
          </div>

          <div class="container" style="margin-top:1em">
          	<div class="row">
          		<div class="col">
          			<div class="text-center">
          				<button type="submit" class="btn btn-danger btn-lg" data-dismiss="modal"><i class="fas fa-window-close"></i>&nbsp;Cancelar</button>
          			</div>	
          		</div>
          		<div class="col">
          			<div class="text-center">
          				<button type="submit" class="btn btn-secondary btn-lg active"><i class="fas fa-key"></i> Registrarse</button>
          			</div>
          		</div>
          	</div>
          </div>

        </form>

      </div>
      
    </div>
  </div>
</div>