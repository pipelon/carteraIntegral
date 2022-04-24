<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TiposAlertasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipos-alertas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tipo_alerta_id') ?>

    <?= $form->field($model, 'dias_para_alerta') ?>

    <?= $form->field($model, 'asunto') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'activa') ?>

    <?php // echo $form->field($model, 'depende_de_etapa_1') ?>

    <?php // echo $form->field($model, 'depende_de_etapa_2') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'modified_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
