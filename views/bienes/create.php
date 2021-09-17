<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bienes */

$this->title = 'Crear bien';
$this->params['breadcrumbs'][] = ['label' => 'Bienes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bienes-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
