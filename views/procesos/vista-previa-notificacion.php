<?php

use yii\bootstrap\Html;
    
$this->title = 'Vista previa notificación';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="liquidaciones-index box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">NOTIFICACIÓN</h3>
        <?=
        Html::a("<span class='flaticon-list-3'></span> Enviar",
                ["procesos/vista-previa-notificacion", "id" => $model->id, "tipo" => "generar"],
                ["target" => "_blank", "class" => "btn btn-primary pull-right"]);
        ?>
    </div>
    <div class="box-body table-responsive">
        <?=
        \app\components\NotificacionesWidget::widget([
            "tipo" => $tipo,
            "id" => $model->id,
            "juzgado" => $model->jur_juzgado,
            "demandante" => $model->cliente_id,
            "demandado" => $model->deudor_id,
            "radicado" => $model->jur_radicado
        ]);
        ?>
    </div>
</div>