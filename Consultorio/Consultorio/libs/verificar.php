<?php
    
    //require '../classes/db.php';

    $enlace = new mysqli("localhost", "root", "", "consultorio"); // Consulta MySQLi Auxiliar

    $car = $_POST['carnet'];
    
    $sql=("SELECT * FROM cuentas WHERE carnet = '$car'");
    $rs = $enlace->query($sql);

    if($valores = mysqli_fetch_array($rs)) {
        echo "1";
    } else {
        echo "0"; 
    }

?>