<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReportTemp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-temp-form box box-primary">
    <div class="box-header with-border">
    <?php  if (\Yii::$app->user->can('/report-temp/index') || \Yii::$app->user->can('/*')) :  ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> '.'Volver', ['index'], ['class' => 'btn btn-default']) ?>
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

        <?= $form->field($model, 'col1')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col2')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col3')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col4')->textInput(['maxlength' => true]) ?>
            
        <?= $form->field($model, 'col5')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col6')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col7')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col8')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col9')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col10')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col11')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col12')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col13')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col14')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col15')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col16')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'col17')->textInput(['maxlength' => true]) ?>

    </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
