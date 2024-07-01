<?php require "template/head.php"; ?>
<?php
  session_start();

  require 'classes/db.php';

  if (isset($_SESSION['id'])) {
    $records = DB::connect()->prepare('SELECT id, correo, contrasena, carnet FROM cuentas WHERE id = :id');
    $records->bindParam(':id', $_SESSION['id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $account = DB::connect()->prepare('SELECT id, nombre, apellidos, telefono, fechaNacimiento, direccion, carnet FROM usuarios WHERE carnet = :carnet');
    $account->bindParam(':carnet', $results['carnet']);
    $account->execute();
    $consultado = $account->fetch(PDO::FETCH_ASSOC);

    $foto = DB::connect()->prepare('SELECT id, imagen, carnet FROM fotos WHERE carnet = :carnet');
    $foto->bindParam(':carnet', $results['carnet']);
    $foto->execute();
    $avatar = $foto->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }

  if (isset($_POST['guardar'])) {

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $direccion = $_POST['direccion'];
    $carnet = $results['carnet'];

    if (strlen($nombre) <= 60 ) {
        if (preg_match('~^[\p{L}\p{Z}]+$~u', $nombre)) {
            if (strlen($apellidos) <= 60 ) {
                if (preg_match('~^[\p{L}\p{Z}]+$~u', $apellidos)) {
                    if (strlen($telefono) <= 10 && preg_match('/[0-9]/', $telefono)) {
                        $update1 = (DB::query('UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, telefono = :telefono, fechaNacimiento = :fechaNacimiento, direccion = :direccion WHERE carnet = :carnet', array(':nombre'=>$nombre, ':apellidos'=>$apellidos, ':telefono'=>$telefono, ':fechaNacimiento'=>$fechaNacimiento, ':direccion'=>$direccion, ':carnet'=>$carnet)));
                        if(!$update1) {
                          echo '<script> 
                                swal({
                                title: "Completado",
                                text: "El registro se modificó de manera correcta",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                                }, function () {
                                    window.location.href="cuenta.php";
                                });
                                </script>';
                        } else {
                          echo '<script> 
                              swal("Insertar","El registro no pudo ser modificado, intenta nuevamente","error");
                              </script>'; 
                        }
                    } else {
                        echo '<script> 
                            swal("Numero","El numero escrito tiene un error, intenta nuevamente","error");
                            </script>'; 
                    }
                } else {
                    echo '<script> 
                        swal("Apellidos","El apellido incluye algun caractér invalido","error");
                        </script>'; 
                }
            } else {
                echo '<script> 
                    swal("Apellidos","El apellido es mayor a 60 caracteres","error");
                    </script>';
            }
        } else {
            echo '<script> 
                swal("Nombre","El nombre incluye algun caractér invalido","error");
                </script>';
        } 
    } else {
        echo '<script> 
            swal("Nombre","El nombre es mayor a 60 caracteres","error");
            </script>';
    }
  }

  if (isset($_POST['guardar'])) {
    $imagen = $_FILES['imagen']['name'];
    $$carnet = $results['carnet'];


    if (isset($imagen) && $imagen != "") {
        $tipo = $_FILES['imagen']['type'];
        $temp = $_FILES['imagen']['tmp_name'];

        if ($tipo == "image/jpg" || $tipo == "image/jpeg" || $tipo == "image/pjpeg" || $tipo == "image/png" || $tipo == "image/gif") {
            $profile = (DB::query('UPDATE fotos SET imagen = :imagen WHERE carnet = :carnet', array(':imagen'=>$imagen, ':carnet'=>$carnet)));
            if (!$profile) {
                move_uploaded_file($temp, 'assets/img/users/'.$imagen);
                echo "Guardado correctamente el archivo: ".$imagen;
            } else {
                echo "Hubo un error con el archivo: ".$imagen;
            }

        } else {
            echo "Solo se permiten archivos: JPG, JPEG, PJPEG, PNG, GIF";
        }
    } 
}

?>
<?php if(!empty($user)): ?>

  <?php require "views/account.php"; ?>
  <?php require "template/sidebar.php"; ?>

<?php else: ?>
    <?php
        header('Location: index.php');    
    ?>
<?php endif; ?>
<?php require "template/footer.php"; ?>