<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Alertas */

$this->title = 'Crear Alertas';
$this->params['breadcrumbs'][] = ['label' => 'Alertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alertas-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
