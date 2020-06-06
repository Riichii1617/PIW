<div class="container" style="margin-top:1em">
	<div class="row">
		<div class="col-sm-12">
			<h1 class="text-center font-weight-bold">Dentistas registrados</h1>
		</div>
	</div>

	<!--Condición para verificar que haya dentistas-->
	<?php if ($dentistas != FALSE) {$i=0;

		//--Se hace un recorrido de todas las dentistas--//
		foreach ($dentistas->result() as $row) {$i++;?>

			<div class="container-fluid" style="margin-top:1em">

				<hr>

				<div class="row">

					<div class="col-sm-4">
						
						<!--Imágen de perfil-->
				        <div>
				        	<img src="<?php echo base_url(); ?>img/dentista.png" class="img-fluid mx-auto d-block rounded-circle img-responsive" style="width:75%">
				        </div>

					</div>

					<div class="col-sm-6">

						<!--Datos-->
						<h2 id="nombre" name="nombre">Dr(a). <?php echo $row->nombre;?>&nbsp;<?php echo $row->apellidos; ?></h2>

				        <br>

				        <i class="fas fa-user-graduate"></i><label for="cedula">&nbsp;C&eacute;dula profesional: <?php echo $row->cedula; ?></label>

				        <br>

			            <i class="fas fa-map-marked"></i><label for="direccion">&nbsp;Direcci&oacute;n: <?php echo $row->direccion; ?></label>
			            
			            <br>

			            <i class="fas fa-university"></i><label for="descripcion">&nbsp;Descripci&oacute;n: <?php echo $row->descripcion; ?></label>

			            <br>

			            <i class="fas fa-phone-alt"></i><label for="telefono">&nbsp;Tel&eacute;fono: <?php echo $row->telefono; ?></label>

			            <br>

			            <i class="fas fa-envelope fa-lg"></i><label for="correo">&nbsp;Correo electr&oacute;nico: <?php echo $row->correo; ?></label>

			            <br>

					</div>

					<div class="col-sm-2">
						<!--Si el usuario es un paciente le permite agendar una cita-->
						<?php if ($this->session->userdata('tipo')=='Usuario') {?>
							<br>
							<br>
							<p class="lead">¿Desea crear una nueva cita?</p>


							<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#ModalACD<?php echo $row->idDentista;?>">Agendar cita</button></a>

							<div class="modal fade" id="ModalACD<?php echo $row->idDentista;?>" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">

										<!--Botón para cerrar el modal-->
										<div><button type="button" class="btn" data-dismiss="modal"><span aria-hidden="true">&times;</span></button></div>

										<div class="modal-body border-rounded my-1 p-4">

											<!--Título-->
									        <h4 class="text-center font-weight-bold">Agendar cita</h4>

									        <!--Imágen-->
									        <div class="text-center">
									          <img src="<?php echo base_url(); ?>img/citas.png" class="img-fluid mx-auto d-block rounded-circle img-responsive" style="width:40%">
									        </div>
									        
									        <!--Formulario para solicitar datos-->
									        <form action="<?php echo base_url(); ?>index.php/Principal/crearCitaS/<?=$row->idDentista?>" method="post">
									        	<div class="md-form">
									        		<h2 id="cita" name="cita">Datos de la cita</h2>

										            <i class="far fa-calendar-alt"></i><label for="fecha">&nbsp;Fecha</label>
										            <input id="fecha" name="fecha" class="form-control" type="date" required="" placeholder="dd/mm/aaaa">

										            <br>

										            <i class="far fa-clock"></i><label for="hora">&nbsp;Hora</label>
										            <input id="hora" name="hora" class="form-control" type="time" required="" placeholder="hh:mm">

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
									          				<button type="submit" class="btn btn-secondary btn-lg active"><i class="fas fa-pencil-alt"></i> Agendar</button>
									          			</div>
									          		</div>
									          	</div>
									          </div>

									        </form>
									    </div>
									</div>
								</div>
							</div>
						<?php } ?>
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
				<h1 class="display-4">No hay dentistas registrados por el momento.</h1>
				<img src="<?php echo base_url(); ?>img/trabajando.jpg" class="img-fluid mx-auto d-block" style="width:75%">
			</div>
		</div>
		<br>
	<!--Fin del IF-->
	<?php } ?>
</div>