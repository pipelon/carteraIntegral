<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Personas */

$this->title = 'Crear persona';
$this->params['breadcrumbs'][] = ['label' => 'Personas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personas-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
