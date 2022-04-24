<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TiposAlertas */

$this->title = 'Crear Tipos Alertas';
$this->params['breadcrumbs'][] = ['label' => 'Tipos Alertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-alertas-create">

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
