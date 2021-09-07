<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DiasNoHabiles */

$this->title = 'Crear días no hábiles';
$this->params['breadcrumbs'][] = ['label' => 'Días no hábiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dias-no-habiles-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
