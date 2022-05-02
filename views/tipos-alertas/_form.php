<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\TiposAlertas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipos-alertas-form box box-primary">
    <div class="box-header with-border">
        <?php if (\Yii::$app->user->can('/tipos-alertas/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 15px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
    </div>

    <?php
    $tipoProcesosList = yii\helpers\ArrayHelper::map(
                    \app\models\TipoProcesos::find()
                            ->where(['activo' => 1])
                            ->all()
                    , 'id', 'nombre');
    ?>

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

            <?= $form->field($model, 'dias_para_alerta')->textInput() ?>

            <?= $form->field($model, 'asunto')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="form-row">

            <?= $form->field($model, 'tipo_proceso_id_1')->dropDownList($tipoProcesosList, ['prompt' => '- Seleccion un tipo de proceso -', 'id' => 'tipo-proceso-id-1']) ?>
            <?=
            $form->field($model, 'depende_de_etapa_1')->widget(DepDrop::classname(), [
                'options' => ['id' => 'etapa-procesal-id-1'],
                'data' => [$model->depende_de_etapa_1 => 'default'],
                'pluginOptions' => [
                    'depends' => ['tipo-proceso-id-1'],
                    'initialize' => true,
                    'placeholder' => '- Seleccione una etapa procesal -',
                    'url' => Url::to(['/etapas-procesales/etapasprocesalesporprocesoid']),
                    'loadingText' => 'Cargando ...',
                ]
            ]);
            ?>

        </div>
        <div class="form-row">

            <?= $form->field($model, 'tipo_proceso_id_2')->dropDownList($tipoProcesosList, ['prompt' => '- Seleccion un tipo de proceso -', 'id' => 'tipo-proceso-id-2']) ?>
            <?=
            $form->field($model, 'depende_de_etapa_2')->widget(DepDrop::classname(), [
                'options' => ['id' => 'etapa-procesal-id-2'],
                'data' => [$model->depende_de_etapa_2 => 'default'],
                'pluginOptions' => [
                    'depends' => ['tipo-proceso-id-2'],
                    'initialize' => true,
                    'placeholder' => '- Seleccione una etapa procesal -',
                    'url' => Url::to(['/etapas-procesales/etapasprocesalesporprocesoid']),
                    'loadingText' => 'Cargando ...',
                ]
            ]);
            ?>

        </div>
        <div class="form-row">
            <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>
        </div>
        <div class="form-row">            

            <?= $form->field($model, 'activa')->dropDownList(Yii::$app->utils->getFilterConditional()); ?>
        </div>
    </div>
    <div class="box-footer">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
