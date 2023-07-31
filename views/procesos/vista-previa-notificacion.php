<?php

use yii\bootstrap\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
    
$this->title = 'Vista previa notificación';
$this->params['breadcrumbs'][] = $this->title;
$request = Yii::$app->request;
$codCarta = isset($request->bodyParams['codCarta'])?$request->bodyParams['codCarta']:"NotificacionAutorizacion";
$tipo = isset($request->bodyParams['tipo'])?$request->bodyParams['tipo']:"vista";

//$codCarta = $request->get('codCarta')?$request->get('codCarta'):'NotificacionAutorizacion';

echo Html::Beginform(
    [
        'procesos/vista-previa-notificacion', 
        'id' => $model->id], 
        'post', 
        ['enctype' => 'multipart/form-data']
    );

?>

<div class="box box-primary">    
        <div class="box-footer">
                <?= 
                Html::hiddenInput('tipo', $tipo);              
                ?>
                <?php
                //$email ='';
                //return Html::mailto('Kontaktaufnahme mit: ' . $email,$email, ['subject' => 'Hi There']);
                /* $options = [
                    "class" => "btn btn-primary",
                            'subject' => $codCarta,
                            'cc' => 'pipe.echeverry.1@gmail.com',
                            'attachment' => 'C:\wamp\www\carteraIntegral\web\pdfs\NotificacionAutorizacionDEUDOR PARA HACER PRUEBAS30-07-2023.pdf'
                            ];
                
                echo Html::mailto("<span class='flaticon-list-3 btn btn-primary'></span> Abrir correo",'dcastanom@gmail.com',$options); */
                ?>

                <?=
                        Html::a("<span class='flaticon-list-3'></span> Generar",
                                ["procesos/generar-notificacion", "id" => $model->id, "tipo" => "generar", "codcarta" => $codCarta],
                                ["target" => "_blank", "class" => "btn btn-primary"]);
                        ?>
                        <?=
                        Html::a("<span class='flaticon-list-3'></span> Enviar",
                                ["procesos/generar-notificacion", "id" => $model->id, "tipo" => "enviar","codcarta" => $codCarta],
                                ["target" => "_blank", "class" => "btn btn-primary"]);
                        ?>
                <?=
                Url::remember(['procesos/update', 'id' => $model->id]);
                ?>
            <?php if (\Yii::$app->user->can('/procesos/update') || \Yii::$app->user->can('/*')) : ?>        
                <?= Html::a('<i class="flaticon-up-arrow-1" style="font-size: 15px"></i> ' . 'Volver', Url::previous(), ['class' => 'btn btn-default pull-right']) ?>
            <?php endif; ?> 
        </div>
</div>

<div class="row">

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">TIPO DE CARTA</h3>
            </div>
            <div class="box-body">
                <?php
                $tiposCartas = \Yii::$app->params['TiposCartas'];
                echo Html::dropDownList('codCarta', $codCarta, $tiposCartas, 
                array(
                    'class' => 'form-control col-md-6',
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
        if ($tipo == 'generar'){
            //primero lo genera y luego lo envia
            \app\components\NotificacionesWidget::widget([
                "tipo" => 'generar',
                "codcarta" => $codCarta,
                "id" => $model->id,
                "juzgado" => $model->jur_juzgado,
                "demandante" => $model->cliente->nombre,
                "demandado" => $model->deudor->nombre,
                "radicado" => $model->jur_radicado
            ]);
            // y luego lo envia
            \app\components\NotificacionesWidget::widget([
                "tipo" => 'enviar',
                "codcarta" => $codCarta,
                "id" => $model->id,
                "juzgado" => $model->jur_juzgado,
                "demandante" => $model->cliente->nombre,
                "demandado" => $model->deudor->nombre,
                "radicado" => $model->jur_radicado
            ]);

        }elseif ($tipo == 'descargar'){
            \app\components\NotificacionesWidget::widget([
                "tipo" => 'descargar',
                "codcarta" => $codCarta,
                "id" => $model->id,
                "juzgado" => $model->jur_juzgado,
                "demandante" => $model->cliente->nombre,
                "demandado" => $model->deudor->nombre,
                "radicado" => $model->jur_radicado
            ]);
        }

        ?>
        <?=
        \app\components\NotificacionesWidget::widget([
            "tipo" => 'vista',
            "codcarta" => $codCarta,
            "id" => $model->id,
            "juzgado" => $model->jur_juzgado,
            "demandante" => $model->cliente->nombre,
            "demandado" => $model->deudor->nombre,
            "radicado" => $model->jur_radicado
        ]);
        ?>
    </div>
</div>

<?php
echo Html::endform();