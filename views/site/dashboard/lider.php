<!-- PROCESOS EN LOS QUE ERES JEFE -->
<?php
$procesos = app\models\Procesos::find()
        ->select("procesos_x_colaboradores.*, t.*, u.name")
        ->joinWith('procesosXColaboradores')
        ->innerJoin(['t' => 'tareas'], '`t`.`proceso_id` = `procesos`.`id` AND `t`.`user_id` = `procesos_x_colaboradores`.`user_id`')
        ->innerJoin(['u' => 'users'], '`t`.`user_id` = `u`.`id`')
        ->where([
            'procesos.jefe_id' => \Yii::$app->user->getId(),
            't.estado' => 0
        ])
        ->andWhere(['<', 't.fecha_esperada', date('Y-m-d')])
        ->asArray()
        ->all();

$colaboradores = [];
foreach ($procesos as $proceso) {
    $colaboradores[$proceso['user_id']]['nombre']= $proceso['name'];
    $colaboradores[$proceso['user_id']]['procesos'][$proceso['proceso_id']][] = [
        'fecha_esperada' => $proceso['fecha_esperada'],
        'descripcion' => $proceso['descripcion'],
    ];
}
?>
<div class="col-md-12">
    <?php $i = 0; ?>
    <?php foreach ($colaboradores as $colaborador => $procesos) : ?>

        <?php if ($i % 2 == 0) : ?>
            <div class="row">
            <?php endif; ?>
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header">
                        <?= $procesos['nombre']; ?>
                    </div>
                    <div class="box-body infoGeneral">

                        <?php foreach ($procesos['procesos'] as $proceso => $tareas) : ?>
                            <p>
                                <?= \yii\bootstrap\Html::a("Proceso #{$proceso}", ['/procesos/view', 'id' => $proceso]); ?>                                                    
                            </p>
                            <hr />
                            <h4>Tareas</h4>
                            <ul class="todo-list ui-sortable">
                                <?php if (count($tareas) > 0) : ?>
                                    <?php foreach ($tareas as $tarea) : ?>
                                        <li>
                                            <span class="text"><?= "<i class='fa fa-warning text-red'></i> {$tarea['descripcion']}"; ?></span>
                                            <small class="label label-danger"><i class="fa fa-clock-o"></i> <?= $tarea['fecha_esperada']; ?></small>                           
                                        </li>


                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span class="text">Sin tareas</span> 
                                <?php endif; ?>
                            </ul>
                            <br />
                        <?php endforeach; ?>

                    </div>
                    <div class="box-footer clearfix no-border"></div>
                </div>
            </div>
            <?php $i++; ?>
            <?php if ($i % 2 == 0) : ?>
            </div>
        <?php endif; ?>    

    <?php endforeach; ?>
</div>

