<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportTempSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Report Temps';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (\Yii::$app->user->can('/report-temp/view')) {
    $template .= '{view} ';
}
if (\Yii::$app->user->can('/report-temp/update')) {
    $template .= '{update} ';
}
if (\Yii::$app->user->can('/report-temp/delete')) {
    $template .= '{delete} ';
}
if (\Yii::$app->user->can('/report-temp/*') || \Yii::$app->user->can('/*')) {
    $template = '{view}  {delete}';
}
?>
<div class="report-temp-index box box-primary">
    <div class="box-header with-border">

    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?php
        //COLUMNAS PRELIMINARES DEL REPORTE TAR CON FILTROS
        $gridColumns = [
            'id',
            'col1',
            'col2',
            'col3',
            'col4',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $template,
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="flaticon-search-magnifier-interface-symbol" style="font-size: 20px"></span>', $url, [
                                    'title' => 'Ver',
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="flaticon-edit-1" style="font-size: 20px"></span>', $url, [
                                    'title' => 'Editar',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="flaticon-circle" style="font-size: 20px"></span>', $url, [
                                    'data-confirm' => '¿Está seguro que desea eliminar este ítem?',
                                    'data-method' => 'post',
                                    'title' => 'Borrar',
                        ]);
                    }
                ]
            ]
        ];
        $exportColumns = [
            'id',
            'col1',
            'col2',
            'col3',
            'col4',
            'col5',
            'col6',
            'col7',
            'col8',
            'col9',
            'col10',
            'col11',
            'col12',
            'col13',
            'col14',
            'col15',
            'col16',
            'col17',
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
                            'filename' => "InformeCarteraIntegral_" . date('Y-m-d-H-i-s'),
                            'exportConfig' => $exportConfig,
                            'dropdownOptions' => [
                                'label' => 'Exportar',
                                'class' => 'btn btn-secondary'
                            ]
                        ]
        );
        ?>


        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{toolbar}{items}\n{summary}\n{pager}",
            'columns' => $gridColumns,
            'toolbar' => [
                $fullExportMenu,                
            ],
            'bordered' => true,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'persistResize' => false
        ]);
        ?>
    </div>
</div>
