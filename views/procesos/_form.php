<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\web\JsExpression;

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

<!-- MODULO DE CLIENTE -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">CLIENTE</h3>
    </div>
    <div class="box-body">
        <?=
                $form->field($model, 'cliente_id')
                ->widget(Select2::classname(),
                        [
                            'language' => 'es',
                            'options' => ['placeholder' => '- Seleccione un cliente -'],
                            'pluginOptions' => [
                                'allowClear' => false,
                                'minimumInputLength' => 3,
                                'ajax' => [
                                    'url' => \yii\helpers\Url::to(['clientes/getclientes']),
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(term,page) { return {search:term.term}; }'),
                                    'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                                ],
                                'initSelection' => new JsExpression('function (element, callback) {
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
                                )
                            ]
                        ]
        );
        ?>
        <div class="form-group col-md-6">
            <label class="control-label">&nbsp;</label>
            <?=
            Html::a("Crear nuevo cliente",
                    'javascript:void(0)',
                    [
                        'title' => 'clientes',
                        'class' => 'btn btn-primary form-control',
                        'onclick' => "                                    
                                    $.ajax({
                                        type    :'POST',
                                        cache   : false,
                                        url     : '" . Url::to(['clientes/create']) . "',
                                        success : function(response) {
                                            $('#ajax_result-clientes').html(response);
                                        }
                                    });
                                    return false;",
                    ]
            );
            ?>
            <?= Html::tag('div', '', ['id' => 'ajax_result-clientes']); ?>
        </div>

    </div>
</div>

<!-- MODULO DE DEUDOR -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">DEUDOR</h3>
    </div>
    <div class="box-body">
        <?=
                $form->field($model, 'deudor_id')
                ->widget(Select2::classname(),
                        [
                            'language' => 'es',
                            'options' => ['placeholder' => '- Seleccione un deudor -'],
                            'pluginOptions' => [
                                'allowClear' => false,
                                'minimumInputLength' => 3,
                                'ajax' => [
                                    'url' => \yii\helpers\Url::to(['deudores/getdeudores']),
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(term,page) { return {search:term.term}; }'),
                                    'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                                ],
                                'initSelection' => new JsExpression('function (element, callback) {
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
                                )
                            ]
                        ]
        );
        ?>
        <div class="form-group col-md-6">
            <label class="control-label">&nbsp;</label>
            <?=
            Html::a("Crear nuevo deudor",
                    'javascript:void(0)',
                    [
                        'title' => 'Deudor',
                        'class' => 'btn btn-primary form-control',
                        'onclick' => "                                    
                                    $.ajax({
                                        type    :'POST',
                                        cache   : false,
                                        url     : '" . Url::to(['deudores/create']) . "',
                                        success : function(response) {
                                            $('#ajax_result-deudores').html(response);
                                        }
                                    });
                                    return false;",
                    ]
            );
            ?>
            <?= Html::tag('div', '', ['id' => 'ajax_result-clientes']); ?>
            <?= Html::tag('div', '', ['id' => 'ajax_result-deudores']); ?>
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

<!-- BOTON GUARDAR FORMULARIOS -->
<div class="box box-primary">    
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
</div>

<!-- FIN FORMULARIO -->
<?php ActiveForm::end(); ?>