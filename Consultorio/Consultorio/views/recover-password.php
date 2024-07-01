<?php require "../template/head.php"; ?>
<?php
  require '../classes/db.php';

  if (isset($_POST['recuperar'])) {
      $correo = $_POST['correo'];
      $carnet = $_POST['carnet'];
      $nuevaContrasena = $_POST['contrasena'];

      if (DB::query('SELECT carnet FROM cuentas WHERE correo=:correo AND carnet=:carnet', array(':correo'=>$correo, ':carnet'=>$carnet))) {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
          if (strlen($nuevaContrasena) >= 6 && strlen($nuevaContrasena) <=32) {
            $consulta = (DB::query('UPDATE cuentas SET contrasena=:contrasena WHERE carnet=:carnet', array(':contrasena'=>password_hash($nuevaContrasena, PASSWORD_BCRYPT), ':carnet'=>$carnet)));
            if(!$consulta) {
              echo '<script> 
                    swal({
                    title: "Completado",
                    text: "El registro se realizó de manera correcta",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                    }, function () {
                        window.location.href="login.php";
                    });
                    </script>';
            } else {
              echo '<script> 
                  swal("Registro","Algo salió mal intenta nuevamente","error");
                  </script>'; 
            }
          } else {
            echo '<script> 
                  swal("Contraseña","La contraseña está mal intenta nuevamente","error");
                  </script>'; 
          }
        } else {
          echo '<script> 
                swal("Correo","El correo está mal intenta nuevamente","error");
                </script>'; 
        }
      } else {
        echo '<script> 
              swal("Inexistente","No existe el registro en la base de datos, intenta nuevamente","error");
              </script>'; 
      }
  }
?>
   <div class="recover-box">
    <img src="<?= BASE_URL ?>/assets/img/avatar.jpg" class="avatar" alt="Avatar Image">
    <h1>Recuperar Contraseña</h1>
    <form action="recover-password.php" method="post">

      
      <div>
        <label for="correo">Correo de ingreso al Consultorio</label>
        <input name="correo" type="email" placeholder="Ingresa tu correo electronico" required>
      </div>
      <div>
        <label for="contrasena">Nueva Contraseña</label>
        <input name="contrasena" type="password" placeholder="Escribe una nueva contraseña contraseña" required>
      </div>
      <div>
        <label for="carnet">Confirmar Carnet</label>
        <input name="carnet" type="text" placeholder="Confirma con tu carnet" required>
      </div>

      <input type="submit" name="recuperar" value="Recuperar">

      <a href="<?= BASE_URL ?>/views/login.php">Volver al Login</a><br>
    </form>
  </div>
<?php require "../template/footer.php"; ?>