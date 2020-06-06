<div class="container" style="margin-top:1em">
	<div class="row">
		<div class="col-sm-12">
			<h1 class="text-center font-weight-bold">Agendar una cita</h1>
		</div>
	</div>

  <!--Formulario para solicitar datos-->
  <form action="<?=base_url();?>index.php/Principal/crearCita/" method="post">
  	<div class="md-form">
		<br>
		<br>

          <i class="far fa-calendar-alt"></i><label for="fecha">&nbsp;Fecha</label>
          <input id="fecha" name="fecha" class="form-control" type="date" required="" placeholder="dd/mm/aaaa">

          <br>

          <i class="far fa-clock"></i><label for="hora">&nbsp;Hora</label>
          <input id="hora" name="hora" class="form-control" type="time" required="" placeholder="hh:mm">

          <br>

          <div class="form-group">
			<i class="fas fa-tooth"></i><label for="dentista">&nbsp;Dentista </label>
			<select name="dentista" id="dentista">
				<?php if ($dentistas != FALSE) {
					foreach ($dentistas->result() as $dentista) {?>

						<option value="<?php echo $dentista->idDentista ?>">
							<?php echo $dentista->nombre; ?>
						</option>

					<?php }?>
				<?php }?>
			</select>
		</div>
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