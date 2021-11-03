<div style="padding: 20px">
    <div class="row">
        
        <!-- INFORMACION CLIENTE -->
        <div class="col-md-12">            
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <h3 class="profile-username text-center"><?= $model->nombre; ?></h3>
                    <p class="text-muted text-center">
                        <b><?= Yii::$app->utils->filtroTipoDocumento($model->tipo_documento); ?>: </b>
                        <?= $model->documento; ?>
                    </p>
                    <p class="text-muted text-center">
                        <i class="fa fa-map-marker" style="color: #000;"></i> <?= $model->direccion; ?>
                    </p>
                </div>
            </div>            
        </div>
        
        <!-- REPRESENTANTE LEGAL -->
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Representante legal</h3>
                </div>
                <div class="box-body">

                    <p class="text-muted">
                        <i class="fa fa-user" style="color: #000;"></i> <?= $model->nombre_representante_legal; ?>
                        <br />
                        <i class="fa fa-phone" style="color: #000;"></i> <?= $model->telefono_representante_legal; ?>
                        <br />
                        <i class="fa fa-envelope" style="color: #000;"></i> <?= $model->email_representante_legal; ?>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- PERSONA DE CONTACTO #1 -->
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Persona de contacto #1</h3>
                </div>
                <div class="box-body">

                    <p class="text-muted">
                        <i class="fa fa-user" style="color: #000;"></i> <?= $model->nombre_persona_contacto_1; ?>
                        <br />
                        <i class="fa fa-phone" style="color: #000;"></i> <?= $model->telefono_persona_contacto_1; ?>
                        <br />
                        <i class="fa fa-envelope" style="color: #000;"></i> <?= $model->email_persona_contacto_1; ?>
                        <br />
                        <i class="fa fa-child" style="color: #000;"></i> <?= $model->cargo_persona_contacto_1; ?>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- PERSONA DE CONTACTO #2 -->
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Persona de contacto #2</h3>
                </div>
                <div class="box-body">

                    <p class="text-muted">
                        <i class="fa fa-user" style="color: #000;"></i> <?= $model->nombre_persona_contacto_2; ?>
                        <br />
                        <i class="fa fa-phone" style="color: #000;"></i> <?= $model->telefono_persona_contacto_2; ?>
                        <br />
                        <i class="fa fa-envelope" style="color: #000;"></i> <?= $model->email_persona_contacto_2; ?>
                        <br />
                        <i class="fa fa-child" style="color: #000;"></i> <?= $model->cargo_persona_contacto_2; ?>
                    </p>
                </div>
            </div>
        </div>
        
        <!-- PERSONA DE CONTACTO #3 -->
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Persona de contacto #3</h3>
                </div>
                <div class="box-body">

                    <p class="text-muted">
                        <i class="fa fa-user" style="color: #000;"></i> <?= $model->nombre_persona_contacto_3; ?>
                        <br />
                        <i class="fa fa-phone" style="color: #000;"></i> <?= $model->telefono_persona_contacto_3; ?>
                        <br />
                        <i class="fa fa-envelope" style="color: #000;"></i> <?= $model->email_persona_contacto_3; ?>
                        <br />
                        <i class="fa fa-child" style="color: #000;"></i> <?= $model->cargo_persona_contacto_3; ?>
                    </p>
                </div>
            </div>
        </div>
        
    </div>
</div>
