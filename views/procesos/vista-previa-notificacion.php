<?php

use yii\bootstrap\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
    
$this->title = 'Vista previa notificación';
$this->params['breadcrumbs'][] = $this->title;
$request = Yii::$app->request;
//esto es para el cambio del dropdown codcarta, el cual hace que la pagina se recargue y asigne el codcarta
$codcarta = isset($request->get()['codcarta'])?$request->get()['codcarta']:"Autorizacion";
//el tipo no se ajusta ya que siempre viene del controlador y no se cambia dinamicamente como el dropdown


echo Html::Beginform(
    [
        'procesos/vista-previa-notificacion', 
        'id' => $model->id], 
        'get', 
        ['enctype' => 'multipart/form-data']
    );

?>

<div class="box box-primary">    
        <div class="box-footer">
                <?= 
                Html::hiddenInput('tipo', $tipo);              
                ?>
                <?php

                // mostrar una laerta cuando falten valores para la carta

                if ((!isset($model->jur_juzgado, $model->cliente->nombre, $model->deudor->nombre, $model->jur_radicado)) 
                || empty($model->jur_radicado) || empty($model->deudor->nombre) || empty($model->cliente->nombre) || empty($model->jur_juzgado)): ?>
                <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?="Faltan valores para la carta"?>
                        </div>
                <?php else: ?> 

                <?=
                        Html::a("<span class='flaticon-list-3'></span> Generar",
                                ["procesos/generar-notificacion", "id" => $model->id, "tipo" => "generar", "codcarta" => $codcarta],
                                ["target" => "_blank", "class" => "btn btn-primary"]);
                        ?>
                        <?php
                        /*Html::a("<span class='flaticon-list-3'></span> Enviar",
                                ["procesos/vista-previa-notificacion", "id" => $model->id, "tipo" => "enviar", "codcarta" => $codcarta],
                                ["class" => "btn btn-primary"]);*/
                        ?>
                        <?=
                            Html::a("<span class='flaticon-list-3'></span> Enviar",
                                    'javascript:void(0)',
                                    [
                                        'title' => 'emails',
                                        'class' => 'btn btn-primary',
                                        'onclick' => "                                    
                                                $.ajax({
                                                        type    :'POST',
                                                        cache   : false,
                                                        url     : '" . Url::to(['view-enviar-memorial', 'id' => $model->id,"codcarta" => $codcarta]) . "',
                                                        success : function(response) {
                                                                $('#ajax_enviar_memorial').html(response);
                                                        }
                                                });
                                                return false;",
                                    ]
                            );
                            ?>
                <?php endif; ?>   
                <?=
                Url::remember(['procesos/update', 'id' => $model->id]);
                ?>
            <?php if (\Yii::$app->user->can('/procesos/update') || \Yii::$app->user->can('/*')) : ?>        
                <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 15px"></i> ' . 'Volver', Url::previous(), ['class' => 'btn btn-default pull-right']) ?>
            <?php endif; ?> 
        </div>
</div>

<div class="row">

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">TIPO DE CARTA</h3>
            </div>
            <div class="box-body">
                <?php
                $tiposCartas = \Yii::$app->params['TiposCartas'];
                echo Html::dropDownList('codcarta', $codcarta, $tiposCartas, 
                array(
                    'class' => 'form-control col-md-3',
                    'onchange'=>"this.form.tipo.value='vista'; this.form.submit()"
                 ));
                ?>        
            </div>
        </div>
    </div>
</div>

<div class="liquidaciones-index box box-primary">

    <div class="box-body table-responsive">
        
        <?php
        if ($tipo =='enviar-email'):
            $out = \app\components\NotificacionesWidget::widget([
                "tipo" => $tipo,
                "codcarta" => $codcarta,
                "id" => $model->id,
                "juzgado" => $model->jur_juzgado,
                "demandante" => $model->cliente->nombre,
                "demandado" => $model->deudor->nombre." - ".$model->deudor->marca,
                "radicado" => $model->jur_radicado
            ]);

            if ($out == 'El correo se envió'):
         ?>        
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?= $out ?>
                </div>
            <?php elseif(str_contains($out, 'El correo no se envió. Error:')): ?>
                <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?= $out ?>
                </div>        
            <?php endif; ?>
        <?php endif; ?>
        <?=
       \app\components\NotificacionesWidget::widget([
            "tipo" => 'vista',
            "codcarta" => $codcarta,
            "id" => $model->id,
            "juzgado" => $model->jur_juzgado,
            "demandante" => $model->cliente->nombre,
            "demandado" => $model->deudor->nombre." - ".$model->deudor->marca,
            "radicado" => $model->jur_radicado
        ]);
        ?>
        
    </div>
</div>

<?php
echo Html::endform();
?>
<!-- MODALES -->

<?= Html::tag('div', '', ['id' => 'ajax_enviar_memorial']); ?>

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