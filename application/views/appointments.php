<div class="container" style="margin-top:1em">
	<div class="row">
		<div class="col-sm-12">
			<h1 class="text-center font-weight-bold">Citas</h1>
		</div>
	</div>



	<?php 
	$bandera = 'false';
	$bandera2 = 'false';
	?>

	<!--Si el usuario es un administrador-->
	<?php if ($this->session->userdata('tipo')=='Administrador'){?>
		<div class="container-fluid" style="margin-top:1em">
			
			<!--Condición para verificar que haya citas-->
			<?php if ($citas != FALSE) {?>

				<?php foreach ($citas->result() as $cita) { ?>

					<hr>

					<div class="row">
						<!--Se obtiene información de las citas-->
						<div class="col-lg-2">

							<div class="text-center">
								<h2 id="cita" name="cita">Cita</h2>
							</div>

							<i class="far fa-calendar-check"></i><label for="fecha">&nbsp;Fecha: <?php echo $cita->fecha; ?></label>

							<br>

							<i class="fas fa-hourglass-end"></i><label for="hora">&nbsp;Hora: <?php echo $cita->hora; ?></label>

							<br>
						</div>

						<!--Se obtiene información de los dentistas-->
						<?php if ($dentistas != FALSE) {
							//--Se hace un recorrido de todos los dentistas--//
							foreach ($dentistas->result() as $dentista) {?>

								<?php if($cita->idDentista == $dentista->idDentista){?>

									<!--Imágen de perfil-->
									<div class="col-lg-2">
								        <div>
								        	<img src="<?php echo base_url(); ?>img/dentista.png" class="img-fluid mx-auto d-block rounded-circle img-responsive" style="width:75%">
								        </div>
									</div>
									<!--Datos-->
									<div class="col-lg-3">
										<h2 id="nombre" name="nombre">Dr(a). <?php echo $dentista->nombre;?>&nbsp;<?php echo $dentista->apellidos; ?></h2>

								        <br>

								        <i class="fas fa-user-graduate"></i><label for="cedula">&nbsp;C&eacute;dula profesional: <?php echo $dentista->cedula; ?></label>

								        <br>

							            <i class="fas fa-map-marked"></i><label for="direccion">&nbsp;Direcci&oacute;n: <?php echo $dentista->direccion; ?></label>
							            
							            <br>

							            <i class="fas fa-university"></i><label for="descripcion">&nbsp;Descripci&oacute;n: <?php echo $dentista->descripcion; ?></label>

							            <br>

							            <i class="fas fa-phone-alt"></i><label for="telefono">&nbsp;Tel&eacute;fono: <?php echo $dentista->telefono; ?></label>

							            <br>

							            <i class="fas fa-envelope fa-lg"></i><label for="correo">&nbsp;Correo electr&oacute;nico: <?php echo $dentista->correo; ?></label>

							            <br>
									</div>

								<!--Fin del IF-->
								<?php  } ?>

							<!--Fin del foreach-->
							<?php } 
						}?>

						<!--Se obtiene información de los usuarios-->
						<?php if ($usuarios != FALSE) {
							//--Se hace un recorrido de todos los usuarios--//
							foreach ($usuarios->result() as $usuario) {?>

								<?php if($cita->idUsuario == $usuario->idUsuario){?>
									<!--Imágen de perfil-->
									<div class="col-lg-2">
								        <div>
								        	<img src="<?php echo base_url(); ?>img/usuario.png" class="img-fluid mx-auto d-block rounded-circle img-responsive" style="width:75%">
								        </div>
									</div>
									<!--Datos-->
									<div class="col-lg-3">
										<h2 id="nombre" name="nombre"><?php echo $usuario->nombre;?>&nbsp;<?php echo $usuario->apellidos; ?></h2>

								        <br>

							            <i class="fas fa-map-marked"></i><label for="direccion">&nbsp;Direcci&oacute;n: <?php echo $usuario->direccion; ?></label>
							            
							            <br>

							            <i class="fas fa-phone-alt"></i><label for="telefono">&nbsp;Tel&eacute;fono: <?php echo $usuario->telefono; ?></label>

							            <br>

							            <i class="fas fa-envelope fa-lg"></i><label for="correo">&nbsp;Correo electr&oacute;nico: <?php echo $usuario->correo; ?></label>

							            <br>
									</div>
								<!--Fin del IF-->
								<?php  } ?>
							<!--Fin del foreach-->
							<?php } 
						}?>

					<!--Fin de cada fila-->
					</div>

				<!--Fin del recorrido de las citas-->
				<?php } ?>

			<?php }else{?>
				<br>
				<br>
				<div class="jumbotron jumbotron-fluid">
					<div class="container">
						<h1 class="display-4">No hay citas agendadas por el momento.</h1>

						<!--Si el usuario es un paciente le permite agendar una cita-->
						<?php if ($this->session->userdata('tipo')=='Usuario') {?>

							<p class="lead">¿Desea crear una nueva cita?</p>
							<a href="<?php echo base_url(); ?>index.php/Principal/agendarCita/"><button type="button" class="btn btn-success btn-lg" href=>Agendar cita</button></a>

						<?php }else {?>
							
							<img src="<?php echo base_url(); ?>img/trabajando.jpg" class="img-fluid mx-auto d-block" style="width:75%">

						<?php }?>

					</div>
				</div>
			<?php } ?>

		</div>
	<?php }?>

	<!--Si el usuario es un dentista-->
	<?php if ($this->session->userdata('tipo')=='Dentista'){?>
		<div class="container-fluid" style="margin-top:1em">

			<!--Condición para verificar que haya citas-->
			<?php if ($citas != FALSE) {?>

				<?php foreach ($citas->result() as $cita) { ?>

					<?php if($cita->idDentista == $this->session->userdata('id')){?>

						<?php $bandera = 'true'; ?>

						<hr>

						<div class="row">

							<!--Se obtiene información de las citas-->
							<div class="col-lg-4">

								<div class="text-center">
									<h2 id="cita" name="cita">Cita</h2>
								</div>

								<i class="far fa-calendar-check"></i><label for="fecha">&nbsp;Fecha: <?php echo $cita->fecha; ?></label>

								<br>

								<i class="fas fa-hourglass-end"></i><label for="hora">&nbsp;Hora: <?php echo $cita->hora; ?></label>

								<br>
							</div>

							<!--Se obtiene información de los usuarios-->
							<?php if ($usuarios != FALSE) {
								//--Se hace un recorrido de todos los usuarios--//
								foreach ($usuarios->result() as $usuario) {?>

									<?php if($cita->idUsuario == $usuario->idUsuario){?>
										<!--Imágen de perfil-->
										<div class="col-lg-2">
									        <div>
									        	<img src="<?php echo base_url(); ?>img/usuario.png" class="img-fluid mx-auto d-block rounded-circle img-responsive" style="width:75%">
									        </div>
										</div>
										<!--Datos-->
										<div class="col-lg-6">
											<h2 id="nombre" name="nombre"><?php echo $usuario->nombre;?>&nbsp;<?php echo $usuario->apellidos; ?></h2>

									        <br>

								            <i class="fas fa-map-marked"></i><label for="direccion">&nbsp;Direcci&oacute;n: <?php echo $usuario->direccion; ?></label>
								            
								            <br>

								            <i class="fas fa-phone-alt"></i><label for="telefono">&nbsp;Tel&eacute;fono: <?php echo $usuario->telefono; ?></label>

								            <br>

								            <i class="fas fa-envelope fa-lg"></i><label for="correo">&nbsp;Correo electr&oacute;nico: <?php echo $usuario->correo; ?></label>

								            <br>
										</div>
									<!--Fin del IF-->
									<?php  } ?>

								<!--Fin del foreach de usuarios-->
								<?php } 
							}?>
							
						</div>

					<?php } ?>
				<!--Fin del recorrido de las citas-->	
				<?php } ?>

				<!--En caso de que el dentista no tenga ninguna cita-->
				<?php if ($bandera == 'false') {?>
					<br><br>
					<div class="jumbotron jumbotron-fluid">
						<div class="container">
							<h1 class="display-4">No hay citas agendadas por el momento.</h1>
							<p>Error desconocido</p>
							<img src="<?php echo base_url(); ?>img/trabajando.jpg" class="img-fluid mx-auto d-block" style="width:75%">
							<br>
							<br>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	<?php } ?>

	<!--Si el usuario es un dentista-->
	<?php if ($this->session->userdata('tipo')=='Usuario'){?>
		<div class="container-fluid" style="margin-top:1em">

			<!--Condición para verificar que haya citas-->
			<?php if ($citas != FALSE) {?>

				<?php foreach ($citas->result() as $cita) { ?>

					<?php if($cita->idUsuario == $this->session->userdata('id')){?>

						<?php $bandera2 = 'true'; ?>

						<hr>

						<div class="row">

							<!--Se obtiene información de las citas-->
							<div class="col-lg-4">

								<div class="text-center">
									<h2 id="cita" name="cita">Cita</h2>
								</div>

								<i class="far fa-calendar-check"></i><label for="fecha">&nbsp;Fecha: <?php echo $cita->fecha; ?></label>

								<br>

								<i class="fas fa-hourglass-end"></i><label for="hora">&nbsp;Hora: <?php echo $cita->hora; ?></label>

								<br>
							</div>

							<!--Se obtiene información de los dentistas-->
							<?php if ($dentistas != FALSE) {
								//--Se hace un recorrido de todos los dentistas--//
								foreach ($dentistas->result() as $dentista) {?>

									<?php if($cita->idDentista == $dentista->idDentista){?>
										<!--Imágen de perfil-->
										<div class="col-lg-2">
											<br><br><br>
									        <div>
									        	<img src="<?php echo base_url(); ?>img/dentista.png" class="img-fluid mx-auto d-block rounded-circle img-responsive" style="width:60%">
									        </div>
									        <br>
										</div>
										<div class="col-lg-6">
											<!--Datos-->
											<h2 id="nombre" name="nombre">Dr(a). <?php echo $dentista->nombre;?>&nbsp;<?php echo $dentista->apellidos; ?></h2>

									        <br>

									        <i class="fas fa-user-graduate"></i><label for="cedula">&nbsp;C&eacute;dula profesional: <?php echo $dentista->cedula; ?></label>

									        <br>

								            <i class="fas fa-map-marked"></i><label for="direccion">&nbsp;Direcci&oacute;n: <?php echo $dentista->direccion; ?></label>
								            
								            <br>

								            <i class="fas fa-university"></i><label for="descripcion">&nbsp;Descripci&oacute;n: <?php echo $dentista->descripcion; ?></label>

								            <br>

								            <i class="fas fa-phone-alt"></i><label for="telefono">&nbsp;Tel&eacute;fono: <?php echo $dentista->telefono; ?></label>

								            <br>

								            <i class="fas fa-envelope fa-lg"></i><label for="correo">&nbsp;Correo electr&oacute;nico: <?php echo $dentista->correo; ?></label>

								            <br>
										</div>
									<!--Fin del IF-->
									<?php  } ?>

								<!--Fin del foreach-->
								<?php } 
							}?>

						</div>

						<div class="row">

							<div class="col-sm-6 container text-center">
								<a href="<?=base_url();?>index.php/Principal/cancelarCita/<?=$cita->idCita?>"><button style="font-weight: bold;" type="button" class="btn btn-danger navbar-brand">Cancelar cita</button></a>
							</div>

							<br>
							<br>
							<br>

							<div class="col-sm-6 container text-center">
								<button style="font-weight: bold; background-color: #1d65ac; color: white;" type="button" class="btn navbar-brand" data-toggle="modal" data-target="#ModalAC<?php echo $cita->idCita;?>">Modificar cita</button>
							</div>
						</div>

						<!--Modal con el formulario para actualizar los datos de la cita-->
						<div class="modal fade" id="ModalAC<?php echo $cita->idCita;?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">

									<!--Botón para cerrar el modal-->
									<div><button type="button" class="btn" data-dismiss="modal"><span aria-hidden="true">&times;</span></button></div>

									<div class="modal-body border-rounded my-1 p-4">

										<!--Título-->
								        <h4 class="text-center font-weight-bold">Modificar cita</h4>

								        <!--Imágen-->
								        <div class="text-center">
								          <img src="<?php echo base_url(); ?>img/citas.png" class="img-fluid mx-auto d-block rounded-circle img-responsive" style="width:40%">
								        </div>
								        
								        <!--Formulario para solicitar datos-->
								        <form action="<?=base_url();?>index.php/Principal/modificarCita/<?=$cita->idCita?>" method="post">
								        	<div class="md-form">
								        		<h2 id="cita" name="cita">Datos de la cita</h2>

												<i class="far fa-calendar-check"></i><label for="fecha">&nbsp;Fecha: <?php echo $cita->fecha; ?></label>

												<br>

												<i class="fas fa-hourglass-end"></i><label for="hora">&nbsp;Hora: <?php echo $cita->hora; ?></label>

												<br>
												<br>

									            <i class="far fa-calendar-alt"></i><label for="fechaN">&nbsp;Nueva fecha</label>
									            <input id="fechaN" name="fechaN" class="form-control" type="date" required="" placeholder="dd/mm/aaaa">

									            <br>

									            <i class="far fa-clock"></i><label for="horaN">&nbsp;Nueva hora</label>
									            <input id="horaN" name="horaN" class="form-control" type="time" required="" placeholder="hh:mm">

									            <br>
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
								          				<button type="submit" class="btn btn-secondary btn-lg active"><i class="fas fa-pencil-alt"></i> Actualizar</button>
								          			</div>
								          		</div>
								          	</div>
								          </div>

								        </form>
								    </div>
								</div>
							</div>
						</div>
					<!--Fin del IF-->
					<?php  } ?>



				<!--Fin del recorrido de las citas-->	
				<?php } ?>

				<!--En caso de que el dentista no tenga ninguna cita-->
				<?php if ($bandera2 == 'false') {?>
					<br><br>
					<div class="jumbotron jumbotron-fluid">
						<div class="container">
							<h1 class="display-4">No hay citas agendadas por el momento.</h1>
							<p class="lead">¿Desea crear una nueva cita?</p>
							<a href="<?php echo base_url(); ?>index.php/Principal/agendarCita/"><button type="button" class="btn btn-success btn-lg" href=>Agendar cita</button></a>
							<br>
							<br>
						</div>
					</div>
				<?php } ?>

			<?php } ?>

		</div>
	<?php } ?>		

</div>