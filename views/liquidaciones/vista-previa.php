<?php

use yii\bootstrap\Html;

$this->title = 'Vista previa';
$this->params['breadcrumbs'][] = $this->title;

$out = json_decode(\app\components\LiquidacionesWidget::widget([
            "tipo" => $tipo,
            "cliente" => $model->cliente,
            "deudor" => $model->deudor,
            "datos" => $model->datos,
        ]));
?>


<div class="liquidaciones-index box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">CARTA</h3>
        <?=
        Html::a("<span class='flaticon-list-3'></span> Generar Carta",
                ["liquidaciones/generar", "id" => $model->id, "tipo" => "carta"],
                ["target" => "_blank", "class" => "btn btn-primary pull-right"]);
        ?>
    </div>
    <div class="box-body table-responsive">
        <?= $out->carta; ?>
    </div>
</div>

<div class="liquidaciones-index box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">LIQUIDACION</h3>
        <?=
        Html::a("<span class='flaticon-list-3'></span> Generar Liquidación",
                ["liquidaciones/generar", "id" => $model->id, "tipo" => "liquidacion"],
                ["target" => "_blank", "class" => "btn btn-primary pull-right"]);
        ?>
    </div>
    <div class="box-body table-responsive">
        <div class="row">
            <div class="col-md-2">
                <?= \yii\bootstrap\Html::img("@web/images/logo-cartera-integral-grande.jpg", ["width" => "100px"]); ?>
            </div>
            <div class="col-md-10">
                <div class="col-md-12 text-center">CARTERA INTEGRAL S.A.S</div>
                <div class="col-md-12 text-center">LIQUIDACIÓN DE DEUDA</div>
                <div class="col-md-4 text-center">CÓDIGO: M2GPFR02</div>
                <div class="col-md-4 text-center">VERSIÓN 01</div>
                <div class="col-md-4 text-center">PÁGINA 1</div>
            </div>
        </div>
        <div class="row margin-top-30">
            <div class="col-md-2"><b>NOMBRE CLIENTE</b></div>
            <div class="col-md-10"><?= $model->cliente->nombre; ?></div>
        </div>
        <div class="row">
            <div class="col-md-2"><b>NOMBRE DEUDOR</b></div>
            <div class="col-md-10"><?= $model->deudor->nombre; ?></div>
        </div>
        <div class="row">
            <div class="col-md-2"><b>NIT</b></div>
            <div class="col-md-10"><?= $model->deudor->documento; ?></div>
        </div>
        <div class="row">
            <div class="col-md-2"><b>FECHA LIQUIDACIÓN</b></div>
            <div class="col-md-10"><?= date("Y-m-d"); ?></div>
        </div>
        <div class="row">
            <div class="col-md-2"><b>INTERÉS</b></div>
            <div class="col-md-10">3,92%</div>
        </div>

        <div class="row margin-top-30">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>TÍTULO / DOCUMENTO</th>
                            <th>FECHA</th>
                            <th>FECHA VENCIMIENTO</th>
                            <th>DÍAS LIQUIDADOS</th>
                            <th>SALDO TÍTULO</th>
                            <th>INTERESES</th>
                            <th>IVA INTERESES</th>
                            <th>HONORARIOS</th>
                            <th>IVA HONORARIOS</th>
                            <th>TOTAL</th>
                        </tr> 
                    </thead>
                    <tbody>   
                        <?php foreach ($out->liquidacion as $v) : ?>
                            <tr>
                                <td><?= $v[0]; ?></td>
                                <td><?= $v[1]; ?></td>
                                <td><?= $v[2]; ?></td>
                                <td><?= $v[3]; ?></td>
                                <td><?= $v[4]; ?></td>
                                <td><?= $v[5]; ?></td>
                                <td><?= $v[6]; ?></td>
                                <td><?= $v[7]; ?></td>
                                <td><?= $v[8]; ?></td>
                                <td><?= $v[9]; ?></td>
                            </tr> 

                        <?php endforeach; ?>
                    </tbody> 
                </table>

            </div>
        </div>

    </div>
</div>

<style>
    .margin-top-30{
        margin-top: 30px;
    }
</style>
