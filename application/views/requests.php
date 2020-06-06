<style>
	.aceptar{
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
			<h1 class="text-center font-weight-bold">Solicitudes pendientes</h1>
		</div>
	</div>

	<!--Condición para verificar que haya solicitudes-->
	<?php if ($solicitudes != FALSE) {$i=0;

		//--Se hace un recorrido de todas las solicitudes--//
		foreach ($solicitudes->result() as $row) {$i++;?>

			<div class="container-fluid" style="margin-top:1em">

				<hr>

				<h2 id="nombre" name="nombre">Dr(a). <?php echo $row->nombre;?>&nbsp;<?php echo $row->apellidos; ?></h2>
			
				<br>

				<div class="row">

					<div class="col-sm-4 container text-center">
						<button style="font-weight: bold;  background-color: #5cb85c;" type="button" class="btn btn-info navbar-brand" data-toggle="modal" data-target="#ModalSD<?php echo $row->idSolicitud;?>">Ver solicitud</button>
					</div>

					<br>
					<br>
					<br>

					<div class="col-sm-4 container text-center">
						<a href="<?=base_url();?>index.php/Principal/rechazarSolicitud/<?=$row->idSolicitud?>"><button style="font-weight: bold;" type="button" class="btn btn-danger navbar-brand">Rechazar solicitud</button></a>
					</div>

					<br>
					<br>
					<br>

					<div class="col-sm-4 container text-center">
						<a href="<?=base_url();?>index.php/Principal/registrarNuevoDentista/<?=$row->idSolicitud?>"><button style="font-weight: bold; background-color: #1d65ac; color: white;" type="button" class="btn navbar-brand">Aceptar solicitud</button></a>
					</div>

				</div>

			</div>


			<div class="modal fade" id="ModalSD<?php echo $row->idSolicitud;?>" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">

						<!--Botón para cerrar el modal-->
						<div><button type="button" class="btn" data-dismiss="modal"><span aria-hidden="true">&times;</span></button></div>

						<div class="modal-body border-rounded my-1 p-4">

					      	<!--Nombre-->
					        <h4 class="text-center font-weight-bold">Dr(a). <?php echo $row->nombre;?>&nbsp;<?php echo $row->apellidos; ?></h4>

					        <!--Imágen de perfil-->
					        <div class="text-center">
					        	<img src="<?php echo base_url(); ?>img/dentista.png" class="img-fluid mx-auto d-block rounded-circle img-responsive" style="width:40%">
					        </div>

					        <br>

					        <i class="fas fa-user-graduate"></i><label for="cedula">&nbsp;C&eacute;dula profesional: <?php echo $row->cedula; ?></label>

					        <br>

				            <i class="fas fa-phone-alt"></i><label for="telefono">&nbsp;Tel&eacute;fono: <?php echo $row->telefono; ?></label>

				            <br>

				            <i class="fas fa-map-marked"></i><label for="direccion">&nbsp;Direcci&oacute;n: <?php echo $row->direccion; ?></label>
				            
				            <br>

				            <i class="fas fa-university"></i><label for="descripcion">&nbsp;Descripci&oacute;n: <?php echo $row->descripcion; ?></label>

				            <br>

				            <i class="fas fa-envelope fa-lg"></i><label for="correo">&nbsp;Correo electr&oacute;nico: <?php echo $row->correo; ?></label>

				            <br>

					    </div>
					</div>
				</div>
			</div>
		<!--Fin del foreach-->
		<?php }
	}

	//--En caso de que no haya ninguna solicitud--//
	else{ ?>
		<br>
		<br>
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">¡Grandioso!</h1>
				<p class="lead">No hay solicitudes pendientes por el momento.</p>
				<img src="<?php echo base_url(); ?>img/listo.png" class="img-fluid mx-auto d-block" style="width:50%">
			</div>
		</div>
		<br>
	<!--Fin del IF-->
	<?php } ?>
</div>