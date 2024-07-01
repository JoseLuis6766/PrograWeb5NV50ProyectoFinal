<?php require "../template/head.php"; ?>
<?php

    require '../classes/db.php';

    if (isset($_POST['enviar'])) {

        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $numero = $_POST['numero'];
        $direccion = $_POST['direccion'];
        $nacimiento = $_POST['fecha'];

        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];

        $carnet = $_POST['carnet'];
        
        if (!DB::query('SELECT carnet FROM cuentas WHERE carnet =:carnet', array(':carnet'=>$carnet))) {
            if (strlen($nombre) <= 60 ) {
                if (preg_match('~^[\p{L}\p{Z}]+$~u', $nombre)) {
                    if (strlen($apellidos) <= 60 ) {
                        if (preg_match('~^[\p{L}\p{Z}]+$~u', $apellidos)) {
                            if (strlen($numero) <= 10 && preg_match('/[0-9]/', $numero)) {
                                if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                                    if (strlen($contrasena) >= 6 && strlen($contrasena) <=32) {
                                        $res1 = DB::query('INSERT INTO usuarios VALUES (null, :nombre, :apellidos, :telefono, :fechaNacimiento, :direccion, :carnet)', array(':nombre'=>$nombre, ':apellidos'=>$apellidos, ':telefono'=>$numero, ':fechaNacimiento'=>$nacimiento, ':direccion'=>$direccion, ':carnet'=>$carnet));
                                        if (!$res1) {
                                            $res2 = DB::query('INSERT INTO cuentas VALUES (null, :correo, :contrasena, :carnet)', array(':correo'=>$correo, ':contrasena'=>password_hash($contrasena, PASSWORD_BCRYPT), ':carnet'=>$carnet));
                                            if(!$res2) {

                                                DB::query('INSERT INTO fotos VALUES (null, null, :carnet)', array(':carnet'=>$carnet));

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
                                            }
                                            /*echo '<script> 
                                                swal("Completado","El registro se realizó de manera correcta","success");
                                                </script>';
                                            */
                                        }
                                    } else {
                                        echo '<script> 
                                            swal("Contraseña","La contraseña tiene una longitud incorrecta","error");
                                            </script>'; 
                                    }
                                } else {
                                    echo '<script> 
                                        swal("Correo","El correo es invalido, favor de revisar","error");
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
        } else {
            echo '<script> 
                swal("Carnet","El carnet ingresado ya pertenece a alguien","error");
                </script>';
        }
    }
?>
    <div class="create-box">
        <img src="<?= BASE_URL ?>/assets/img/avatar.jpg" class="avatar" alt="Avatar Image">
        <h1>Formulario de Registro</h1>
        <form action="create-account.php" method="post">

        <div id="wrapper">
        <div class="scrollbar" id="style-default">
        <div class="force-overflow">

        <div>
            <label for="nombre">Nombre(s)</label>
            <input name="nombre" type="text" placeholder="Escribe tu nombre completo" required maxlength="60">
        </div>
        <div>
            <label for="apellidos">Apellidos</label>
            <input name="apellidos" type="text" placeholder="Escribe tus apellidos" required maxlength="60">
        </div>
        <div>
            <label for="numero">Numero Telefonico</label>
            <input name="numero" type="text" placeholder="Escribe tu número de telefono" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="10" required>
        </div>
        <div>
            <label for="direccion">Dirección</label>
            <input name="direccion" type="text" placeholder="Escribe tu dirección" required>
        </div>
        <div>
            <label for="nacimiento">Fecha de Nacimiento</label>
            <input name="fecha" type="date" required>
        </div>
        <div>
            <label for="correo">Correo Electronico</label>
            <input name="correo" type="email" placeholder="Escribe tu correo electronico" required>
        </div>
        <div>
            <label for="contrasena">Contraseña</label>
            <input name="contrasena" type="password" placeholder="Escribe una contraseña" required>
        </div>
        <div>
            <label for="carnet">Carnet</label>
            <input type="text" name="carnet" id="carnet" onchange="verificarCarnet()" placeholder="Escribe tu carnet designado" required maxlength="6">
            <span id="iconoResultado"></span>
        </div>
        <input type="submit" name="enviar" value="Enviar">  
    </form>
    <br>
    <a href="<?= BASE_URL ?>/views/login.php">Volver al Login</a>
  </div>
<?php require "../template/footer.php"; ?>