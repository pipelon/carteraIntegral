<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DepartamentosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departamentos-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'created') ?>

    <?= $form->field($model, 'created_by') ?>

    <?= $form->field($model, 'modified') ?>

        <?php // echo $form->field($model, 'modified_by')  ?>

    <div class="form-group">
<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
