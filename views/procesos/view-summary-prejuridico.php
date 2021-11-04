<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span></button>
    <h4 class="modal-title">Resumen prejurídico</h4>
</div>
<div class="modal-body">

    <div class="row invoice-info">
        
        <!-- CLIENTE -->
        <div class="col-md-4 invoice-col">
            <h4><?= $model->cliente->nombre; ?></h4>
            <p class="text-muted">
                <b><?= Yii::$app->utils->filtroTipoDocumento($model->cliente->tipo_documento); ?>: </b>
                <?= $model->cliente->documento; ?>
                <br />
                <i class="fa fa-map-marker" style="color: #000;"></i> <?= $model->cliente->direccion; ?>
            </p>
            <br />
            Representante legal
            <p class="text-muted">
                <i class="fa fa-user" style="color: #000;"></i> <?= $model->cliente->nombre_representante_legal; ?>
                <br />
                <i class="fa fa-phone" style="color: #000;"></i> <?= $model->cliente->telefono_representante_legal; ?>
                <br />
                <i class="fa fa-envelope" style="color: #000;"></i> <?= $model->cliente->email_representante_legal; ?>
            </p>
            <br />
            Persona de contacto
            <p class="text-muted">
                <i class="fa fa-user" style="color: #000;"></i> <?= $model->cliente->nombre_persona_contacto_1; ?>
                <br />
                <i class="fa fa-phone" style="color: #000;"></i> <?= $model->cliente->telefono_persona_contacto_1; ?>
                <br />
                <i class="fa fa-envelope" style="color: #000;"></i> <?= $model->cliente->email_persona_contacto_1; ?>
                <br />
                <i class="fa fa-child" style="color: #000;"></i> <?= $model->cliente->cargo_persona_contacto_1; ?>
            </p>            
        </div>
        <!-- DEUDOR -->
        <div class="col-md-4 invoice-col">
            <h4><?= $model->deudor->nombre; ?></h4>
            <p class="text-muted">
                <b><?= Yii::$app->utils->filtroTipoDocumento($model->deudor->tipo_documento); ?>: </b>
                <?= $model->deudor->documento; ?>
                <br />
                <i class="fa fa-bookmark" style="color: #000;"></i> <?= $model->deudor->marca; ?>
                <br />
                <i class="fa fa-map-marker" style="color: #000;"></i> <?= $model->deudor->direccion; ?>
            </p>
            <br />
            Representante Legal
            <p class="text-muted">
                <i class="fa fa-user" style="color: #000;"></i> <?= $model->deudor->nombre_representante_legal; ?>
                <br />
                <i class="fa fa-phone" style="color: #000;"></i> <?= $model->deudor->telefono_representante_legal; ?>
                <br />
                <i class="fa fa-envelope" style="color: #000;"></i> <?= $model->deudor->email_representante_legal; ?>
            </p>
            <br />
            Persona de contacto
            <p class="text-muted">
                <i class="fa fa-user" style="color: #000;"></i> <?= $model->deudor->nombre_persona_contacto_1; ?>
                <br />
                <i class="fa fa-phone" style="color: #000;"></i> <?= $model->deudor->telefono_persona_contacto_1; ?>
                <br />
                <i class="fa fa-envelope" style="color: #000;"></i> <?= $model->deudor->email_persona_contacto_1; ?>
                <br />
                <i class="fa fa-child" style="color: #000;"></i> <?= $model->deudor->cargo_persona_contacto_1; ?>
            </p>

        </div>
        <!-- RESUMEN DEUDA -->
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-dollar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Saldo actual</span>
                    <span class="info-box-number"><?= number_format($model->prejur_saldo_actual, 2, ',', '.'); ?></span>
                </div>
            </div>
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Valor activación</span>
                    <span class="info-box-number"><?= number_format($model->prejur_valor_activacion, 2, ',', '.'); ?></span>
                </div>
            </div>
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-calendar-check-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Fecha de recepción</span>
                    <span class="info-box-number"><?= $model->prejur_fecha_recepcion; ?></span>
                </div>
            </div>
        </div>
    </div>

    <hr />
    
    <!-- GESTIÓN PREJURIDICA -->
    <?php if (!empty($model->prejur_gestiones_prejuridicas)): ?>
        <div class="gestion-prejuridica popupProceso">
            <h4>Gestión prejurídica</h4><br />
            <div class="row">

                <?php foreach ($model->prejur_gestiones_prejuridicas as $gestion) : ?>
                    <div class="col-md-12">
                        <blockquote>
                            <?= nl2br($gestion->descripcion_gestion); ?>
                            <small><?= $gestion->usuario_gestion; ?> el <cite title="Source Title"><?= $gestion->fecha_gestion; ?></cite></small>
                        </blockquote>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-outline">Save changes</button>
</div>