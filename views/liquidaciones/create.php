<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Liquidaciones */

$this->title = 'Crear Liquidación';
$this->params['breadcrumbs'][] = ['label' => 'Liquidaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="liquidaciones-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
