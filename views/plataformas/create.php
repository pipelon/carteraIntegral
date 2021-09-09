<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Plataformas */

$this->title = 'Crear plataforma';
$this->params['breadcrumbs'][] = ['label' => 'Plataformas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plataformas-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
