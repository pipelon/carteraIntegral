<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DiasNoHabiles */

$this->title = 'Actualizar día no hábil: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Días no hábiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="dias-no-habiles-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
