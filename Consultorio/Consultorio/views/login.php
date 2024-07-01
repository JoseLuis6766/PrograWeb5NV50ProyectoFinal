<?php require "../template/head.php"; ?>

<?php

  require "../classes/db.php";

  //$conn = new PDO('mysql:host=127.0.0.1;dbname=consultorio;', 'root', ''); // Sentencia auxiliar

  session_start();

  if (isset($_SESSION['id'])) {
    header('Location: ../index.php');
  }

  if (isset($_POST['login'])) {

    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $records = DB::connect()->prepare('SELECT id, correo, contrasena FROM cuentas WHERE correo = :correo');
    $records->bindParam(':correo', $correo);
    $records->execute();

    $results = $records->fetch(PDO::FETCH_ASSOC);

    if(!empty($results) && password_verify($contrasena, DB::query('SELECT contrasena FROM cuentas WHERE correo=:correo', array(':correo'=>$correo))[0]['contrasena'])) {
      $_SESSION['id'] = $results['id'];
      echo '<script> 
                    swal({
                    title: "Completado",
                    text: "Logeo Exitoso",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                    }, function () {
                        window.location.href="../index.php";
                    });
                    </script>';
    } else {
      echo '<script> 
            swal("Credenciales","Las credenciales no coinciden","error");
            </script>'; 
    }

  }

?>

   <div class="login-box">
    <img src="<?= BASE_URL ?>/assets/img/avatar.jpg" class="avatar" alt="Avatar Image">
    <h1>Formulario de Acceso</h1>
    <form action="login.php" method="post">

      <label for="correo">Correo</label>
      <input name="correo" type="email" placeholder="Ingresa tu correo electronico" required>

      <label for="contrasena">Contraseña</label>
      <input name="contrasena" type="password" placeholder="Ingresa tu contraseña" required>
      <input type="submit" name="login" value="Acceder">

      <a href="recover-password.php">¿Olvidaste tu contraseña?</a><br>
      <a href="create-account.php">¿No tienes una cuenta? Crea una</a>
    </form>
  </div>
<?php require "../template/footer.php"; ?>