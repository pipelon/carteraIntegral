<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TiposAlertas */

$this->title = 'Actualizar Tipos Alertas: ' . $model->tipo_alerta_id;
$this->params['breadcrumbs'][] = ['label' => 'Tipos Alertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tipo_alerta_id, 'url' => ['view', 'id' => $model->tipo_alerta_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tipos-alertas-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
