<!-- PROCESOS EN LOS QUE ERES COLABORADO -->
<?php
$procesos = app\models\Procesos::find()
        ->joinWith('procesosXColaboradores')
        ->joinWith('cliente')
        ->joinWith('deudor')
        ->joinWith('estadoProceso')
        ->where([
            'user_id' => \Yii::$app->user->getId()
        ])
        ->asArray()
        ->all();
?>
<?php if (!empty($procesos)) : ?>
    <div class = "col-md-5">
        <div class = "box box-primary">
            <div class = "box-header with-border">
                <h3 class = "box-title">Procesos en los que eres colaborador</h3>
                <div class = "box-tools pull-right">
                    <button type = "button" class = "btn btn-box-tool" data-widget = "collapse"><i class = "fa fa-minus"></i>
                    </button>
                    <button type = "button" class = "btn btn-box-tool" data-widget = "remove"><i class = "fa fa-times"></i></button>
                </div>
            </div>
            <!--/.box-header -->
            <div class = "box-body">
                <div class = "table-responsive">
                    <table class = "table no-margin">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Deudor</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($procesos as $proceso) : ?>
                                <tr>
                                    <td><?= \yii\bootstrap\Html::a("{$proceso['id']}", ['/procesos/view', 'id' => $proceso['id']]); ?></td>
                                    <td><?= $proceso["cliente"]["nombre"]; ?></td>
                                    <td><?= $proceso["deudor"]["nombre"]; ?></td>
                                    <td>
                                        <?php
                                        switch ($proceso["estado_proceso_id"]) {
                                            case "1":
                                                $labelEstado = 'warning';
                                                break;
                                            case "2":
                                            case "3":
                                                $labelEstado = 'danger';
                                                break;
                                            default:
                                                $labelEstado = 'success';
                                        }
                                        ?>
                                        <span class="label label-<?= $labelEstado; ?>">
                                            <?= $proceso["estadoProceso"]["nombre"]; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!--/.table-responsive -->
            </div>
            <!--/.box-body -->
            <div class = "box-footer clearfix">
                <?php if (\Yii::$app->user->can('/procesos/index') || \Yii::$app->user->can('/*')): ?>
                    <?= \yii\bootstrap\Html::a('Ver todos los procesos', ['/procesos/index'], ['class' => 'btn btn-sm btn-primary btn-flat pull-right']); ?>
                <?php endif; ?>
            </div>
            <!--/.box-footer -->
        </div>
    </div>
<?php endif; ?>
<!-- TAREAS ASIGNADAS AL USUARIO -->
<?php
$tareas = app\models\Tareas::find()
        ->joinWith('jefe')
        ->joinWith('user')
        ->where([
            'user_id' => \Yii::$app->user->getId()
        ])
        ->asArray()
        ->all();
?>
<?php if (!empty($tareas)) : ?>
    <div class = "col-md-7">
        <div class = "box box-primary">
            <div class = "box-header with-border">
                <h3 class = "box-title">Tareas asignadas a ti</h3>
                <div class = "box-tools pull-right">
                    <button type = "button" class = "btn btn-box-tool" data-widget = "collapse"><i class = "fa fa-minus"></i>
                    </button>
                    <button type = "button" class = "btn btn-box-tool" data-widget = "remove"><i class = "fa fa-times"></i></button>
                </div>
            </div>
            <!--/.box-header -->
            <div class = "box-body">
                <div class = "table-responsive">
                    <table class = "table no-margin">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Líder</th>
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tareas as $tarea) : ?>
                                <tr>
                                    <td><?= \yii\bootstrap\Html::a("{$tarea['proceso_id']}", ['/procesos/view', 'id' => $tarea['proceso_id']]); ?></td>
                                    <td><?= $tarea["jefe"]["name"]; ?></td>
                                    <td><?= $tarea["fecha_esperada"]; ?></td>
                                    <td><?= $tarea["descripcion"]; ?></td>
                                    <td>
                                        <?php
                                        if ($tarea["estado"] == '0') {
                                            $labelEstado = 'warning';
                                            $estadoTarea = 'pendiente';
                                        } else {
                                            $labelEstado = 'success';
                                            $estadoTarea = 'finalziada';
                                        }
                                        ?>

                                        <span class="label label-<?= $labelEstado; ?>">
                                            <?= $estadoTarea; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!--/.table-responsive -->
            </div>
        </div>
    </div>
<?php endif; ?>