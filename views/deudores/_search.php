<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DeudoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deudores-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'marca') ?>

    <?= $form->field($model, 'direccion') ?>

    <?= $form->field($model, 'nombre_persona_contacto_1') ?>

    <?php // echo $form->field($model, 'telefono_persona_contacto_1') ?>

    <?php // echo $form->field($model, 'email_persona_contacto_1') ?>

    <?php // echo $form->field($model, 'cargo_persona_contacto_1') ?>

    <?php // echo $form->field($model, 'nombre_persona_contacto_2') ?>

    <?php // echo $form->field($model, 'telefono_persona_contacto_2') ?>

    <?php // echo $form->field($model, 'email_persona_contacto_2') ?>

    <?php // echo $form->field($model, 'cargo_persona_contacto_2') ?>

    <?php // echo $form->field($model, 'nombre_persona_contacto_3') ?>

    <?php // echo $form->field($model, 'telefono_persona_contacto_3') ?>

    <?php // echo $form->field($model, 'email_persona_contacto_3') ?>

    <?php // echo $form->field($model, 'cargo_persona_contacto_3') ?>

    <?php // echo $form->field($model, 'nombre_codeudor_1') ?>

    <?php // echo $form->field($model, 'documento_codeudor_1') ?>

    <?php // echo $form->field($model, 'direccion_codeudor_1') ?>

    <?php // echo $form->field($model, 'email_codeudor_1') ?>

    <?php // echo $form->field($model, 'telefono_codeudor_1') ?>

    <?php // echo $form->field($model, 'nombre_codeudor_2') ?>

    <?php // echo $form->field($model, 'documento_codeudor_2') ?>

    <?php // echo $form->field($model, 'direccion_codeudor_2') ?>

    <?php // echo $form->field($model, 'email_codeudor_2') ?>

    <?php // echo $form->field($model, 'telefonol_codeudor_2') ?>

    <?php // echo $form->field($model, 'comentarios') ?>

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
