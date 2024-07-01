<?php require "template/head.php"; ?>
<?php
  session_start();

  require 'classes/db.php';

  if (isset($_SESSION['id'])) {
    $records = DB::connect()->prepare('SELECT id, correo, contrasena, carnet FROM cuentas WHERE id = :id');
    $records->bindParam(':id', $_SESSION['id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>
<?php if(!empty($user)): ?>
    <?php require "views/principal.php"; ?>
  <?php require "template/sidebar.php"; ?>

  <!-- <br> Bienvenido: <?php //$user['correo']; ?>
  <h1>Estamos en el login xDD</h1>
  <a href="logout.php">Cerrar Sesion.</a> -->
<?php else: ?>
    <div class="start">
        <!-- <img class="avatar" src="assets/img/avatar.png" alt="avatar"> -->
        <h1>Consultorio Dental</h1>
        <p> Bienvenido al sistema de gestion de consultorio, puedes registrarte con nosotros o acceder con una cuenta creada previamente.</p>
        <p>Toda la realización de esta pagina fue lograda mediante el uso de: </p>
        <br><br>
        <div class="con">
          <i class="fa-brands fa-html5">
            <p>HTML5</p>
          </i> 
          <i class="fa-brands fa-css3-alt">
            <p>CSS3</p>
          </i>
          <i class="fa-brands fa-square-js">
            <p>JavaScript</p>
          </i>
          <i class="fa-brands fa-php">
            <p>PHP7.4</p>
          </i>
          <i class="fa-solid fa-database">
            <p>phpMyAdmin</p>
          </i>
          <i class="fa-solid fa-code">
            <p>Ajax JQuery</p>
          </i>
        </div>
        <br><br>
        <div class="accesos">
          <a href="views/login.php">Iniciar sesion</a> Ó
          <a href="views/create-account.php">Crear Cuenta</a>
        </div>
        
    </div>
<?php endif; ?>
<?php require "template/footer.php"; ?>