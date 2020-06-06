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
			<h1 class="text-center font-weight-bold">Perfil</h1>
		</div>
	</div>

	<?php if ($this->session->userdata('tipo')=='Usuario') {?>

		<!--Condición para verificar que exista el perfil-->
		<?php if ($usuarios != FALSE) {$i=0;

			//--Se hace un recorrido--//
			foreach ($usuarios->result() as $usuario) {$i++;?>

				<div class="container-fluid" style="margin-top:1em">

					<!--Datos-->
					<div class="text-center">
						<img src="<?php echo base_url(); ?>img/usuario.png" class="rounded-circle img-responsive img-fluid mx-auto d-block" style="width:30%">
						<br>
						<h2 ><?php echo $usuario->nombre;?>&nbsp;<?php echo $usuario->apellidos; ?></h2>
						<br>
					</div>

					<div class="row">

						<div class="col-sm-4"></div>

						<div class="col-sm-5">
							<i class="fas fa-map-marked"></i><label for="direccion">&nbsp;Direcci&oacute;n: <?php echo $usuario->direccion; ?></label>
			            
				            <br>

				            <i class="fas fa-phone-alt"></i><label for="telefono">&nbsp;Tel&eacute;fono: <?php echo $usuario->telefono; ?></label>

				            <br>

				            <i class="fas fa-envelope fa-lg"></i><label for="correo">&nbsp;Correo electr&oacute;nico: <?php echo $usuario->correo; ?></label>
						</div>

						<div class="col-sm-3"></div>
						<br>
					</div>

			        <div class="text-center">
			            <button type="button" class="registrar btn navbar-brand" data-toggle="modal" data-target="#ModalAU">
			            	<i class="fas fa-user-edit"></i> Actualizar datos
			            </button>
			            <br>
		            </div>

			    </div>

			    <div class="modal fade" id="ModalAU" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">

							<!--Botón para cerrar el modal-->
							<div><button type="button" class="btn" data-dismiss="modal"><span aria-hidden="true">&times;</span></button></div>

							<div class="modal-body border-rounded my-1 p-4">

								<!--Título-->
						        <h4 class="text-center font-weight-bold">Actualizar datos de contacto</h4>

						        <!--Imágen-->
						        <div class="text-center">
						          <img src="<?php echo base_url(); ?>img/editar.png" class="img-fluid mx-auto d-block rounded-circle img-responsive" style="width:40%">
						        </div>
						        
						        <!--Formulario para solicitar datos-->
						        <form action="<?=base_url();?>index.php/Principal/actualizarUsuario/<?=$usuario->idUsuario?>" method="post">
						        	<div class="md-form">
						        		<h2 id="cita" name="cita">Datos</h2>

						        		<i class="fas fa-map-marked"></i>
						        		<input class="form-control" type="text" id="direccion" name="direccion" value="<?php echo $usuario->direccion;?>">
							            <br>

							            <i class="fas fa-phone-alt"></i>
							            <input class="form-control" type="text" id="telefono" name="telefono" value="<?php echo $usuario->telefono;?>">

							            <br>

							            <i class="fas fa-envelope fa-lg"></i>
							            <input class="form-control" type="text" id="correo" name="correo" value="<?php echo $usuario->correo;?>"> 

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

			<?php } 
		}?>
	<?php }?>

	<?php if ($this->session->userdata('tipo')=='Dentista') {?>

		<!--Condición para verificar que exista el perfil-->
		<?php if ($dentistas != FALSE) {$i=0;

			//--Se hace un recorrido de todas las citas--//
			foreach ($dentistas->result() as $dentista) {$i++;?>

				<div class="container-fluid" style="margin-top:1em">

					<!--Datos-->
					<div class="text-center">
						<img src="<?php echo base_url(); ?>img/dentista.png" class="rounded-circle img-responsive img-fluid mx-auto d-block" style="width:30%">
						<br>
						<h2 ><?php echo $dentista->nombre;?>&nbsp;<?php echo $dentista->apellidos; ?></h2>
						<br>
					</div>

					<div class="row">

						<div class="col-sm-4"></div>

						<div class="col-sm-5">
							<i class="fas fa-map-marked"></i><label for="direccion">&nbsp;Direcci&oacute;n: <?php echo $dentista->direccion; ?></label>
			            
				            <br>

				            <i class="fas fa-university"></i><label for="descripcion">&nbsp;Descripci&oacute;n: <?php echo $dentista->descripcion; ?></label>

			            	<br>

				            <i class="fas fa-phone-alt"></i><label for="telefono">&nbsp;Tel&eacute;fono: <?php echo $dentista->telefono; ?></label>

				            <br>

				            <i class="fas fa-envelope fa-lg"></i><label for="correo">&nbsp;Correo electr&oacute;nico: <?php echo $dentista->correo; ?></label>
						</div>

						<div class="col-sm-3"></div>
						<br>
					</div>

			        <div class="text-center">
			            <button type="button" class="registrar btn navbar-brand" data-toggle="modal" data-target="#ModalAD">
			            	<i class="fas fa-user-edit"></i> Actualizar datos
			            </button>
			            <br>
		            </div>

			    </div>

			    <div class="modal fade" id="ModalAD" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">

							<!--Botón para cerrar el modal-->
							<div><button type="button" class="btn" data-dismiss="modal"><span aria-hidden="true">&times;</span></button></div>

							<div class="modal-body border-rounded my-1 p-4">

								<!--Título-->
						        <h4 class="text-center font-weight-bold">Actualizar datos de contacto</h4>

						        <!--Imágen-->
						        <div class="text-center">
						          <img src="<?php echo base_url(); ?>img/editar.png" class="img-fluid mx-auto d-block rounded-circle img-responsive" style="width:40%">
						        </div>
						        
						        <!--Formulario para solicitar datos-->
						        <form action="<?=base_url();?>index.php/Principal/actualizarDentista/<?=$dentista->idDentista?>" method="post">
						        	<div class="md-form">
						        		<h2 id="cita" name="cita">Datos</h2>

						        		<i class="fas fa-map-marked"></i>
						        		<input class="form-control" type="text" id="direccion" name="direccion" value="<?php echo $dentista->direccion;?>">

							            <br>

							            <i class="fas fa-university"></i>
							            <input class="form-control" type="text" id="descripcion" name="descripcion" value="<?php echo $dentista->descripcion;?>">

							            <br>

							            <i class="fas fa-phone-alt"></i>
							            <input class="form-control" type="text" id="telefono" name="telefono" value="<?php echo $dentista->telefono;?>">

							            <br>

							            <i class="fas fa-envelope fa-lg"></i>
							            <input class="form-control" type="text" id="correo" name="correo" value="<?php echo $dentista->correo;?>"> 

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
			<?php } 
		}?>

	<?php }?>
</div>