<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JurisdiccionesCompetentes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jurisdicciones-competentes-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/jurisdicciones-competentes/index') || \Yii::$app->user->can('/*')) : ?>        
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

            <?php
            $ciudades = yii\helpers\ArrayHelper::map(
                            \app\models\Ciudades::find()
                                    ->orderBy('nombre ASC')
                                    ->all()
                            , 'id', 'nombre');
            ?>
            <?= $form->field($model, 'ciudad_id')->dropDownList($ciudades); ?>

            <?= $form->field($model, 'entidad')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'codigo_entidad')->textInput() ?>

            <?= $form->field($model, 'especialidad')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'codigo_especialidad')->textInput() ?>

            <?php 
            for ($i=0; $i <= 999; $i++){
                $valor = str_pad($i, 3, "0", STR_PAD_LEFT);
                $numeros[$valor] = $valor;
            }
            ?>

            <?= $form->field($model, 'despacho')->dropDownList($numeros) ?>

            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>           

        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
