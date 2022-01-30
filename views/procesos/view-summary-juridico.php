<?php
yii\bootstrap\Modal::begin([
    'header' => 'Resumen jurídico',
    'id' => 'modal-juridico',
    'size' => yii\bootstrap\Modal::SIZE_LARGE,
    'clientOptions' => [
        'show' => true,
    ],
]);
?>

<div class="row invoice-info">        

    <!-- INFORMACION DEL DEUDOR -->
    <div class="col-md-8 invoice-col">
        <h4><?= "Radicado: {$model->jur_radicado}"; ?></h4>

        <br />
        Demandante
        <p class="text-muted">
            <i class="fa fa-user" style="color: #000;"></i> <?= $model->cliente->nombre; ?>
        </p>
        <br />
        Demandados
        <p class="text-muted">
            <?php
            $demandados = [];
            foreach ($model->demandadosXProceso as $value) {
                echo "<i class='fa fa-user' style='color: #000;'></i> {$value->nombre} <br />";
            }
            ?>
        </p>
        <br />
        <p class="text-muted">
            <b>Tipo de proceso: </b>
            <?= isset($model->jurTipoProceso->nombre) ? $model->jurTipoProceso->nombre : '-'; ?>
            <br />
            <b>Etapa procesal: </b>
            <?= isset($model->jurEtapasProcesal->nombre) ? $model->jurEtapasProcesal->nombre : '-'; ?>
            <br />
            <b>Juzgado: </b>
            <?= isset($model->jur_juzgado) ? $model->jur_juzgado : '-'; ?>
        </p>

    </div>
    <!-- RESUMEN DEUDA -->
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-dollar"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Saldo actual</span>
                <span class="info-box-number"><?= number_format($model->jur_saldo_actual, 2, ',', '.'); ?></span>
            </div>
        </div>
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Valor activación</span>
                <span class="info-box-number"><?= number_format($model->jur_valor_activacion, 2, ',', '.'); ?></span>
            </div>
        </div>
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-calendar-check-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Fecha de recepción</span>
                <span class="info-box-number"><?= $model->jur_fecha_recepcion; ?></span>
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
$form->field($model, 'jur_gestion_juridica', [
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
<?php if (!empty($model->jur_gestiones_juridicas)): ?>
    <div class="gestion-prejuridica popupProceso">
        <h4>Gestión jurídica</h4><br />
        <div class="row">

            <?php foreach ($model->jur_gestiones_juridicas as $gestion) : ?>
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
                $('#ajax_result-juridico').html(response);
            }
        });
    });

</script>

<?php yii\bootstrap\Modal::end(); ?>