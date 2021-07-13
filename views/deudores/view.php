<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Deudores */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Deudores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deudores-view box box-primary">
    <div class="box-header">
        <?php if (\Yii::$app->user->can('/deudores/index') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 20px"></i> ' . 'Volver', ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/deudores/update') || \Yii::$app->user->can('/*')) : ?>        
            <?= Html::a('<i class="flaticon-edit-1" style="font-size: 20px"></i> ' . 'Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?> 
        <?php if (\Yii::$app->user->can('/deudores/delete') || \Yii::$app->user->can('/*')) : ?>        
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
                'nombre',
                'marca',
                'direccion',
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
                    'label' => strtoupper('Codeudor principal'),
                    'value' => '',
                    'contentOptions' => ['class' => 'bg-light-blue'],
                    'captionOptions' => ['class' => 'bg-light-blue'],
                ],
                'nombre_codeudor_1',
                'documento_codeudor_1',
                'direccion_codeudor_1',
                'email_codeudor_1:email',
                'telefono_codeudor_1',
                [
                    'label' => strtoupper('Codeudor #2'),
                    'value' => '',
                    'contentOptions' => ['class' => 'bg-light-blue'],
                    'captionOptions' => ['class' => 'bg-light-blue'],
                ],
                'nombre_codeudor_2',
                'documento_codeudor_2',
                'direccion_codeudor_2',
                'email_codeudor_2:email',
                'telefonol_codeudor_2',
                'comentarios:html',
                'created:date',
                'created_by',
                'modified:date',
                'modified_by',
            ],
        ])
        ?>
    </div>
</div>