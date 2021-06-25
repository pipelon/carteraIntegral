<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Personas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/personas/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
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

                <?= $form->field($model, 'nit')->textInput() ?>

                <?= $form->field($model, 'digverifica')->textInput() ?>
            </div>
            <div class="row-field">

                <?= $form->field($model, 'tipodeudor')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="row-field">

                <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="row-field">

                <?= $form->field($model, 'razonsocial')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="row-field">
                <?= $form->field($model, 'telefonofijo')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'celular')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="row-field">

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'ciudad')->textInput(['maxlength' => true]) ?>

            </div>
            <div class="row-field">

                <?= $form->field($model, 'marcas')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'representantelegal')->textInput() ?>
            </div>

        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
