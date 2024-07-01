<?php require "template/head.php"; ?>
<?php
  session_start();

  require 'classes/db.php';

  if (isset($_SESSION['id'])) {
    $records = DB::connect()->prepare('SELECT id, correo, contrasena, carnet FROM cuentas WHERE id = :id');
    $records->bindParam(':id', $_SESSION['id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $expediente = DB::connect()->prepare('SELECT id, archivo, carnet FROM expediente WHERE carnet = :carnet');
    $expediente->bindParam(':carnet', $results['carnet']);
    $expediente->execute();
    $exp = $expediente->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>
<?php if(!empty($user)): ?>

    <?php require "views/record.php"; ?>
    <?php require "template/sidebar.php"; ?>

<?php else: ?>

<?php endif; ?>
<?php require "template/footer.php"; ?>