<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProcesosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Procesos';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
echo $this->render('_search', ['model' => $searchModel]);
$procesos = $dataProvider->getModels()
?>


<div class="row">
    <div class="col-md-12 " style="margin-bottom: 10px;">
        <?php if (\Yii::$app->user->can('/procesos/create') || \Yii::$app->user->can('/*')) : ?> 
            <?= Html::a('<i class="flaticon-add" ></i> ' . 'Nuevo proceso', ['create'], ['class' => 'btn btn-primary pull-right']) ?>
        <?php endif; ?> 

    </div>

    <?php foreach ($procesos as $idProceso => $proceso) : ?>
        <div class="col-md-12">

            <!-- PROCESO -->
            <div class="box box-primary">
                <div class="box-header with-border">



                    <!-- SI EL PROCESO ESTA EN JURIDICO SE DEBE MOSTARR EL NUMERO DEL RADICADO -->
                    <?php if ($proceso->estado_proceso_id == '5') : ?>
                        <h3 class="box-title" style="font-size: 18px !important;">
                            <b>Radicado #:</b> 12345678901234567
                        </h3>
                    <?php endif; ?>

                    <!-- BOTONES DE EDICIÓN, VISTA Y BORRADO -->
                    <div class="box-tools pull-right">
                        <?php
                        //Colaboradores
                        $colaboradores = array_column($proceso->procesosXColaboradores, 'user_id');
                        //Lider
                        $lider = $proceso->jefe_id;
                        //ID usuario logueado
                        $userId = (int) \Yii::$app->user->id;
                        //SI EL USUARIO PUEDE EDITAR
                        if ((in_array($userId, $colaboradores) ||
                                $userId == $lider ||
                                Yii::$app->user->identity->isSuperAdmin()) && \Yii::$app->user->can('/procesos/update')) {
                            echo Html::a('<span class="flaticon-edit" ></span>', Url::to(['procesos/update', 'id' => $proceso->id]), [
                                'title' => 'Editar',
                                'class' => 'btn btn-default'
                            ]);
                        }
                        //SI EL USUARIO PUEDE  VER
                        if (\Yii::$app->user->can('/procesos/view')) {
                            echo Html::a('<span class="flaticon-search-magnifier-interface-symbol" ></span>', Url::to(['procesos/view', 'id' => $proceso->id]), [
                                'title' => 'Ver',
                                'class' => 'btn btn-default'
                            ]);
                        }
                        //SI EL USUARIO PUEDE  BORRAR
                        if (\Yii::$app->user->can('/procesos/delete')) {
                            echo Html::a('<span class="flaticon-circle" ></span>', Url::to(['procesos/delete', 'id' => $proceso->id]), [
                                'data-confirm' => '¿Está seguro que desea eliminar este ítem?',
                                'data-method' => 'post',
                                'title' => 'Borrar',
                                'class' => 'btn btn-default'
                            ]);
                        }
                        ?>
                    </div>
                </div>

                <!-- RESUMEN DEL PROCESO -->
                <div class="box-body ">



                    <!-- SI EL PROCESO ESTÁ PREJURIDICO MUESTRO LA INFO DEL CLIENTE Y DEL DEUDOR -->
                    <?php if ($proceso->estado_proceso_id != '5') : ?>
                        <!-- CLIENTE -->
                        <div class="col-md-4 invoice-col">
                            <p>
                                <?= Html::a($proceso->cliente->nombre, ['clientes/viewsummary', 'id' => $proceso->cliente_id], ['class' => 'popupModal']); ?>
                                <br />
                                <b><?= Yii::$app->utils->filtroTipoDocumento($proceso->cliente->tipo_documento); ?>: </b>
                                <?= $proceso->cliente->documento; ?>
                                <br />
                                <i class="fa fa-map-marker" style="color: #000;"></i> <?= $proceso->deudor->direccion; ?>
                            </p>
                        </div>
                        <!-- DEUDOR -->
                        <div class="col-md-4 invoice-col">
                            <p>
                                <?= Html::a($proceso->deudor->nombre, ['deudores/viewsummary', 'id' => $proceso->deudor_id], ['class' => 'popupModal']); ?>
                                <br />
                                <b><?= Yii::$app->utils->filtroTipoDocumento($proceso->deudor->tipo_documento); ?>: </b>
                                <?= $proceso->deudor->documento; ?>
                                <br />
                                <i class="fa fa-bookmark" style="color: #000;"></i> <?= $proceso->deudor->marca; ?>
                                <br />
                                <i class="fa fa-map-marker" style="color: #000;"></i> <?= $proceso->deudor->direccion; ?>
                            </p>
                        </div>
                        <div class="col-md-2 invoice-col vertical-center">
                            <?=
                            Html::a('<i class="flaticon-search-magnifier-interface-symbol"></i> Resumen prejurídico',
                                    'javascript:void(0)',
                                    [
                                        'title' => 'clientes',
                                        'class' => 'btn btn-default',
                                        'onclick' => "                                    
                                                $.ajax({
                                                        type    :'POST',
                                                        cache   : false,
                                                        url     : '" . Url::to(['procesos/view-summary-prejuridico', 'id' => $proceso->id]) . "',
                                                        success : function(response) {
                                                                $('#ajax_result-prejuridico').html(response);
                                                        }
                                                });
                                                return false;",
                                    ]
                            );
                            ?>
                        </div>
                        <div class="col-md-2 invoice-col vertical-center estado-proceso">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-bookmark"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-number"><?= $proceso->estadoProceso->nombre ?></span>
                                </div>
                            </div>                            
                        </div>

                    <?php endif; ?>

                    <!-- SI EL PROCESO ESTÁ PREJURIDICO MUESTRO LA INFO DEL CLIENTE Y DEL DEUDOR -->
                    <?php if ($proceso->estado_proceso_id == '5') : ?>
                        <!-- CLIENTE -->
                        <div class="col-md-4 invoice-col">
                            <p>
                                <b>Demandante: </b>
                                <?= Html::a($proceso->cliente->nombre, ['clientes/viewsummary', 'id' => $proceso->cliente_id], ['class' => 'popupModal']); ?>
                                <br />
                                <b>Demandado(s): </b>
                                <?php 
                                $demandados=[];
                                foreach ($proceso->demandadosXProceso as $value) {
                                    $demandados[] = Html::a($value->nombre, ['deudores/viewsummary', 'id' => $proceso->deudor_id], ['class' => 'popupModal']);
                                }
                                echo implode(", ", $demandados);
                                ?>
                            </p>

                        </div>
                        <div class="col-md-4 invoice-col">
                            <p>
                                <b>Tipo de proceso: </b>
                                <?= isset($proceso->jurTipoProceso->nombre) ? $proceso->jurTipoProceso->nombre : '-'; ?>
                                <br />
                                <b>Etapa procesal: </b>
                                <?= isset($proceso->jurEtapasProcesal->nombre) ? $proceso->jurEtapasProcesal->nombre : '-'; ?>
                                <br />
                                <b>Juzgado: </b>
                                <?= isset($proceso->jur_juzgado) ? $proceso->jur_juzgado : '-'; ?>
                            </p>

                        </div>
                        <div class="col-md-2 invoice-col vertical-center">
                            <?=
                            Html::a('<i class="flaticon-search-magnifier-interface-symbol"></i> Resumen jurídico',
                                    'javascript:void(0)',
                                    [
                                        'title' => 'clientes',
                                        'class' => 'btn btn-default',
                                        'onclick' => "                                    
                                                $.ajax({
                                                        type    :'POST',
                                                        cache   : false,
                                                        url     : '" . Url::to(['procesos/view-summary-juridico', 'id' => $proceso->id]) . "',
                                                        success : function(response) {
                                                                $('#ajax_result-juridico').html(response);
                                                        }
                                                });
                                                return false;",
                                    ]
                            );
                            ?>
                        </div>
                        <div class="col-md-2 invoice-col vertical-center estado-proceso">
                            <div class="info-box">
                                <span class="info-box-icon bg-yellow"><i class="fa fa-bookmark"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-number"><?= $proceso->estadoProceso->nombre ?></span>
                                </div>
                            </div>                            
                        </div>
                    <?php endif; ?>
                </div>

                <!-- VALORES DEL PROCESO -->
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">$<?= number_format($proceso->prejur_valor_activacion, 0, ",", ".") ?></h5>
                                <span class="description-text">PRE: V. activación</span>
                            </div>                            
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">$<?= number_format($proceso->prejur_saldo_actual, 0, ",", "."); ?></h5>
                                <span class="description-text">PRE: Saldo actual</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <h5 class="description-header">$<?= number_format($proceso->jur_valor_activacion, 0, ",", "."); ?></h5>
                                <span class="description-text">JUR: V. activación</span>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block">
                                <h5 class="description-header">$<?= number_format($proceso->jur_saldo_actual, 0, ",", "."); ?></h5>
                                <span class="description-text">JUR: Saldo actual</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
</div>

<?= Html::tag('div', '', ['id' => 'ajax_result-prejuridico']); ?>
<?= Html::tag('div', '', ['id' => 'ajax_result-juridico']); ?>
<?php
yii\bootstrap\Modal::begin([
    'id' => 'modal',
    'size' => yii\bootstrap\Modal::SIZE_LARGE,
]);
yii\bootstrap\Modal::end();

$this->registerJs("$(function() {
   $('.popupModal').click(function(e) {
     e.preventDefault();
     $('#modal').modal('show').find('.modal-content')
     .load($(this).attr('href'));
   });
});");
?>