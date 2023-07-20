<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Liquidaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="liquidaciones-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/liquidaciones/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 15px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
    </div>
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
    <div class="box-body table-responsive">

        <div class="form-row">

            <div class="row-field">
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
                            "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['clientes']) . "{label}\n{input}\n{hint}\n{error}",
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
                            "template" => Yii::$app->utils->mostrarPopover(\Yii::$app->params['ayudas']['deudores']) . "{label}\n{input}\n{hint}\n{error}",
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

            <div class="row-field">
                <?=
                $form->field($model, 'estado_cuenta')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'application/vnd.ms-excel, text/csv'],
                    'pluginOptions' => [
                        'allowedFileExtensions' => ['xls', 'csv'],
                        'removeClass' => 'btn btn-danger',
                        'browseIcon' => '<i class="flaticon-folder"></i> ',
                        'showPreview' => false,
                        'removeIcon' => '<i class="flaticon-circle"></i> ',
                        'maxFileSize' => 153600
                    ]
                ]);

                if (!$model->isNewRecord && !empty($model->estado_cuenta) && file_exists("liquidaciones/{$model->estado_cuenta}")) {
                    echo Html::a($model->estado_cuenta, "@web/liquidaciones/{$model->estado_cuenta}", ["target" => "_blank"]);
                }
                ?>
            </div>            
        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
