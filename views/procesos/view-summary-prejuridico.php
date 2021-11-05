<?php
yii\bootstrap\Modal::begin([
    'header' => 'Resumen prejurídico',
    'id' => 'modal-prejuridico',
    'size' => yii\bootstrap\Modal::SIZE_LARGE,
    'clientOptions' => [
        'show' => true,
    ],
]);
?>

<div class="row invoice-info">        

    <!-- INFORMACION DEL DEUDOR -->
    <div class="col-md-8 invoice-col">
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
<?php
$form = yii\bootstrap\ActiveForm::begin(
                [
                    'id' => "form_prejur",
                    'fieldConfig' => [
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
<?=
$form->field($model, 'prejur_gestion_prejuridica', [
    'options' => ['class' => 'form-group col-md-12'],
])->textarea(['rows' => 6])
?>
<?=
yii\helpers\Html::a('<i class="flaticon-paper-plane" style="font-size: 15px"></i> ' . 'Guardar', 'javascript:void(0)',
        [
            'class' => 'btn btn-primary create',
            'style' => 'margin-left: 15px;'
        ]
)
?>
<?php yii\bootstrap\ActiveForm::end(); ?>
<br /><br />
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

<script type="text/javascript">

    $(".create").click(function () {
        /* 
         * CUANDO SE GUARDA MUCHAS VECES SE ESTABAN ABRIENDO MULTIPLES POPUP
         * ESTO EVITA ESE COMPORTAMIENTO EXRAÑO
         */
        $('.modal-backdrop').remove();

        /*
         * GUARDO LA GESTION Y RECARGO EL DIV CON LA NUEVA INFO         * 
         */
        var form = $('#form_prejur');
        var formData = form.serialize();
        $.ajax({
            url: form.attr("action"),
            type: form.attr("method"),
            data: formData,
            success: function (response) {
                $('#ajax_result-prejuridico').html(response);
            }
        });
    });

</script>

<?php yii\bootstrap\Modal::end(); ?>