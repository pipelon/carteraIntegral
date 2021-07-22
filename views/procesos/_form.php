<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Procesos */
/* @var $form yii\widgets\ActiveForm */
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
    </div>
    <div class="box-body">
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
        <?= $form->field($model, 'prejur_tipo_caso')->dropDownList($tipoCasosList, ['prompt' => '- Seleccione un tipo de caso -']) ?>

    </div>
</div>

<!-- BOTON GUARDAR FORMULARIOS -->
<div class="box box-primary">    
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<!-- FIN FORMULARIO -->
<?php ActiveForm::end(); ?>