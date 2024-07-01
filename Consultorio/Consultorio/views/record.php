<section class="account_section">
    <div class="edit-box">
        <div class="col">
            <div class="p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Expediente Dental</h4>
                </div>

                <?php if($exp['archivo'] == NULL ): ?>
                    <form action="cuenta.php" method="post" enctype="multipart/form-data">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="etiquetas">Carnet</label>
                                <input type="text" name="carnet" class="cajitas" value="<?= $exp['carnet']; ?>" disabled>
                            </div>
                            <div class="col-md-12">
                                <label class="etiquetas">Expediente</label>
                                <!-- <input type="file" name="expediente" class="cajitas" required> -->
                                <input type="text" name="carnet" class="cajitas" value="Tu expediente no ha sido cargado a la plataforma" disabled>
                            </div>
                        </div>
                    </form>
                <?php else: ?>
                    <form action="cuenta.php" method="post" enctype="multipart/form-data">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="etiquetas">Carnet</label>
                                <input type="text" name="carnet" class="cajitas" value="<?= $exp['carnet']; ?>" disabled>
                            </div>
                            <div class="col-md-12">
                                <label class="etiquetas">Expediente</label>
                            </div>
                            <div class="m-auto mt-2 text-center">
                                <?php
                                    $vista = "";
                                    if($exp['archivo'] != null) {
                                        $vista = "<iframe class='expediente' src='data:application/pdf;base64,".base64_encode($exp['archivo'])."' frameborder='0'></iframe>";
                                    }
                                    echo $vista;
                                ?>
                            </div>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>