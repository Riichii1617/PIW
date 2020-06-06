<!--CSS para el menú-->
<style>
  .containerMenu {
      display: inline-block;
      cursor: pointer;
    }

    .bar1, .bar2, .bar3 {
      width: 35px;
      height: 4px;
      background-color: #FFF;
      margin: 6px 0;
      transition: 0.4s;
    }

    .change .bar1 {
      -webkit-transform: rotate(-45deg) translate(-6px, 6px);
      transform: rotate(-45deg) translate(-6px, 6px);
    }

    .change .bar2 {opacity: 0;}

    .change .bar3 {
      -webkit-transform: rotate(45deg) translate(-8px, -8px);
      transform: rotate(45deg) translate(-8px, -8px);
    }
</style>

<!--Script para la animación del menú-->
<script>
  function myFunction(x) {
    x.classList.toggle("change");
  }
</script>


<!--Barra de navegación-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  
  <!--Botoón para el meú desplegable (sólo en móviles)-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <div class="containerMenu" onclick="myFunction(this)">
      <div class="bar1"></div>
      <div class="bar2"></div>
      <div class="bar3"></div>
    </div>
  </button>

  <!--Logo y nombre-->
  <a class="navbar-brand" href="<?php echo base_url();?>">
    <img src="<?php echo base_url();?>docs/2ic.png" width="30" height="30" class="d-inline-block align-top" alt="">&nbsp;
    Dental Care
  </a>

  <!--Si hay una sesión activa-->
  <?php if ($this->session->userdata('nombre')!='') {?>

    <!--Si el usuario es un administrador-->
    <?php if ($this->session->userdata('tipo')=='Administrador') {?>
      <!--Accesos directos-->
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/Principal/vistaInicial">Panel</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/Principal/solicitudes/">Solicitudes</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/Principal/citas/">Citas</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/Principal/dentistas/">Dentistas</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/Principal/usuarios/">Usuarios</a></li>
        </ul>
      </div>

      <span style="color: white;"><img src="<?php echo base_url(); ?>img/fsociety.png" class="rounded-circle img-responsive" style="width:1.8em;"><?php echo ($this->session->userdata('nombre'));?></span>
    <?php }?>

    <!--Si el usuario es un dentista-->
    <?php if ($this->session->userdata('tipo')=='Dentista') {?>
      <!--Accesos directos-->
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/Principal/vistaInicial">Panel</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/Principal/citas/">Citas</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/Principal/perfil/">Perfil</a></li>
        </ul>
      </div>

      <span style="color: white;"><img src="<?php echo base_url(); ?>img/dentista.png" class="rounded-circle img-responsive" style="width:1.8em;"><?php echo ($this->session->userdata('nombre'));?></span>
    <?php }?>

    <!--Si el usuario es un paciente-->
    <?php if ($this->session->userdata('tipo')=='Usuario') {?>
      <!--Accesos directos-->
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/Principal/vistaInicial">Panel</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/Principal/citas/">Citas</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/Principal/agendarCita/">Agendar cita</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/Principal/dentistas/">Dentistas</a></li>
          <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>index.php/Principal/perfil/">Perfil</a></li>
        </ul>
      </div>

      <span style="color: white;"><img src="<?php echo base_url(); ?>img/usuario.png" class="rounded-circle img-responsive" style="width:1.8em;"><?php echo ($this->session->userdata('nombre'));?></span>
    <?php }?>

    <!--Botón para cerrar sesión-->
    <button type="button" class="btn navbar-brand">
      <a style="color: white;" href="<?= site_url("/Principal/cerrarSesion"); ?>"><i class="fas fa-sign-out-alt"></i></a>
    </button>

  <!--Sí no hay ninguna sesión-->
  <?php  } else {?>

    <!--Accesos directos-->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#"></a></li>
      </ul>
    </div>

    <!--Botón para iniciar sesión (Modal)-->
    <button type="button" class="btn navbar-brand" data-toggle="modal" data-target="#sign-in-Modal">
      <a style="color: white;" href="#">Iniciar sesi&oacute;n <i class="fas fa-sign-in-alt"></i></a>
    </button>
<?php }?>

</nav>

<!--Modal para iniciar sesión-->
<div class="modal fade" id="sign-in-Modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <!--<div class="modal-dialog modal-dialog-centered" role="document">-->
    <div class="modal-content">

      <!--Botón para cerrar el modal-->
      <div><button type="button" class="btn" data-dismiss="modal"><span aria-hidden="true">&times;</span></button></div>

      <div class="modal-body border-rounded my-1 p-4">
        <!--Imágen de perfil-->
        <div class="text-center">
          <img src="<?php echo base_url(); ?>img/fsociety.png" class="rounded-circle img-responsive">
        </div>

        <!--Título-->
        <h4 class="text-center font-weight-bold">Iniciar sesi&oacute;n</h4>

        <!--Formulario para iniciar sesión-->
        <form action="<?php echo base_url(); ?>index.php/Principal/validaUsuario" method="post">
          <div class="md-form">
            <i class="fas fa-envelope"></i><label for="correo">&nbsp;Correo electr&oacute;nico</label>
            <input id="correo" name="correo" class="form-control" type="text" required="" placeholder="example@gmail.com">
            <br>
            <i class="fas fa-unlock"></i><label for="contraseña">&nbsp;Contrase&ntilde;a</label>
            <input id="contraseña" name="contraseña" class="form-control" type="password" required="" placeholder="·····">
          </div>

          <br>

          <div class="text-center">
            <button type="submit" class="btn btn-secondary btn-lg active">Iniciar sesi&oacute;n</button>
            <br>
            <p>¿A&uacute;n no se ha registrado? <a href="<?php echo base_url(); ?>index.php/Principal/registrarUsuario">Crear una cuenta</a>.</p>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
