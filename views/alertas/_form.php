<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Alertas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="alertas-form box box-primary">
    <div class="box-header with-border">
    <?php  if (\Yii::$app->user->can('/alertas/index') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 15px"></i> '.'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php  endif;  ?> 
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

        <?= $form->field($model, 'proceso_id')->textInput() ?>

        <?= $form->field($model, 'usuario_id')->textInput() ?>

        <?= $form->field($model, 'descripcion_alerta')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pospuesta')->dropDownList(Yii::$app->utils->getFilterConditional()); ?>

        <?= $form->field($model, 'fecha_pospuesta')->textInput() ?>

        <?= $form->field($model, 'dias_pospuesta')->textInput() ?>

    </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
