<?php

use yii\bootstrap\Html;
    
$this->title = 'Vista previa';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="liquidaciones-index box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">CARTA</h3>
        <?=
        Html::a("<span class='flaticon-list-3'></span> Generar Carta",
                ["liquidaciones/vista-previa", "id" => $model->id, "tipo" => "generar"],
                ["target" => "_blank", "class" => "btn btn-primary pull-right"]);
        ?>
    </div>
    <div class="box-body table-responsive">
        <?=
        \app\components\LiquidacionesWidget::widget([
            "tipo" => $tipo,
            "cliente" => $model->cliente,
            "deudor" => $model->deudor,
            "factura" => $model->numero_factura,
            "fecha_inicio" => $model->fecha_inicio,
            "fecha_fin" => $model->fecha_fin,
            "saldo" => $model->saldo,
        ]);
        ?>
    </div>
</div>

<div class="liquidaciones-index box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">LIQUIDACION</h3>
        <?=
        Html::a("<span class='flaticon-list-3'></span> Generar Liquidación",
                ["liquidaciones/generar-liquidacion", "id" => $model->id],
                ["target" => "_blank", "class" => "btn btn-primary pull-right"]);
        ?>
    </div>
    <div class="box-body table-responsive">
        
    </div>
</div>




