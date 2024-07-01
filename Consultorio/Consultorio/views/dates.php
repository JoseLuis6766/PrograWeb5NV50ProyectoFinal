<section class="date_section">
    <div class="date-box">
        <div class="col-md-12">
            <label class="etiquetas">Tabla de Citas del 6 al 10 de Febrero</label>
        </div>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Doctor</th>
                <th scope="col">Fecha</th>
                <th scope="col">hora</th>
                <th scope="col">Paciente</th>
                <th scope="col">Estatus</th>
                <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = $columnas->fetch(PDO::FETCH_ASSOC)) { 
                ?>
                <tr>    
                    <th scope="row"><?php echo $row['id']?></th>
                    <td><?php echo $row['nombre_d']?></td>
                    <td><?php echo $row['fecha']?></td>
                    <td><?php echo $row['hora']?></td>
                    <td>
                        <?php 
                            if($row['nombre'] != null) {
                                echo $row['nombre'];
                            } else {
                                echo "Sin Asignar";
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            if($row['estatus'] == '1') {
                                echo "No Disponible";
                            } else {
                                echo "Disponible";
                            }
                        ?>
                    </td>
                    <td>
                        <?php 
                            if($row['estatus'] == '1') {
                                echo '<i class="fa-solid fa-xmark fa-2x"></i>';
                            } else {
                                echo '<i class="fa-solid fa-check fa-2x"></i>';
                            }
                        ?> 
                    </td>
                </tr>
                <?php 
                    }
                ?>
                </tr>
            </tbody>
        </table>
    </div>
</section>