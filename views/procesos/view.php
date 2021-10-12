<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Procesos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Procesos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="procesos-view box box-primary">
    <div class="box-header">
        <?php if (\Yii::$app->user->can('/procesos/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/procesos/update') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 20px"></i> ' . 'Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/procesos/delete') || \Yii::$app->user->can('/*')) : ?>        
            <?=
            Html::a('<i class="flaticon-circle" style="font-size: 20px"></i> ' . 'Borrar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Está seguro que desea eliminar este ítem?',
                    'method' => 'post',
                ],
            ])
            ?>
        <?php endif; ?> 
    </div>
    <div class="box-body table-responsive no-padding">
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
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
                        return $data->plataforma->nombre;
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
                    'value' => implode(", ", \yii\helpers\ArrayHelper::map(
                                    $model->procesosXColaboradores,
                                    'user_id', function($modelProxCol) {
                                        return $modelProxCol->user->name;
                                    }
                            )
                    ),
                ],
                [
                    'label' => strtoupper('ESTUDIO PREJURIDICO'),
                    'value' => '',
                    'contentOptions' => ['class' => 'bg-light-blue'],
                    'captionOptions' => ['class' => 'bg-light-blue'],
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
                        return "<b>{$data->prejur_carta_enviada}</b>, Comentario: {$data->prejur_comentarios_carta}";
                    }
                ],
                [
                    'attribute' => 'prejur_llamada_realizada',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return "<b>{$data->prejur_llamada_realizada}</b>, Comentario: {$data->prejur_comentarios_llamada}";
                    }
                ],
                [
                    'attribute' => 'prejur_visita_domiciliaria',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return "<b>{$data->prejur_visita_domiciliaria}</b>, Comentario: {$data->prejur_comentarios_visita}";
                    }
                ],
                'prejur_acuerdo_pago',
                [
                    'label' => 'acuerdos de pagos',
                    'format' => 'raw',
                    'value' => function ($data) use ($acuerdoPagos) {
                        $htmlPago = '';
                        foreach ($acuerdoPagos as $pago) {
                            $htmlPago .= "<b>Fecha acuerdo de pago:</b> {$pago->fecha_acuerdo_pago}<br/>"
                                    . "<b>Valor acordado:</b> " . number_format($pago->valor_acuerdo_pago, 2, ",", ".") . "<br/>"
                                    . "<b>Descripción:</b> {$pago->descripcion}<br/>"
                                    . "<b>Fecha pago realizado:</b>{$pago->fecha_pago_realizado}<br/>"
                                    . "<b>Valor pagado:</b> " . number_format($pago->valor_pagado, 2, ",", ".") . "<br/><br/>";
                        }
                        return $htmlPago;
                    }
                ],
                'prejur_consulta_rama_judicial:ntext',
                'prejur_consulta_entidad_reguladora:ntext',
                [
                    'attribute' => 'prejur_estudio_bienes',
                    'format' => 'raw',
                    'value' => implode("<br />", \yii\helpers\ArrayHelper::map(
                                    $model->bienesXProcesos,
                                    'bien_id', function($modelBiexPro) {
                                        return "<b>" . $modelBiexPro->bien->nombre . ": </b>" . $modelBiexPro->comentario;
                                    }
                            )
                    ),
                ],
                'prejur_concepto_viabilidad:ntext',
                'prejur_otros:ntext',
                [
                    'label' => strtoupper('JURÍDICO'),
                    'value' => '',
                    'contentOptions' => ['class' => 'bg-light-blue'],
                    'captionOptions' => ['class' => 'bg-light-blue'],
                ],
                'jur_fecha_recepcion:date',
                [
                    'attribute' => 'jur_documentos_activacion',
                    'format' => 'raw',
                    'value' => implode("<br />", \yii\helpers\ArrayHelper::map(
                                    $model->docactivacionXProcesos,
                                    'documento_activacion_id', function($modelDocxPro) {
                                        return $modelDocxPro->documentoActivacion->nombre;
                                    }
                            )
                    ),
                ],
                [
                    'label' => 'Consolidado de pagos',
                    'format' => 'raw',
                    'value' => function ($data) use ($pagos) {
                        $htmlPago = '';
                        foreach ($pagos as $pago) {
                            $htmlPago .= '<b>Fecha:</b> ' . $pago->fecha_pago . ' <br />'
                                    . '<b>Valor:</b> ' . number_format($pago->valor_pago, 2, ",", ".") . '<br /><br />';
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
                [
                    'label' => strtoupper('Documentos'),
                    'value' => '',
                    'contentOptions' => ['class' => 'bg-light-blue'],
                    'captionOptions' => ['class' => 'bg-light-blue'],
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
                [
                    'label' => strtoupper('ESTADO DE RECUPERACIÓN'),
                    'value' => '',
                    'contentOptions' => ['class' => 'bg-light-blue'],
                    'captionOptions' => ['class' => 'bg-light-blue'],
                ],
                'estrec_probabilidad_recuperacion',
                'estrec_pretenciones:ntext',
                'estrec_tiempo_recuperacion:ntext',
                'estrec_comentarios:ntext',
                [
                    'label' => strtoupper('TAREAS'),
                    'value' => '',
                    'contentOptions' => ['class' => 'bg-light-blue'],
                    'captionOptions' => ['class' => 'bg-light-blue'],
                ],
                [
                    'label' => 'Tareas',
                    'format' => 'raw',
                    'value' => function ($data) use ($tareas) {
                        $htmlPago = '';
                        foreach ($tareas as $tarea) {
                            $estado = $tarea->estado ? '<span class="badge bg-green">Terminada</span>' : '<span class="badge bg-orange">Pendiente</span>';
                            $htmlPago .= "<b>Asignado a: </b>{$tarea->user->name} <br />"
                                    . "<b> Jefe: </b>{$tarea->jefe->name} <br />"
                                    . "<b> Fecha: </b>{$tarea->fecha_esperada} <br />"
                                    . "<b> Descripción: </b>{$tarea->descripcion} <br />"
                                    . "<b> Estado: </b>{$estado} <br />"
                                    . "<br /><br />";
                        }
                        return $htmlPago;
                    }
                ],
                [
                    'label' => strtoupper('ESTADO DEL PROCESO'),
                    'value' => '',
                    'contentOptions' => ['class' => 'bg-light-blue'],
                    'captionOptions' => ['class' => 'bg-light-blue'],
                ],
                [
                    'attribute' => 'estado_proceso_id',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return $data->estadoProceso->nombre ?? null;
                    },
                ],
            ],
        ]);
        ?>
    </div>
</div>
