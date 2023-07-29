<?php

use yii\bootstrap\Html;
use kartik\select2\Select2;
    
$this->title = 'Vista previa notificación';
$this->params['breadcrumbs'][] = $this->title;
$request = Yii::$app->request;

$codCarta = $request->get('codCarta')?$request->get('codCarta'):'NotificacionAutorizacion';

echo Html::Beginform(
    [
        'procesos/vista-previa-notificacion', 'GET',
        'id' => $model->id,
        'tipo' => 'vista'
    ]
);

?>

<div class="liquidaciones-index box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">NOTIFICACIÓN</h3>
        <br />
        <?php
        $tiposCartas = \Yii::$app->params['TiposCartas'];
        echo Html::dropDownList('codCarta', $codCarta, $tiposCartas, 
                array(
                    'class' => 'form-group',
                    'onchange'=>'this.form.submit()'
                ));
        //echo $form->field($model, 'tiposCartas')->dropDownList($tiposCartas, ['prompt' => '- Seleccione un tipo de carta -']);

        ?>
        <?=
        Html::a("<span class='flaticon-list-3'></span> Enviar",
                [
                    "procesos/vista-previa-notificacion", 
                    "id" => $model->id, 
                    "tipo" => "generar", 
                    "codcarta" => $codCarta],
                ["target" => "_blank", "class" => "btn btn-primary pull-right"]);
        ?>
    </div>
    <div class="box-body table-responsive">
        <?=
        \app\components\NotificacionesWidget::widget([
            "tipo" => $tipo,
            "codcarta" => $codCarta,
            "id" => $model->id,
            "juzgado" => $model->jur_juzgado,
            "demandante" => $model->cliente_id,
            "demandado" => $model->deudor_id,
            "radicado" => $model->jur_radicado
        ]);
        ?>
    </div>
</div>

<?php
echo Html::endform();