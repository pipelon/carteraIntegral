<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProcesosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Procesos';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
echo $this->render('_search', ['model' => $searchModel]);
$procesos = $dataProvider->getModels();
?>

<!-- EXPORTACIÓN DE PROCESOS -->
<?php
//COLUMNAS PARA EL EXPORTABLE DEL TAR EN EXCEL
$exportColumns = [
    'id',
    [
        'attribute' => 'cliente_id',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->cliente->nombre . ' (' . $data->cliente->documento . ')';
        },
    ],
    [
        'attribute' => 'deudor_id',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->deudor->nombre . ' (' . $data->deudor->marca . ')';
        },
    ],
    [
        'attribute' => 'plataforma_id',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->plataforma->nombre ?? null;
        },
    ],
    [
        'attribute' => 'jefe_id',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jefe->name;
        },
    ],
    [
        'attribute' => 'colaboradores',
        'format' => 'raw',
        'value' => function ($data) {
            return implode(", ", \yii\helpers\ArrayHelper::map(
                            $data->procesosXColaboradores,
                            'user_id', function($modelProxCol) {
                                return $modelProxCol->user->name;
                            }
                    )
            );
        },
    ],
    'prejur_fecha_recepcion:date',
    [
        'attribute' => 'prejur_tipo_caso',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->prejurTipoCaso->nombre ?? null;
        },
    ],
    'prejur_valor_activacion:decimal',
    'prejur_saldo_actual:decimal',
    [
        'attribute' => 'prejur_carta_enviada',
        'format' => 'raw',
        'value' => function ($data) {
            return "<b>{$data->prejur_carta_enviada}</b>, Comentario: {$data->prejur_fecha_carta}";
        }
    ],
    [
        'attribute' => 'prejur_llamada_realizada',
        'format' => 'raw',
        'value' => function ($data) {
            return "<b>{$data->prejur_llamada_realizada}</b>, Comentario: {$data->prejur_fecha_llamada}";
        }
    ],
    [
        'attribute' => 'prejur_visita_domiciliaria',
        'format' => 'raw',
        'value' => function ($data) {
            return "<b>{$data->prejur_visita_domiciliaria}</b>, Comentario: {$data->prejur_fecha_visita}";
        }
    ],
    'prejur_acuerdo_pago',
    [
        'label' => 'acuerdos de pagos',
        'format' => 'raw',
        'value' => function ($data) {
            //CONSOLIDADO DE PAGOS ACTUALES PARA MOSTRAR
            $acuerdoPagos = $data->consolidadoPagosPrejuridicos;
            $htmlPago = '';
            foreach ($acuerdoPagos as $pago) {
                $htmlPago .= "<b>Fecha acuerdo de pago:</b> {$pago->fecha_acuerdo_pago}<br/>"
                        . "<b>Valor acordado:</b> " . number_format($pago->valor_acuerdo_pago, 2, ",", ".") . "<br/>"
                        . "<b>Descripción:</b> {$pago->descripcion}<br/>"
                        . "<b>Fecha pago realizado:</b> {$pago->fecha_pago_realizado}<br/>"
                        . "<b>Valor pagado:</b> " . number_format($pago->valor_pagado, 2, ",", ".") . "<br/><br/>";
            }
            return $htmlPago;
        }
    ],
    'prejur_consulta_rama_judicial:ntext',
    'prejur_consulta_entidad_reguladora:ntext',
    'prejur_resultado_estudio_bienes',
    [
        'attribute' => 'prejur_estudio_bienes',
        'format' => 'raw',
        'value' => function ($data) {
            return implode("\r", \yii\helpers\ArrayHelper::map(
                            $data->bienesXProcesos,
                            'bien_id', function($modelBiexPro) {
                                return "<b>" . $modelBiexPro->bien->nombre . ": </b>" . $modelBiexPro->comentario;
                            }
                    )
            );
        },
    ],
    'prejur_informe_castigo_enviado',
    'prejur_carta_castigo_enviada',
    'prejur_concepto_viabilidad:ntext',
    [
        'attribute' => 'prejur_gestiones_prejuridicas',
        'format' => 'raw',
        'value' => function ($data) {
            return implode("\r", \yii\helpers\ArrayHelper::map(
                            $data->gestionesPrejuridicas,
                            'id', function($modelGestionsPre) {
                                return "<b>Usuario:</b> {$modelGestionsPre->usuario_gestion}, <b>Fecha:</b> {$modelGestionsPre->fecha_gestion} \r {$modelGestionsPre->descripcion_gestion} \r";
                            }
                    )
            );
        },
    ],
    'prejur_otros:ntext',
    'jur_fecha_recepcion:date',
    [
        'attribute' => 'jur_documentos_activacion',
        'format' => 'raw',
        'value' => function ($data) {
            return implode("\r", \yii\helpers\ArrayHelper::map(
                            $data->docactivacionXProcesos,
                            'documento_activacion_id', function($modelDocxPro) {
                                return $modelDocxPro->documentoActivacion->nombre;
                            }
                    )
            );
        }
    ],
    [
        'attribute' => 'jur_demandados',
        'format' => 'raw',
        'value' => function ($data) {
            return implode("\r", \yii\helpers\ArrayHelper::map(
                            $data->demandadosXProceso,
                            'demandado_id', function($modelDemxPro) {
                                return $modelDemxPro->nombre;
                            }
                    )
            );
        },
    ],
    [
        'label' => 'Consolidado de pagos',
        'format' => 'raw',
        'value' => function ($data) {
            //CONSOLIDADO DE PAGOS ACTUALES PARA MOSTRAR
            $pagos = $data->consolidadoPagosJuridicos;
            $htmlPago = '';
            foreach ($pagos as $pago) {
                $htmlPago .= '<b>Fecha:</b> ' . $pago->fecha_pago . ' \r'
                        . '<b>Valor:</b> ' . number_format($pago->valor_pago, 2, ",", ".") . '\r\r';
            }
            return $htmlPago;
        }
    ],
    'jur_valor_activacion:decimal',
    'jur_saldo_actual:decimal',
    [
        'attribute' => 'jur_tipo_proceso_id',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jurTipoProceso->nombre ?? null;
        },
    ],
    'jur_fecha_etapa_procesal',
    [
        'attribute' => 'jur_etapas_procesal_id',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jurEtapasProcesal->nombre ?? null;
        },
    ],
    [
        'attribute' => 'jur_departamento_id',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jurDepartamento->nombre ?? null;
        },
    ],
    [
        'attribute' => 'jur_ciudad_id',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jurCiudad->nombre ?? null;
        },
    ],
    [
        'attribute' => 'jur_jurisdiccion_competent_id',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jurJurisdiccionCompetent->nombre ?? null;
        },
    ],
    'jur_juzgado',
    'jur_radicado',
    [
        'attribute' => 'jur_gestiones_juridicas',
        'format' => 'raw',
        'value' => function ($data) {
            return implode("\r", \yii\helpers\ArrayHelper::map(
                            $data->gestionesJuridicas,
                            'id', function($modelGestionsPre) {
                                return "<b>Usuario:</b> {$modelGestionsPre->usuario_gestion}, <b>Fecha:</b> {$modelGestionsPre->fecha_gestion} \r {$modelGestionsPre->descripcion_gestion}\r\r";
                            }
                    )
            );
        },
    ],
    [
        'attribute' => 'carpeta',
        'format' => 'raw',
        'value' => function ($data) {
            if ($data->carpeta) {
                $url = 'https://drive.google.com/open?id=' . $data->carpeta;
                return Html::a($url, $url, ['target' => '_blank']);
            }
        },
    ],
    [
        'label' => strtoupper('Archivos'),
        'format' => 'raw',
        'value' => function ($data) {
            if ($data->carpeta) {
                return Yii::$app->gdrive->leerArchivosCarpeta($data->carpeta);
            }
        },
    ],
    'estrec_probabilidad_recuperacion',
    'estrec_pretenciones:ntext',
    'estrec_tiempo_recuperacion:ntext',
    'estrec_comentarios:ntext',
    [
        'label' => 'Tareas',
        'format' => 'raw',
        'value' => function ($data) {
            //TAREAS ACTUALES PARA MOSTRAR
            $tareas = $data->tareas;
            $htmlPago = '';
            foreach ($tareas as $tarea) {
                $estado = $tarea->estado ? '<span class="badge bg-green">Terminada</span>' : '<span class="badge bg-orange">Pendiente</span>';
                $htmlPago .= "<b>Asignado a: </b>{$tarea->user->name} \r"
                        . "<b> Jefe: </b>{$tarea->jefe->name} \r"
                        . "<b> Fecha: </b>{$tarea->fecha_esperada} \r"
                        . "<b> Descripción: </b>{$tarea->descripcion} \r"
                        . "<b> Estado: </b>{$estado} \r"
                        . "\r\r";
            }
            return $htmlPago;
        }
    ],
    [
        'attribute' => 'estado_proceso_id',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->estadoProceso->nombre ?? null;
        },
    ],
];

//TIPOS DE EXPORTACION
$exportConfig = [
    ExportMenu::FORMAT_TEXT => false,
    ExportMenu::FORMAT_CSV => false,
    ExportMenu::FORMAT_HTML => false,
    ExportMenu::FORMAT_PDF => false
];
//MENU DE EXPORTACION
$fullExportMenu = ExportMenu::widget(
                [
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $exportColumns,
                    'showConfirmAlert' => false,
                    'fontAwesome' => true,
                    'target' => '_blank',
                    'filename' => "Procesos_" . date('Y-m-d-H-i-s'),
                    'exportConfig' => $exportConfig,
                    'dropdownOptions' => [
                        'label' => 'Exportar',
                        'class' => 'btn btn-secondary'
                    ]
                ]
);
?>

<div class="row">

    <div class="col-md-6 " style="margin-bottom: 10px;">
        <?= $fullExportMenu; ?>
    </div>

    <div class="col-md-6 " style="margin-bottom: 10px;">
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
                            <b>Radicado #:</b> <?= $proceso->jur_radicado; ?>
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
                                $demandados = [];
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