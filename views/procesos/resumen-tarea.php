<?php
yii\bootstrap\Modal::begin([
    'header' => 'Resumen tarea',
    'id' => 'modal-tarea',
    'size' => yii\bootstrap\Modal::SIZE_LARGE,
    'clientOptions' => [
        'show' => true,
    ],
]);
?>
<div class="row">
    <div class="col-md-12">
        <p class="text-muted">
            <i class="fa fa-user" style="color: #000;"></i> <?= $model->cliente->nombre; ?>
        </p>
        <p class="text-muted">
            <i class="fa fa-checklist" style="color: #000;"></i> <?= $title; ?>
        </p>
        <p class="text-muted">
            <i class="fa fa-checklist" style="color: #000;"></i> <?= $model->id; ?>
        </p>
        
    </div>
</div>

<?php yii\bootstrap\Modal::end(); ?>