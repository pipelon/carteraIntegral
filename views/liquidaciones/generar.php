<?=

\app\components\LiquidacionesWidget::widget([
    "tipo" => $tipo,
    "cliente" => $model->cliente,
    "deudor" => $model->deudor,
    "datos" => $model->datos
]);
?>