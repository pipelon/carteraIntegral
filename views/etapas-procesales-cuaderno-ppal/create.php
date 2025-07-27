<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EtapasProcesalesCuadernoPpal */

$this->title = 'Crear Etapas Procesales Cuaderno Ppal';
$this->params['breadcrumbs'][] = ['label' => 'Etapas Procesales Cuaderno Ppals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="etapas-procesales-cuaderno-ppal-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
