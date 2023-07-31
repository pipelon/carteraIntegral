<?=
\app\components\NotificacionesWidget::widget([
    "tipo" => $tipo,
    "codcarta" => $codcarta,
    "id" => $model->id,
    "juzgado" => $model->jur_juzgado,
    "demandante" => $model->cliente->nombre,
    "demandado" => $model->deudor->nombre,
    "radicado" => $model->jur_radicado
]);
?>