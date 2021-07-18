<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $model app\models\Deudores */

$this->title = 'Crear Deudor';
$this->params['breadcrumbs'][] = ['label' => 'Deudores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- SI LA PETICION ES AJAX MUESTRO EL FORMULARIO EN UN MODAL -->
<?php if ($isAjax) : ?>
    <?php
    Modal::begin([
        'header' => 'Deudor',
        'id' => 'modal-deudor',
        'size' => Modal::SIZE_LARGE,
        'clientOptions' => [
            'show' => true,
        ],
    ]);
    ?>
    <div class="deudores-create">

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
    <div class="deudores-create">

        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>

    </div>
<?php endif; ?>