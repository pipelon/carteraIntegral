<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\DiasNoHabiles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dias-no-habiles-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/dias-no-habiles/index') || \Yii::$app->user->can('/*')) :  ?>
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif;  ?>
    </div>
    <?php $form = ActiveForm::begin(
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
    ); ?>
    <div class="box-body table-responsive">

        <div class="form-row">
            <?=
            $form->field($model, "fecha_no_habil")->widget(DatePicker::classname(), [
                'options' => ['placeholder' => '- Ingrese una fecha --'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'todayBtn' => true,
                ]
            ]);
            ?>

        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>