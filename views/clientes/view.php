<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-view box box-primary">
    <div class="box-header">
        <?php if (\Yii::$app->user->can('/clientes/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 15px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/clientes/update') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 15px"></i> ' . 'Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/clientes/delete') || \Yii::$app->user->can('/*')) : ?>        
            <?=
            Html::a('<i class="flaticon-circle" style="font-size: 15px"></i> ' . 'Borrar', ['delete', 'id' => $model->id], [
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
                'nombre',
                [
                    'attribute' => 'tipo_documento',
                    'format' => 'raw',
                    'value' => function ($data) {
                        return Yii::$app->utils->filtroTipoDocumento($data->tipo_documento);
                    },
                ],
                'documento',
                'direccion',
                [
                    'label' => strtoupper('Representante legal'),
                    'value' => '',
                    'contentOptions' => ['class' => 'bg-light-blue'],
                    'captionOptions' => ['class' => 'bg-light-blue'],
                ],
                'nombre_representante_legal',
                'telefono_representante_legal',
                'email_representante_legal:email',
                [
                    'label' => strtoupper('Persona de contacto principal'),
                    'value' => '',
                    'contentOptions' => ['class' => 'bg-light-blue'],
                    'captionOptions' => ['class' => 'bg-light-blue'],
                ],
                'nombre_persona_contacto_1',
                'telefono_persona_contacto_1',
                'email_persona_contacto_1:email',
                'cargo_persona_contacto_1',
                [
                    'label' => strtoupper('Persona de contacto #2'),
                    'value' => '',
                    'contentOptions' => ['class' => 'bg-light-blue'],
                    'captionOptions' => ['class' => 'bg-light-blue'],
                ],
                'nombre_persona_contacto_2',
                'telefono_persona_contacto_2',
                'email_persona_contacto_2:email',
                'cargo_persona_contacto_2',
                [
                    'label' => strtoupper('Persona de contacto #3'),
                    'value' => '',
                    'contentOptions' => ['class' => 'bg-light-blue'],
                    'captionOptions' => ['class' => 'bg-light-blue'],
                ],
                'nombre_persona_contacto_3',
                'telefono_persona_contacto_3',
                'email_persona_contacto_3:email',
                'cargo_persona_contacto_3',
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
                        $url = 'https://drive.google.com/open?id=' . $data->carpeta;
                        return Html::a($url, $url, ['target' => '_blank']);
                    },
                ],
                'created:datetime',
                'created_by',
                'modified:datetime',
                'modified_by',
            ],
        ])
        ?>
    </div>
</div>
