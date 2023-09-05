<?php
$out = \app\components\NotificacionesWidget::widget([
    "tipo" => 'generar',
    "codcarta" => $codcarta,
    "id" => $model->id,
    "juzgado" => $model->jur_juzgado,
    "demandante" => $model->cliente->nombre,
    "demandado" => $model->deudor->nombre." - ".$model->deudor->marca,
    "radicado" => $model->jur_radicado
]);
echo $out;

?>