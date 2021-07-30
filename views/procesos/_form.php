<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;

/* @var $this yii\web\View */
/* @var $model app\models\Procesos */
/* @var $form yii\widgets\ActiveForm */


// ARCHIVO CON TODOS LOS JS NECESARIOS PARA EL PROCESO
$this->registerJsFile(Yii::getAlias('@web') . '/js/proceso.js', ['depends' => [yii\web\JqueryAsset::className()]]);
?>

<!-- BOTON VOLVER -->
<div class="procesos-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/procesos/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
    </div>
</div>

<!-- INICIO DEL FORMULARIO -->
<?php
$form = ActiveForm::begin(
                [
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

<!-- ROW PARA CLIENTES Y DEUDORES -->
<div class="row">

    <!-- MODULO DE CLIENTE -->
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">CLIENTE</h3>
            </div>
            <div class="box-body">
                <?php
                $initSelection = new JsExpression(
                        'function (element, callback) {
                        let id = $(element).val();                                
                        if (id !== "") {                                        
                            $.ajax("' . Url::to(['clientes/getclientes']) . '?id=" + id, {
                                dataType: "json",
                                type: "post",
                            }).done(function(data) {
                                callback(data.results); 
                            });
                        }
                    }'
                );
                ?>
                <?=
                        $form->field($model, 'cliente_id', [
                            'options' => ['class' => 'form-group col-md-12'],
                        ])
                        ->widget(Select2::classname(),
                                [
                                    'language' => 'es',
                                    'options' => ['placeholder' => '- Seleccione un cliente -'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'minimumInputLength' => 3,
                                        'ajax' => [
                                            'url' => \yii\helpers\Url::to(['clientes/getclientes']),
                                            'dataType' => 'json',
                                            'data' => new JsExpression('function(term,page) { return {search:term.term}; }'),
                                            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                                        ],
                                        'initSelection' => !$model->isNewRecord ? $initSelection : null
                                    ]
                                ]
                );
                ?>
            </div>
        </div>
    </div>

    <!-- MODULO DE DEUDOR -->
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">DEUDOR</h3>
            </div>
            <div class="box-body">
                <?php
                $initSelection = new JsExpression(
                        'function (element, callback) {
                        let id = $(element).val();                                
                        if (id !== "") {                                        
                            $.ajax("' . Url::to(['deudores/getdeudores']) . '?id=" + id, {
                                dataType: "json",
                                type: "post",
                            }).done(function(data) {
                                callback(data.results); 
                            });
                        }
                    }'
                );
                ?>
                <?=
                        $form->field($model, 'deudor_id', [
                            'options' => ['class' => 'form-group col-md-12'],
                        ])
                        ->widget(Select2::classname(),
                                [
                                    'language' => 'es',
                                    'options' => ['placeholder' => '- Seleccione un deudor -'],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        'minimumInputLength' => 3,
                                        'ajax' => [
                                            'url' => \yii\helpers\Url::to(['deudores/getdeudores']),
                                            'dataType' => 'json',
                                            'data' => new JsExpression('function(term,page) { return {search:term.term}; }'),
                                            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                                        ],
                                        'initSelection' => !$model->isNewRecord ? $initSelection : null
                                    ]
                                ]
                );
                ?>                
            </div>
        </div>
    </div>
</div>

<!-- COLABORADORES -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">COLABORADORES</h3>
    </div>
    <div class="box-body">
        <?php
        $dataList = yii\helpers\ArrayHelper::map(
                        \Yii::$app->user->identity->getUserNamesByRole("Colaboradores")
                        , 'id', 'name');
        ?>

        <?=
        $form->field($model, 'colaboradores')->widget(Select2::classname(), [
            'data' => $dataList,
            'options' => ['placeholder' => '- Seleccione los colaboradores -', 'multiple' => true],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>

    </div>
</div>

<!-- ESTUDIO PREJURIDICO -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">ESTUDIO PRE-JURÍDICO</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_fecha_recepcion')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => '- Ingrese una fecha --'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]);
            ?>
            <?php
            $tipoCasosList = yii\helpers\ArrayHelper::map(
                            \app\models\TipoCasos::find()
                                    ->where(['activo' => 1])
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?=
            $form->field($model, 'prejur_tipo_caso', [
                "template" => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}"
            ])->dropDownList($tipoCasosList, ['prompt' => '- Seleccione un tipo de caso -'])
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_consulta_rama_judicial', [
                'template' => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_consulta_entidad_reguladora', [
                'template' => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
        <!-- ESTUDIO DE BIENES -->
        <div class="row-field">
            <?php
            $bienesList = yii\helpers\ArrayHelper::map(
                            \app\models\Bienes::find()
                                    ->where(['activo' => 1])
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?=
            $form->field($model, 'prejur_estudio_bienes', [
                "template" => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}",
                "options" => ["class" => "form-group col-md-12"],
            ])->checkboxList($bienesList,
                    [
                        'item' => function($index, $label, $name, $checked, $value) use ($model) {
                            $checked = $checked ? "checked" : "";
                            return "<div class='row'>"
                                    . "<div class='col-md-4'>"
                                    . " <div class='checkbox'>"
                                    . "     <label>"
                                    . "         <input type='checkbox' {$checked} name='{$name}' value='{$value}' class='check-bien'> {$label}"
                                    . "     </label>"
                                    . " </div>"
                                    . "</div>"
                                    . "<div class='col-md-8'>"
                                    . Html::input("text", "Procesos[prejur_comentarios_estudio_bienes][{$value}]", $model->prejur_comentarios_estudio_bienes[$value] ?? null,
                                            [
                                                "class" => "form-control comentario-bienes-{$value}",
                                                "placeholder" => "Comentarios",
                                                "style" => "display: none"
                                            ]
                                    )
                                    . "</div>"
                                    . "</div>";
                        }
                    ]
            )
            ?>
        </div>
        <div class="row-field">
            <?=
            $form->field($model, 'prejur_concepto_viabilidad', [
                'template' => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
        <!-- GESTIONES PRE JURIDICAS -->
        <div class="row-field gestion-prejuridica">
            <?=
            $form->field($model, 'prejur_gestion_prejuridica', [
                'template' => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
            <?php if (!empty($model->prejur_gestiones_prejuridicas)): ?>
                <?php foreach ($model->prejur_gestiones_prejuridicas as $gestion) : ?>
                    <div class="col-md-12">
                        <blockquote>
                            <?= nl2br($gestion->descripcion_gestion); ?>
                            <small><?= $gestion->usuario_gestion; ?> el <cite title="Source Title"><?= $gestion->fecha_gestion; ?></cite></small>
                        </blockquote>
                    </div>
                <?php endforeach; ?>

            <?php endif; ?>
        </div>

        <div class="row-field">
            <?=
            $form->field($model, 'prejur_otros', [
                'template' => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}\n",
                'options' => ['class' => 'form-group col-md-12'],
            ])->textarea(['rows' => 6])
            ?>
        </div>
    </div>
</div>

<!-- JURIDICO -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">JURÍDICO</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
        <div class="row-field">
            <?=
            $form->field($model, 'jur_fecha_recepcion')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => '- Ingrese una fecha --'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]);
            ?>
            <?php
            $docActList = yii\helpers\ArrayHelper::map(
                            \app\models\DocumentosActivacion::find()
                                    ->where(['activo' => 1])
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?=
            $form->field($model, 'jur_documentos_activacion', [
                "template" => Yii::$app->utils->mostrarPopover("Lorem Ipsum dolot") . "{label}\n{input}\n{hint}\n{error}",
            ])->checkboxList($docActList)
            ?>
        </div>
        <div class="row-field">
            <?= $form->field($model, 'jur_valor_activacion')->textInput() ?>
            <?= $form->field($model, 'jur_saldo_actual')->textInput() ?>
        </div>
        <div class="row-field">
            <?php
            $tipoProcesosList = yii\helpers\ArrayHelper::map(
                            \app\models\TipoProcesos::find()
                                    ->where(['activo' => 1])
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?= $form->field($model, 'jur_tipo_proceso_id')->dropDownList($tipoProcesosList, ['id' => 'tipo-proceso-id']) ?>
            <?=
            $form->field($model, 'jur_etapas_procesal_id')->widget(DepDrop::classname(), [
                'options' => ['id' => 'etapa-procesal-id'],
                'data' => [$model->jur_etapas_procesal_id => 'default'], 
                'pluginOptions' => [
                    'depends' => ['tipo-proceso-id'],
                    'initialize' => true,
                    'placeholder' => '- Seleccione una etapa procesal -',
                    'url' => Url::to(['/etapas-procesales/etapasprocesalesporprocesoid']),
                    'loadingText' => 'Cargando ...',
                ]
            ]);
            ?>
        </div>
    </div>
</div>

<!-- BOTON GUARDAR FORMULARIOS -->
<div class="box box-primary">    
    <div class="box-footer">
<?= Html::submitButton('<i class="flaticon-paper-plane" style="font-size: 20px"></i> ' . 'Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<!-- FIN FORMULARIO -->
<?php ActiveForm::end(); ?>