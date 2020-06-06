<div class="container" style="margin-top:1em">
	<div class="row">
		<div class="col-sm-12">
			<h1 class="text-center font-weight-bold">Usuarios registrados</h1>
		</div>
	</div>

	<!--Condición para verificar que haya usuarios-->
	<?php if ($usuarios != FALSE) {$i=0;

		//--Se hace un recorrido de todas las usuarios--//
		foreach ($usuarios->result() as $row) {$i++;?>

			<div class="container-fluid" style="margin-top:1em">

				<hr>

				<div class="row">

					<div class="col-sm-4">
						
						<!--Imágen de perfil-->
				        <div>
				        	<img src="<?php echo base_url(); ?>img/usuario.png" class="img-fluid mx-auto d-block rounded-circle img-responsive" style="width:50%">
				        </div>

					</div>

					<div class="col-sm-8">

						<!--Datos-->
						<h2 id="nombre" name="nombre"><?php echo $row->nombre;?>&nbsp;<?php echo $row->apellidos; ?></h2>

				        <br>

			            <i class="fas fa-map-marked"></i><label for="direccion">&nbsp;Direcci&oacute;n: <?php echo $row->direccion; ?></label>
			            
			            <br>

			            <i class="fas fa-phone-alt"></i><label for="telefono">&nbsp;Tel&eacute;fono: <?php echo $row->telefono; ?></label>

			            <br>

			            <i class="fas fa-envelope fa-lg"></i><label for="correo">&nbsp;Correo electr&oacute;nico: <?php echo $row->correo; ?></label>

			            <br>

					</div>

				</div>

			</div>
		<!--Fin del foreach-->
		<?php }
	}

	//--En caso de que no haya ningun dentista registrado--//
	else{ ?>
		<br>
		<br>
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="display-4">No hay usuarios registrados por el momento.</h1>
				<img src="<?php echo base_url(); ?>img/trabajando.jpg" class="img-fluid mx-auto d-block" style="width:75%">
			</div>
		</div>
		<br>
	<!--Fin del IF-->
	<?php } ?>
</div>