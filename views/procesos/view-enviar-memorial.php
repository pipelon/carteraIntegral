<?php
yii\bootstrap\Modal::begin([
    'header' => '<h4>Enviar memorial</h4>',
    'id' => 'modal-enviar-memorial',
    'size' => yii\bootstrap\Modal::SIZE_LARGE,
    'clientOptions' => [
        'show' => true,
    ],
]);

$colaboradores = array_column($model->procesosXColaboradores, 'user_id');
//Lider
$lider = $model->jefe_id;
//ID usuario logueado
$userId = (int) \Yii::$app->user->id;
?>
<?php
//SI EL USUARIO PUEDE EDITAR
if ((in_array($userId, $colaboradores) ||
    $userId == $lider ||
    Yii::$app->user->identity->isSuperAdmin()) && \Yii::$app->user->can('/procesos/update')) :
?>
<?php
    $form = yii\bootstrap\ActiveForm::begin(
        [
            "id" => "form_enviar_email", 
            "action" => ["procesos/cargar-enviar-notificacion", "id" => $model->id],
            "options"=>['enctype' => 'multipart/form-data'],
            "fieldConfig" => [
                'template' => "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-6'],
                'horizontalCssClasses' => [
                    'label' => '',
                    'offset' => '',
                    'wrapper' => '',
                    'error' => '',
                    'hint' => '',
                ],
            ],
        ]
    );
    ?>

<div>
    
    <div class="pull-left">
        <div class="form-group col-md-12">
            De:
            <p class="text-muted">
                <i class="fa fa-user" style="color: #000;"></i> <?=\Yii::$app->params['notificacionesJudicialesEmail']?>
            </p>
            <?=
                \yii\helpers\Html::a('<span class="flaticon-edit" ></span>', 'javascript:void(0)', [
                    'title' => 'Modificar Remitente',
                    'class' => 'btn btn-default pull-left edit-remitente'
                 ]);
            ?>
        </div>
        <div id = 'emailDe' class="form-group col-md-12">
            <?php
             
            echo "<p class='text-muted'>Solo puede ser un remitente</p>" . 
            yii\helpers\Html::textInput('emailDe', \Yii::$app->params['notificacionesJudicialesEmail'] , ['class' => 'form-group form-control col-md-12']);
            ?>
        </div>
        <div class="form-group col-md-12">
            Para:
            <p class="text-muted">
                <i class="fa fa-user" style="color: #000;"></i> <?= isset($model->jur_juzgado) ? $model->jur_juzgado : '-';  ?>
                <?php 
                $emailPara = isset($model->jurJurisdiccionCompetent->email) ? $model->jurJurisdiccionCompetent->email : '';  
                ?>
                <?= !empty($emailPara) ? '('.$emailPara.')' : '-';  ?>
            </p>
            <?=
                \yii\helpers\Html::a('<span class="flaticon-edit" ></span>', 'javascript:void(0)', [
                    'title' => 'Modificar destinatario',
                    'class' => 'btn btn-default pull-left edit-destinatario'
                 ]);
            ?>
        </div>
        <div id = 'emailPara' class="form-group col-md-12">
            <?php
            
            echo "<p class='text-muted'>Tenga en cuenta que se incluirán en destinatarios todos los emails en este cuadro</p>" . 
                yii\helpers\Html::textarea('emailPara', $emailPara, 
                ['class' => 'form-group form-control col-md-12', 'rows' => '3']
            );
            ?>
        </div>
        <div class="form-group col-md-12">
            CC:
            <p class="text-muted">
                <?php
                $arrCCCopia = [];

                foreach ($model->demandadosXProceso as $value) {
                    echo "<i class='fa fa-user' style='color: #000;'></i> {$value->nombre} ({$value->email}) <br />";
                    $arrCCCopia[] = $value->email;
                }
                ?>
                <i class="fa fa-user" style="color: #000;"></i> <?=\Yii::$app->params['notificacionesJudicialesEmail']?>
            </p>
            <?=
                \yii\helpers\Html::a('<span class="flaticon-edit" ></span>', 'javascript:void(0)', [
                    'title' => 'Modificar CC',
                    'class' => 'btn btn-default pull-left edit-copia'
                 ]);
            ?>
        </div>
        <div id = 'emailCC' class="form-group col-md-12">
            <?php
            

            // if (isset($model->deudor->email_representante_legal)) $arrCCCopia[] = $model->deudor->email_representante_legal;
            // if (isset($model->deudor->email_codeudor_1)) $arrCCCopia[] = $model->deudor->email_codeudor_1;
            // if (isset($model->deudor->email_codeudor_2)) $arrCCCopia[] = $model->deudor->email_codeudor_2;

            $arrCCCopia[] = \Yii::$app->params['notificacionesJudicialesEmail'];

            $cc_copia = implode(';',$arrCCCopia);
            
            echo "<p class='text-muted'>Tenga en cuenta que se incluirán en copia todos los emails en este cuadro</p>" . 
                yii\helpers\Html::textarea('emailCC', $cc_copia, 
                ['class' => 'form-group form-control col-md-12', 'rows' => '3']
            );
            ?>
        </div>
        <div class="form-group col-md-12">
            Asunto:
            <p class="text-muted">
                <?php 
                $asunto = "Proceso {$model->deudor->nombre} - {$model->deudor->marca} radicado {$model->jur_radicado}";
                    echo $asunto; 
                    echo "<br />";
                    echo \yii\helpers\Html::a('<span class="flaticon-edit" ></span>', 'javascript:void(0)', [
                        'title' => 'Modificar Asunto',
                        'class' => 'btn btn-default pull-left edit-asunto'
                    ]);
                ?>
                <div id="asunto">
                    <?= yii\helpers\Html::textInput('asunto', $asunto , ['class' => 'form-group form-control col-md-12'])?>
                </div>
            </p>
        </div>
        <div class="form-group col-md-12">
            Adjuntos:
            <?php
            
                $out = \app\components\NotificacionesWidget::widget([
                    "tipo" => 'form-correo',
                    "codcarta" => $codcarta,
                    "id" => $model->id,
                    "juzgado" => $model->jur_juzgado,
                    "demandante" => $model->cliente->nombre,
                    "demandado" => $model->deudor->nombre." - ".$model->deudor->marca,
                    "radicado" => $model->jur_radicado
                ]);
            ?>
            <p class="text-muted">
                <i class="fa fa-file" style="color: #000;"></i> 
                <?php 
                    
                    //muestro el link al archivo pdf generado
                    $urlPdf = yii\helpers\Url::home(true).'/pdfs/'.$out;
                    echo yii\helpers\Html::a($out, $urlPdf, ['target' => '_blank']);
                    //pinto el hidden para el nombre del archivo generado
                    echo yii\helpers\Html::hiddenInput('cartaPdf', $out ,
                    ['class' => 'form-group form-control col-md-12']
                ); 
                ?>
            </p>
            <?php
                echo kartik\file\FileInput::widget([
                    'name' => 'file[]',
                    'options' => ['multiple' => true],
                    'pluginOptions' => [
                        'showPreview' => false,
                        "showUpload" => false,
                        'uploadUrl' => yii\helpers\Url::to(['/procesos/cargar-enviar-notificacion']),
                        'uploadExtraData' => [
                            'id' => $model->id
                        ],
                        'maxFileCount' => 10
                        ]
                ]);
                ?>
                <?php
                    //muestro la ruta al drive del proceso
                    if (!$model->isNewRecord && !empty($model->carpeta)) {
                        $urlDrive = 'https://drive.google.com/open?id=' . $model->carpeta;
                        echo yii\helpers\Html::a("Carpeta drive del proceso", $urlDrive, ['target' => '_blank','title'=> 'Puedes ir a la carpeta drive del proceso para obtener el link de los documentos y pegarlo en el texto del email. Debes asegurarte de dar los permisos adecuados al documento en drive.']);
                        echo "<br />";
                    }
                ?>
        </div>
        <div class="form-group col-md-12">
            <?php
            echo "<b>Texto del email:</b> </br>" . 
                yii\helpers\Html::textarea('emailBody', 'Se envía documentación del proceso jurídico establecido por '.$model->cliente->nombre .' en contra de '.$model->deudor->nombre." - ".$model->deudor->marca."", 
                ['class' => 'form-group form-control col-md-12', 'rows' => '3']
            );
            ?>
        </div>
    </div>
</div>
    <?=
    $form->field($model, 'jur_gestion_juridica', [
        'options' => ['class' => 'form-group col-md-12'],
    ])->textarea(['rows' => 3,'value'=> "Se envía documentación al juzgado ".$model->jur_juzgado])
    ?>
    <?=
    yii\helpers\Html::a(
        '<i class="flaticon-paper-plane" style="font-size: 15px"></i> ' . 'Enviar email',
        'javascript:void(0)',
        [
            'class' => 'btn btn-primary btn-xs enviar-email',
            'style' => 'margin-left: 15px;'
        ]
    )
    ?>
    <?php yii\bootstrap\ActiveForm::end(); ?>
    <br /><br />
     <!--mostrar resultado del envio de correo-->
     <div id="resultado-envio-correo"></div>
<?php endif; ?>

<script type="text/javascript">
    $('#emailCC').hide();
    $('#emailDe').hide();
    $('#emailPara').hide();
    $('#asunto').hide();
    
    //editar copiados en correo
    $(".edit-copia").click(function() {
        $('#emailCC').toggle();;
    });

    //editar asunto del correo
    $(".edit-asunto").click(function() {
        $('#asunto').toggle();;
    });

    //editar remitente del correo
    $(".edit-remitente").click(function() {
        $('#emailDe').toggle();;
    });

    //editar destinatario del correo
    $(".edit-destinatario").click(function() {
        $('#emailPara').toggle();;
    });

    $(".enviar-email").click(function() {
        /* 
         * CUANDO SE GUARDA MUCHAS VECES SE ESTABAN ABRIENDO MULTIPLES POPUP
         * ESTO EVITA ESE COMPORTAMIENTO EXRAÑO
         */
        $('.modal-backdrop').remove();

        /*
         * GUARDO LA GESTION Y RECARGO EL DIV CON LA NUEVA INFO         * 
         */
        var form = $('#form_enviar_email');
        var parametros = new FormData($('#form_enviar_email')[0]);

        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            data: parametros,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.indexOf('ERROR:') >= 0){
                    alerta ='<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+response+'</div>';
                }else{
                    alerta ='<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+response+'</div>';
                }
                $('#resultado-envio-correo').html(alerta);
            }
        });
    });
</script>

<?php yii\bootstrap\Modal::end(); ?>