<?php
yii\bootstrap\Modal::begin([
    'header' => 'Resumen radicado',
    'id' => 'modal-radicado',
    'size' => yii\bootstrap\Modal::SIZE_LARGE,
    'clientOptions' => [
        'show' => true,
    ],
]);
?>

<div class="row invoice-info">        

    <!-- INFORMACION DEL DEUDOR -->
    <div class="col-md-12 invoice-col">
        <h4>Radicado: <?= $radicado; ?></h4>
        <p class="text-muted">
            <b>Departamento: </b> <?= $depa; ?>            
            <br />
            <b>Ciudad: </b> <?= $ciu; ?>
            <br />
            <b>Juzgado: </b> <?= $juz; ?>
            <br />
            <b>Año: </b> <?= $ano; ?>
            <br />
            <b>Consecutivo: </b> <?= $con; ?>
            <br />
            <b>Instancia: </b> <?= $ins; ?>            
        </p>
        <br />
        Comentarios
        <p class="text-muted">
            <?= $comment; ?>
        </p>
    </div>
    
</div>

<?php yii\bootstrap\Modal::end(); ?>