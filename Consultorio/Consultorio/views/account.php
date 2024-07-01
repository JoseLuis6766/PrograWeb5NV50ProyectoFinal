<section class="account_section">
    <div class="edit-box">
    <div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-5 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <?php if($avatar['imagen'] == NULL ): ?>
                <img class="rounded-circle mt-5" src="assets/img/avatar-empty.jpg">
            <?php else: ?>
                <img class="rounded-circle mt-5" src="assets/img/users/<?= $avatar['imagen'] ; ?>">
            <?php endif; ?>
                <span class="font-weight-bold"><?= $consultado['nombre'] ; ?></span>
                <span>Correo: <?= $user['correo']; ?></span>
                <span>Carnet: <?= $user['carnet']; ?></span>
            </div>
        </div>
        <div class="col">
            <div class="p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Editar Perfil</h4>
                </div>
                <form action="cuenta.php" method="post" enctype="multipart/form-data">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="etiquetas">Foto</label>
                            <input type="file" name="imagen" class="cajitas">
                        </div>
                        <div class="col-md-12">
                            <label class="etiquetas">Nombre(s)</label>
                            <input type="text" name="nombre" class="cajitas" placeholder="enter phone number" value="<?= $consultado['nombre']; ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label class="etiquetas">Apellidos</label>
                            <input type="text" name="apellidos" class="cajitas" placeholder="enter phone number" value="<?= $consultado['apellidos']; ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label class="etiquetas">Numero de Telefono</label>
                            <input type="text" name="telefono" class="cajitas" placeholder="enter phone number" value="<?= $consultado['telefono']; ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label class="etiquetas">Fecha de Nacimiento</label>
                            <input type="date" name="fechaNacimiento" class="cajitas" value="<?= $consultado['fechaNacimiento']; ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label class="etiquetas">Direccion</label>
                            <input type="text" name="direccion" class="cajitas" placeholder="enter email id" value="<?= $consultado['direccion']; ?>" required>
                        </div>
                        <div class="col-md-12">
                            <!-- <label class="etiquetas">Carnet</label> -->
                            <input type="hidden" name="carnet" class="cajitas" value="<?= $consultado['carnet']; ?>" disabled>
                        </div>
                    </div>
                    <div class="mt-3 text-center">
                        <!-- <button class="btn btn-primary profile-button" value="guardar" type="submit">Guardar Cambios</button> -->
                        <input class="btn btn-primary profile-button" name="guardar" value="Guardar" type="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
    </div>
</section>