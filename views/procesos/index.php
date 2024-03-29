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

<!-- BUSCADOR DE LOS PROCESOS -->
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
                                return "{$modelGestionsPre->descripcion_gestion} \r";
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
    [
        'label' => 'valores de activación',
        'format' => 'raw',
        'value' => function ($data) {
            //VALORES DE ACTIVACION ACTUALES PARA MOSTRAR
            $valoresActivacion = $data->valoresActivacionJuridico;
            $htmlValor = '';
            foreach ($valoresActivacion as $valorActivacion) {
                $htmlValor .= "<b>Valor de activación:</b> " . number_format($valorActivacion->valor, 2, ",", ".") . "\r\r";
            }
            return $htmlValor;
        }
    ],
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
    # Radicado 1            
    [
        'attribute' => 'jur_departamento_id',
        'label' => 'Departamento Radicado #1',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jurDepartamento->nombre ?? null;
        },
    ],
    [
        'attribute' => 'jur_ciudad_id',
        'label' => 'Ciudad Radicado #1',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jurCiudad->nombre ?? null;
        },
    ],
    [
        'attribute' => 'jur_jurisdiccion_competent_id',
        'label' => 'Jurisdicción competente Radicado #1',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jurJurisdiccionCompetent->nombre ?? null;
        },
    ],
    [
        'attribute' => 'jur_juzgado',
        'label' => 'Juzgado Radicado #1'
    ],
    [
        'attribute' => 'jur_radicado',
        'label' => 'Radicado #1'
    ],
    [
        'attribute' => 'jur_comentario_radicado_1',
        'label' => 'Comentario radicado #1'
    ],
    # Radicado 2
    [
        'attribute' => 'jur_departamento_id_2',
        'label' => 'Departamento Radicado #2',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jurDepartamento2->nombre ?? null;
        },
    ],
    [
        'attribute' => 'jur_ciudad_id_2',
        'label' => 'Ciudad Radicado #2',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jurCiudad2->nombre ?? null;
        },
    ],
    [
        'attribute' => 'jur_jurisdiccion_competent_id_2',
        'label' => 'Jurisdicción competente Radicado #2',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jurJurisdiccionCompetent2->nombre ?? null;
        },
    ],
    [
        'attribute' => 'jur_juzgado_2',
        'label' => 'Juzgado Radicado #2'
    ],
    [
        'attribute' => 'jur_radicado_2',
        'label' => 'Radicado #2'
    ],
    [
        'attribute' => 'jur_comentario_radicado_2',
        'label' => 'Comentario radicado #2'
    ],
    # Radicado 3
    [
        'attribute' => 'jur_departamento_id_3',
        'label' => 'Departamento Radicado #3',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jurDepartamento3->nombre ?? null;
        },
    ],
    [
        'attribute' => 'jur_ciudad_id_3',
        'label' => 'Ciudad Radicado #3',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jurCiudad3->nombre ?? null;
        },
    ],
    [
        'attribute' => 'jur_jurisdiccion_competent_id_3',
        'label' => 'Jurisdicción competente Radicado #3',
        'format' => 'raw',
        'value' => function ($data) {
            return $data->jurJurisdiccionCompetent3->nombre ?? null;
        },
    ],
    [
        'attribute' => 'jur_juzgado_3',
        'label' => 'Juzgado Radicado #3'
    ],
    [
        'attribute' => 'jur_radicado_3',
        'label' => 'Radicado #3'
    ],
    [
        'attribute' => 'jur_comentario_radicado_3',
        'label' => 'Comentario radicado #3'
    ],
    [
        'attribute' => 'jur_gestiones_juridicas',
        'format' => 'raw',
        'value' => function ($data) {
            return implode("\r", \yii\helpers\ArrayHelper::map(
                            $data->gestionesJuridicas,
                            'id', function($modelGestionsPre) {
                                return "<b>{$modelGestionsPre->fecha_gestion}:</b> {$modelGestionsPre->descripcion_gestion}\r";
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

//COLUMNAS PARA EL EXPORTABLE SI SOY CLIENTE
if (Yii::$app->user->identity->isCliente()) {
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
        [
            'attribute' => 'prejur_gestiones_prejuridicas',
            'format' => 'raw',
            'value' => function ($data) {
                return implode("\r", \yii\helpers\ArrayHelper::map(
                                $data->gestionesPrejuridicas,
                                'id', function($modelGestionsPre) {
                                    return "{$modelGestionsPre->descripcion_gestion} \r";
                                }
                        )
                );
            },
        ],
        'jur_fecha_recepcion:date',
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
                                    return "{$modelGestionsPre->descripcion_gestion}\r\r";
                                }
                        )
                );
            },
        ],
        [
            'attribute' => 'estado_proceso_id',
            'format' => 'raw',
            'value' => function ($data) {
                return $data->estadoProceso->nombre ?? null;
            },
        ],
    ];
}

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
                    'dataProvider' => $exportDataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $exportColumns,
                    'selectedColumns' => [2, 7, 9, 22, 29, 30, 32, 35, 36, 37, 51, 58],
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

        <?php
        //Colaboradores
        $colaboradores = array_column($proceso->procesosXColaboradores, 'user_id');
        //Lider
        $lider = $proceso->jefe_id;
        //ID usuario logueado
        $userId = (int) \Yii::$app->user->id;
        //alerta envío memorial. Se pintarán colores distintos en el borde de la box-primary
        $fechaUltimaGestionJur = date('Y-m-d');
        $hoy = date('Y-m-d');

        // ESCAPAR LOS SALTOS DE LINEAS PARA LOS COMENTARIOS DE LOS RADICADOS
        $proceso->jur_comentario_radicado_1 = str_replace(["\r\n", "\n", "\r"], " <br /> ", $proceso->jur_comentario_radicado_1);
        $proceso->jur_comentario_radicado_2 = str_replace(["\r\n", "\n", "\r"], " <br /> ", $proceso->jur_comentario_radicado_2);
        $proceso->jur_comentario_radicado_3 = str_replace(["\r\n", "\n", "\r"], " <br /> ", $proceso->jur_comentario_radicado_3);

        if (isset($proceso->gestionesJuridicas[0]['fecha_gestion'])) {
            $fechaUltimaGestionJur = date('Y-m-d', strtotime($proceso->gestionesJuridicas[0]['fecha_gestion']));
        }
        //calcular numero de dias trascurridos desde la ultima gestion juridica
        $dias = (strtotime($hoy) - strtotime($fechaUltimaGestionJur)) / 24 / 3600;

        $boxBorderStyle = 'box-primary';

        if ($dias >= 150 && $dias < 180) {
            $boxBorderStyle = 'box-primary-yellow';
        } elseif ($dias >= 180) {
            $boxBorderStyle = 'box-primary-red';
        }
        ?>
        <div class="col-md-12">

            <!-- PROCESO -->
            <div class="box <?= $boxBorderStyle ?>">
                <div class="box-header with-border"> 

                    <!-- SI EL PROCESO ESTA EN JURIDICO SE DEBE MOSTARR EL NUMERO DEL RADICADO -->
                    <?php if ($proceso->estado_proceso_id == '5') : ?>
                        <?php if (!empty($proceso->jur_radicado)) : ?>
                            <h3 class="box-title" style="font-size: 12px !important;">
                                <b>Radicado #:</b> <?= $proceso->jur_radicado; ?>
                            </h3>
                            <?=
                            Html::a('<i class="flaticon-search-magnifier-interface-symbol"></i> Ver',
                                    'javascript:void(0)',
                                    [
                                        'title' => 'clientes',
                                        'class' => 'btn btn-default',
                                        'onclick' => "
                                            $.ajax({
                                                type: 'POST',
                                                cache: false,
                                                url     : '" . Url::to(['procesos/view-summary-radicado']) . "',
                                                data: {
                                                    'depa': '" . $proceso->jurDepartamento->nombre . "',
                                                    'ciu': '" . $proceso->jurCiudad->nombre . "',                                                    
                                                    'juz': '" . $proceso->jur_juzgado . "',
                                                    'ano': '" . $proceso->jur_anio_radicado . "',
                                                    'con': '" . $proceso->jur_consecutivo_proceso . "',
                                                    'ins': '" . $proceso->jur_instancia_radicado . "',
                                                    'radicado': '" . $proceso->jur_radicado . "',
                                                    'coment': '" . $proceso->jur_comentario_radicado_1 . "',
                                                },
                                                success: function (response) {
                                                    $('#ajax_result-radicado').html(response);
                                                }
                                            }); return false;",
                                    ]
                            );
                            ?>
                        <?php endif; ?>
                        <?php if (!empty($proceso->jur_radicado_2)) : ?>
                            <h3 class="box-title" style="font-size: 12px !important;">
                                <b>Radicado #2:</b> <?= $proceso->jur_radicado_2; ?>
                            </h3>
                            <?=
                            Html::a('<i class="flaticon-search-magnifier-interface-symbol"></i> Ver',
                                    'javascript:void(0)',
                                    [
                                        'title' => 'clientes',
                                        'class' => 'btn btn-default',
                                        'onclick' => "
                                            $.ajax({
                                                type: 'POST',
                                                cache: false,
                                                url     : '" . Url::to(['procesos/view-summary-radicado']) . "',
                                                data: {
                                                    'depa': '" . $proceso->jurDepartamento2->nombre . "',
                                                    'ciu': '" . $proceso->jurCiudad2->nombre . "',                                                    
                                                    'juz': '" . $proceso->jur_juzgado_2 . "',
                                                    'ano': '" . $proceso->jur_anio_radicado_2 . "',
                                                    'con': '" . $proceso->jur_consecutivo_proceso_2 . "',
                                                    'ins': '" . $proceso->jur_instancia_radicado_2 . "',
                                                    'radicado': '" . $proceso->jur_radicado_2 . "',
                                                    'coment': '" . $proceso->jur_comentario_radicado_2 . "',
                                                },
                                                success: function (response) {
                                                    $('#ajax_result-radicado').html(response);
                                                }
                                            }); return false;",
                                    ]
                            );
                            ?>
                        <?php endif; ?>
                        <?php if (!empty($proceso->jur_radicado_3)) : ?>
                            <h3 class="box-title" style="font-size: 12px !important;">
                                <b>Radicado #3:</b> <?= $proceso->jur_radicado_3; ?>
                            </h3>
                            <?=
                            Html::a('<i class="flaticon-search-magnifier-interface-symbol"></i> Ver',
                                    'javascript:void(0)',
                                    [
                                        'title' => 'clientes',
                                        'class' => 'btn btn-default',
                                        'onclick' => "
                                            $.ajax({
                                                type: 'POST',
                                                cache: false,
                                                url     : '" . Url::to(['procesos/view-summary-radicado']) . "',
                                                data: {
                                                    'depa': '" . $proceso->jurDepartamento3->nombre . "',
                                                    'ciu': '" . $proceso->jurCiudad3->nombre . "',                                                    
                                                    'juz': '" . $proceso->jur_juzgado_3 . "',
                                                    'ano': '" . $proceso->jur_anio_radicado_3 . "',
                                                    'con': '" . $proceso->jur_consecutivo_proceso_3 . "',
                                                    'ins': '" . $proceso->jur_instancia_radicado_3 . "',
                                                    'radicado': '" . $proceso->jur_radicado_3 . "',
                                                    'coment': '" . $proceso->jur_comentario_radicado_3 . "',
                                                },
                                                success: function (response) {
                                                    $('#ajax_result-radicado').html(response);
                                                }
                                            }); return false;",
                                    ]
                            );
                            ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- BOTONES DE EDICIÓN, VISTA Y BORRADO -->
                    <div class="box-tools pull-right">
                        <?php
                        //SI EL USUARIO PUEDE EDITAR
                        if ((in_array($userId, $colaboradores) ||
                                $userId == $lider ||
                                Yii::$app->user->identity->isSuperAdmin()) && \Yii::$app->user->can('/procesos/update')) {
                            echo Html::a('<span class="flaticon-edit" ></span>', Url::to(['procesos/update', 'id' => $proceso->id, 'filter' => base64_encode(Yii::$app->request->getQueryString())]), [
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
                                <i class="fa fa-map-marker" style="color: #000;"></i> <?= $proceso->cliente->direccion; ?>                                
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
                                <br />
                                <i class="fa fa-map-o" style="color: #000;"></i> <?= $proceso->deudor->ciudad; ?>
                            </p>
                        </div>
                        <div class="col-md-2 invoice-col vertical-center" style="display: grid">
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
                                <?php
                                if (isset($proceso->jur_juzgado)) {
                                    $temp = explode(",", $proceso->jur_juzgado);
                                    $newJuzgado = end($temp);
                                    echo $newJuzgado;
                                } else {
                                    echo '-';
                                }
                                ?>
                            </p>

                        </div>
                        <div class="col-md-2 invoice-col vertical-center" style="display: grid">
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
                                <?php
                                $vActi = $proceso->valoresActivacionJuridico;
                                $count = 0;
                                $totalVA = 0;
                                foreach ((array) $vActi as $va) {
                                    $count++;
                                    $totalVA += $va->valor;
                                }
                                ?>
                                <h5 class="description-header">(<?= $count; ?>) $<?= number_format($totalVA, 2, ",", "."); ?></h5>
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

<!-- PAGINADOR -->
<?php
echo \yii\widgets\LinkPager::widget([
    'pagination' => $dataProvider->pagination,
    'firstPageLabel' => 'Inicio',
    'lastPageLabel' => 'Fin'
]);
?>

<!-- MODALES -->
<?= Html::tag('div', '', ['id' => 'ajax_result-prejuridico']); ?>
<?= Html::tag('div', '', ['id' => 'ajax_result-juridico']); ?>
<?= Html::tag('div', '', ['id' => 'ajax_result-radicado']); ?>
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