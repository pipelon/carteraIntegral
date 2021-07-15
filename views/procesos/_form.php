<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

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
        <?php
        $clientsList = yii\helpers\ArrayHelper::map(
                        \app\models\Clientes::find()
                                ->all()
                        , 'id', function($model) {
                    return '(' . $model['documento'] . ') - ' . $model['nombre'];
                });
        ?>

        <?=
        $form->field($model, 'cliente_id')->widget(Select2::classname(), [
            'data' => $clientsList,
            'options' => ['placeholder' => '- Seleccione un cliente -'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
    </div>
</div>

<!-- MODULO DE DEUDOR -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">DEUDOR</h3>
    </div>
    <div class="box-body">
        <?php
        $deudoresList = yii\helpers\ArrayHelper::map(
                        \app\models\Deudores::find()
                                ->all()
                        , 'id',  function($model) {
                    return '(' . $model['marca'] . ') - ' . $model['nombre'];
                });
        ?>

        <?=
        $form->field($model, 'deudor_id')->widget(Select2::classname(), [
            'data' => $deudoresList,
            'options' => ['placeholder' => '- Seleccione un deudor -'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
        ?>
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