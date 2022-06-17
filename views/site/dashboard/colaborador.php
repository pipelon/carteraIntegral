<?php
/**
 * PROCESOS POR COLABORADOR CON TODAS SUS TAREAS
 */
$procesos = app\models\Procesos::find()
        ->joinWith('procesosXColaboradores')
        ->where([
            'user_id' => \Yii::$app->user->getId()
        ])
        ->orderBy(['id' => SORT_DESC])
        ->all();
?>
<div class="col-md-12">
    <?php $i = 0; ?>
    <?php foreach ($procesos as $proceso) : ?>
        <?php if ($i % 2 == 0) : ?>
            <div class="row">
            <?php endif; ?>
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-body infoGeneral">
                        <p>
                            <?= \yii\bootstrap\Html::a("Proceso #{$proceso['id']}", ['/procesos/view', 'id' => $proceso['id']]); ?>
                            <br /><br />
                            <?= $proceso->cliente->nombre ?>
                            <br />
                            <b><?= Yii::$app->utils->filtroTipoDocumento($proceso->cliente->tipo_documento); ?>: </b>
                            <?= $proceso->cliente->documento; ?>
                            <br />
                            <i class="fa fa-map-marker" style="color: #000;"></i> <?= $proceso->cliente->direccion; ?>                                
                        </p>
                        <hr />
                        <h4>Tareas</h4>
                        <ul class="todo-list ui-sortable">
                            <?php if (count($proceso->tareas) > 0) : ?>
                                <?php foreach ($proceso->tareas as $tarea) : ?>
                                    <?php
                                    /*
                                     * Calcular tareas pronto a vencer para semaforo
                                     */
                                    $currentDate = new DateTime(date("Y-m-d"));
                                    $fechaEsperada = new DateTime($tarea->fecha_esperada);
                                    $diff = $currentDate->diff($fechaEsperada);

                                    switch (true) {
                                        case $diff->invert == 0 && $diff->days > 3:
                                            $semaforoIcon = "fa-check-square-o text-green";
                                            $semaforoLabel = "label-success";
                                            break;
                                        case $diff->invert == 0 && $diff->days <= 3 && $diff->days >= 0:
                                            $semaforoIcon = "fa-warning text-yellow";
                                            $semaforoLabel = "label-warning";
                                            break;
                                        case $diff->invert == 1:
                                            $semaforoIcon = "fa-warning text-red";
                                            $semaforoLabel = "label-danger";
                                            break;
                                        default:
                                            $semaforoIcon = "fa-check-square-o text-green";
                                            $semaforoLabel = "label-success";
                                            break;
                                    }
                                    ?>
                                    <li>
                                        <span class="text"><?= "<i class='fa {$semaforoIcon}'></i> {$tarea->descripcion}"; ?></span>
                                        <small class="label <?= $semaforoLabel; ?>"><i class="fa fa-clock-o"></i> <?= $tarea->fecha_esperada; ?></small>                           
                                    </li>

                                <?php endforeach; ?>
                            <?php else: ?>
                                <span class="text">Sin tareas</span> 
                            <?php endif; ?>
                        </ul>

                    </div>
                    <div class="box-footer clearfix no-border">
                        <?= \yii\bootstrap\Html::a("<i class='flaticon-edit'></i> Editar proceso", ['/procesos/update', 'id' => $proceso['id']], ['class' => 'btn btn-default pull-right']); ?>

                    </div>
                </div>

            </div>
                <?php $i++; ?>
            <?php if ($i % 2 == 0) : ?>
            </div>
        <?php endif; ?>

        

    <?php endforeach; ?>
</div>


