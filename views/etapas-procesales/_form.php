<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EtapasProcesales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="etapas-procesales-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/etapas-procesales/index') || \Yii::$app->user->can('/*')) : ?>        
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
                $tipoProcesosList = yii\helpers\ArrayHelper::map(
                                \app\models\TipoProcesos::find()
                                        ->where(['activo' => 1])
                                        ->all()
                                , 'id', 'nombre');
                ?>
                <?= $form->field($model, 'tipo_proceso_id')->dropDownList($tipoProcesosList); ?>
            </div>
            <div class="row-field">
                <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'activo')->dropDownList(Yii::$app->utils->getFilterConditional()); ?>
            </div>


        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
