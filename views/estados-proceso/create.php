<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EstadosProceso */

$this->title = 'Crear estado del proceso';
$this->params['breadcrumbs'][] = ['label' => 'Estados de proceso', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estados-proceso-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
