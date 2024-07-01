<?php require "template/head.php"; ?>
<?php
  session_start();

  require 'classes/db.php';

  $conn = new PDO('mysql:host=127.0.0.1;dbname=consultorio;', 'root', ''); // Sentencia auxiliar

  if (isset($_SESSION['id'])) {
    $records = DB::connect()->prepare('SELECT id, correo, contrasena, carnet FROM cuentas WHERE id = :id');
    $records->bindParam(':id', $_SESSION['id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    /*$agenda = DB::connect()->prepare('SELECT id, correo, contrasena, carnet FROM cuentas WHERE id = :id');
    $agenda->bindParam(':id', $_SESSION['id']);
    $agenda->execute();*/

    //$columnas = DB::connect()->prepare('SELECT id, correo, contrasena, carnet FROM doctores WHERE id = :id');
    /*SELECT Con.id, 
		Doc.nombre,
    Con.fecha, Con.hora, 
Us.nombre,
Con.estatus
FROM citas_agendadas Con
INNER JOIN doctores Doc ON Con.doctor = Doc.cedula
INNER JOIN usuarios Us ON Con.paciente = Us.carnet*/
    //select c.id, d.nombre, c.fecha, c.hora, u.nombre, c.estatus from doctores d, usuarios u, citas_agendadas c WHERE d.cedula = c.doctor AND u.carnet = c.paciente;
    /* $columnas = DB::connect()->prepare('SELECT c.id, d.nombre, c.fecha, c.hora, u.nombre, c.estatus FROM doctores d, usuarios u, citas_agendadas c WHERE d.cedula = c.doctor AND u.carnet = c.paciente'); */
    /*$query = ('SELECT Con.id, 
                        Doc.nombre_d,
                        Con.fecha, 
                        Con.hora, 
                        Con.estatus
                FROM citas_agendadas Con
                INNER JOIN doctores Doc ON Doc.cedula = Con.doctor');*/
    $query = ('SELECT cita.id, doc.nombre_d, cita.fecha, cita.hora, u.nombre, cita.estatus 
                FROM citas_agendadas cita INNER JOIN doctores doc 
                ON cita.doctor = doc.cedula 
                  left outer JOIN usuarios u 
                ON cita.paciente = u.carnet');
    //$columnas->bindParam(':carnet', $records['carnet']);
    //$columnas->execute();
    $columnas = $conn->query($query);
    //$ag = $agenda->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>
<?php if(!empty($user)): ?>
    
    <?php require "views/dates.php"; ?>
    <?php require "template/sidebar.php"; ?>

<?php else: ?>
    <?php
        header('Location: index.php');    
    ?>
<?php endif; ?>
<?php require "template/footer.php"; ?>