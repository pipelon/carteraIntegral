<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeudoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Deudores';
$this->params['breadcrumbs'][] = $this->title;

$template = '';
if (\Yii::$app->user->can('/deudores/view')) {
    $template .= '{view} ';
}
if (\Yii::$app->user->can('/deudores/update')) {
    $template .= '{update} ';
}
if (\Yii::$app->user->can('/deudores/delete')) {
    $template .= '{delete} ';
}
if (\Yii::$app->user->can('/deudores/*') || \Yii::$app->user->can('/*')) {
    $template = '{view}  {update}  {delete}';
}
?>
<div class="deudores-index box box-primary">
    <div class="box-header with-border">
    <?php  if (\Yii::$app->user->can('/deudores/create') || \Yii::$app->user->can('/*')) :  ?> 
        <?= Html::a('<i class="flaticon-add" ></i> '.'Crear Deudor', ['create'], ['class' => 'btn btn-primary']) ?>
    <?php  endif;  ?> 
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'tableOptions'=>['class'=>'table table-striped table-bordered table-condensed'],
            'columns' => [
                'nombre',
                'marca',
                'direccion',
                // 'telefono_persona_contacto_1',
                // 'email_persona_contacto_1:email',
                // 'cargo_persona_contacto_1',
                // 'nombre_persona_contacto_2',
                // 'telefono_persona_contacto_2',
                // 'email_persona_contacto_2:email',
                // 'cargo_persona_contacto_2',
                // 'nombre_persona_contacto_3',
                // 'telefono_persona_contacto_3',
                // 'email_persona_contacto_3:email',
                // 'cargo_persona_contacto_3',
                // 'nombre_codeudor_1',
                // 'documento_codeudor_1',
                // 'direccion_codeudor_1',
                // 'email_codeudor_1:email',
                // 'telefono_codeudor_1',
                // 'nombre_codeudor_2',
                // 'documento_codeudor_2',
                // 'direccion_codeudor_2',
                // 'email_codeudor_2:email',
                // 'telefonol_codeudor_2',
                // 'comentarios:ntext',
                // 'created',
                // 'created_by',
                // 'modified',
                // 'modified_by',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => $template,
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<span class="flaticon-search-magnifier-interface-symbol" ></span>', $url, [
                                        'title' => 'Ver',
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<span class="flaticon-edit-1 text-green" ></span>', $url, [
                                        'title' => 'Editar',
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="flaticon-circle text-red" ></span>', $url, [
                                        'data-confirm' => '¿Está seguro que desea eliminar este ítem?',
					'data-method' => 'post',
                                        'title' => 'Borrar',
                            ]);
                        }
                    ]
                ],
            ],
        ]); ?>
    </div>
</div>
