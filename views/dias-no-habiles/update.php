<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DiasNoHabiles */

$this->title = 'Actualizar días no hábiles: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Días no hábiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dias-no-habiles-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
