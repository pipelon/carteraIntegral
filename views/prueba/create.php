<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Prueba */

$this->title = 'Crear Prueba';
$this->params['breadcrumbs'][] = ['label' => 'Pruebas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prueba-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
