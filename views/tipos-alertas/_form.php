<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TiposAlertas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipos-alertas-form box box-primary">
    <div class="box-header with-border">
    <?php  if (\Yii::$app->user->can('/tipos-alertas/index') || \Yii::$app->user->can('/*')) :  ?>        
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

        <?= $form->field($model, 'dias_para_alerta')->textInput() ?>

        <?= $form->field($model, 'asunto')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'activa')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

        <?= $form->field($model, 'depende_de_etapa_1')->textInput() ?>

        <?= $form->field($model, 'depende_de_etapa_2')->textInput() ?>

    </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
