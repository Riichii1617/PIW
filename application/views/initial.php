<!--Si el usuario es un administrador-->
<?php if ($this->session->userdata('tipo')=='Administrador') {?>

	<div class="container" style="margin-top:1em">

		<div class="row">
			<div class="col-sm-12">
				<h1 class="text-center font-weight-bold">¡Bienvenido nuevamente <?php echo ($this->session->userdata('nombre'));?>!</h1>
			</div>
		</div>

	</div>

	<div class="row">

		<div class="col-md-6">
			<div class="container text-center">
				<img src="<?php echo base_url(); ?>img/solicitudes.jpg" class="img-fluid mx-auto d-block" style="width:45%">
				<a href="<?php echo base_url(); ?>index.php/Principal/solicitudes/"><button type="button" class="btn btn-success btn-lg">Solicitudes</button></a>
			</div>
		</div>

		<div class="col-md-6">
			<div class="container text-center">
				<img src="<?php echo base_url(); ?>img/citas.png" class="img-fluid mx-auto d-block" style="width:45%">
				<a href="<?php echo base_url(); ?>index.php/Principal/citas/"><button type="button" class="btn btn-success btn-lg">Citas</button></a>
			</div>
		</div>

	</div>

	<div class="row">

		<div class="col-md-6">
			<div class="container text-center">
				<img src="<?php echo base_url(); ?>img/dentistas.png" class="img-fluid mx-auto d-block" style="width:45%">
				<a href="<?php echo base_url(); ?>index.php/Principal/dentistas/"><button type="button" class="btn btn-success btn-lg">Dentistas</button></a>
			</div>
		</div>

		
		<div class="col-md-6">
			<div class="container text-center">
				<img src="<?php echo base_url(); ?>img/usuarios.png" class="img-fluid mx-auto d-block" style="width:45%">
				<a href="<?php echo base_url(); ?>index.php/Principal/usuarios/"><button type="button" class="btn btn-success btn-lg">Usuarios</button></a>
			</div>
		</div>

	</div>

	<br>
<!--Fin del IF-->
<?php }?>

<!--Si el usuario es un dentista-->
<?php if ($this->session->userdata('tipo')=='Dentista') {?>
	<div class="container" style="margin-top:1em">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="text-center font-weight-bold">¡Bienvenido nuevamente <?php echo ($this->session->userdata('nombre'));?>!</h1>
			</div>
		</div>
	</div>

	<div class="row">

		<div class="col-md-6">
			<div class="container text-center">
				<img src="<?php echo base_url(); ?>img/citas.png" class="img-fluid mx-auto d-block" style="width:50%">
				<p><a href="<?php echo base_url(); ?>index.php/Principal/citas/"><button type="button" class="btn btn-success btn-lg" href=>Citas</button></a></p>
			</div>
		</div>

		<div class="col-md-6">
			<div class="container text-center">
				<img src="<?php echo base_url(); ?>img/perfil.png" class="img-fluid mx-auto d-block" style="width:50%">
				<a href="<?php echo base_url(); ?>index.php/Principal/perfil/"><button type="button" class="btn btn-success btn-lg">Perfil</button></a>
			</div>
		</div>

	</div>

	<br><br><br><br>
<!--Fin del IF-->
<?php }?>


<!--Si el usuario es un paciente-->
<?php if ($this->session->userdata('tipo')=='Usuario') {?>

	<div class="container" style="margin-top:1em">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="text-center font-weight-bold">¡Bienvenido nuevamente <?php echo ($this->session->userdata('nombre'));?>!</h1>
			</div>
		</div>
	</div>

	<div class="row">

		<div class="col-md-6">
			<div class="container text-center">
				<img src="<?php echo base_url(); ?>img/citas.png" class="img-fluid mx-auto d-block" style="width:50%">
				<p><a href="<?php echo base_url(); ?>index.php/Principal/citas/"><button type="button" class="btn btn-success btn-lg" href=>Citas</button></a></p>
			</div>
		</div>


		<div class="col-md-6">
			<div class="container text-center">
				<img src="<?php echo base_url(); ?>img/agendar.png" class="img-fluid mx-auto d-block" style="width:50%">
				<p><a href="<?php echo base_url(); ?>index.php/Principal/agendarCita/"><button type="button" class="btn btn-success btn-lg" href=>Agendar cita</button></a></p>
			</div>
		</div>

	</div>

	<div class="row">

		<div class="col-md-6">
			<div class="container text-center">
				<img src="<?php echo base_url(); ?>img/dentistas.png" class="img-fluid mx-auto d-block" style="width:50%">
				<a href="<?php echo base_url(); ?>index.php/Principal/dentistas/"><button type="button" class="btn btn-success btn-lg">Dentistas</button></a>
			</div>
		</div>

		<div class="col-md-6">
			<div class="container text-center">
				<img src="<?php echo base_url(); ?>img/perfil.png" class="img-fluid mx-auto d-block" style="width:50%">
				<a href="<?php echo base_url(); ?>index.php/Principal/perfil/"><button type="button" class="btn btn-success btn-lg">Perfil</button></a>
			</div>
		</div>

	</div>
<!--Fin del IF-->
<?php }?>