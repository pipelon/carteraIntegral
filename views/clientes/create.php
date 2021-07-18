<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */

$this->title = 'Crear Cliente';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- SI LA PETICION ES AJAX MUESTRO EL FORMULARIO EN UN MODAL -->
<?php if ($isAjax) : ?>
    <?php
    Modal::begin([
        'header' => 'Cliente',
        'id' => 'modal-clientes',
        'size' => Modal::SIZE_LARGE,
        'clientOptions' => [
            'show' => true,
        ],
    ]);
    ?>

    <div class="clientes-create">

        <?=
        $this->render('_form', [
            'model' => $model,
            'isAjax' => $isAjax
        ])
        ?>

    </div>

    <?php Modal::end(); ?>

    <!-- SI LA PETICION ES TRADIDIONAL MUESTRO EL FORMULARIO NORMALMENTE -->
<?php else: ?>
    <div class="clientes-create">
        <?=
        $this->render('_form', [
            'model' => $model,
            'isAjax' => $isAjax
        ])
        ?>
    </div>
<?php endif; ?>
