<!-- TODOS LOS CLIENTES TODOS SUS PROCESOS Y TODOS SUS COLABORADORES -->
<?php
$tareasXClientes = app\models\Clientes::find()
        ->select(["clientes.id", "clientes.nombre", "tareas.*"])
        ->joinWith('procesos', true, 'INNER JOIN')
        ->innerJoin('tareas', 'tareas.proceso_id = procesos.id')
        ->where([
            'tareas.estado' => 0
        ])
        ->asArray()
        ->orderBy("clientes.nombre, tareas.proceso_id, user_id, tareas.fecha_esperada ASC")
        ->all();

if(!empty($tareasXClientes)) {
$clienteNombre = $procesos = [];
$rowEscrito = false;
?>


<div class="row">
    <?php foreach ($tareasXClientes as $tareaXCliente) : ?>

        <?php if (!in_array($tareaXCliente['nombre'], $clienteNombre)) : ?>
            <?php if ($rowEscrito): ?>
            </div></div></div>
        <?php endif; ?>
        <?php $rowEscrito = true; ?>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body box-tareas-admin">
                    <?php array_push($clienteNombre, $tareaXCliente['nombre']); ?>
                    <h4><?= $tareaXCliente['nombre']; ?></h4>
                <?php endif; ?>

                <?php if (!in_array($tareaXCliente['proceso_id'], $procesos)) : ?>
                    <?php array_push($procesos, $tareaXCliente['proceso_id']); ?>
                    <p>&nbsp;</p>
                    <p>
                        <?= \yii\bootstrap\Html::a("<i class='fa fa- flaticon-list-2'></i> Proceso #{$tareaXCliente['proceso_id']}", ['/procesos/view', 'id' => $tareaXCliente['proceso_id']]); ?>                                                    
                    </p>                    
                <?php endif; ?>       

                <!-- SEMAFORO TAREA -->    
                <?php
                $currentDate = new DateTime(date("Y-m-d"));
                $fechaEsperada = new DateTime($tareaXCliente['fecha_esperada']);
                $diff = $currentDate->diff($fechaEsperada);
                switch (true) {
                    case $diff->invert == 0 && $diff->days > 3:
                        $semaforoIcon = "fa-check-square-o";
                        $semaforoBg = "bg-green";
                        $semaforoLabel = "label-success";
                        break;
                    case $diff->invert == 0 && $diff->days <= 3 && $diff->days >= 0:
                        $semaforoIcon = "fa-warning";
                        $semaforoBg = "bg-yellow";
                        $semaforoLabel = "label-warning";
                        break;
                    case $diff->invert == 1:
                        $semaforoIcon = "fa-warning";
                        $semaforoBg = "bg-red";
                        $semaforoLabel = "label-danger";
                        break;
                    default:
                        $semaforoIcon = "fa-check-square-o";
                        $semaforoBg = "bg-green";
                        $semaforoLabel = "label-success";
                        break;
                }
                ?>

                <div class="info-box <?= $semaforoBg; ?>">
                    <span class="info-box-icon"><i class="fa <?= $semaforoIcon; ?>"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text"><?= $tareaXCliente['descripcion']; ?></span>
                        <span class="info-box-number"></span>
                        <div class="progress">
                            <div class="progress-bar" style="width: 0%"></div>
                        </div>
                        <span class="progress-description">
                            <?php
                            $colaborador = \app\models\Users::findIdentity($tareaXCliente['user_id']);
                            ?>
                            <i class="fa fa-user"></i> <?= $colaborador->name; ?> <i class="fa fa-calendar"></i> <?= $tareaXCliente['fecha_esperada']; ?>
                        </span>
                    </div>
                </div>


            <?php endforeach; ?>

        </div></div></div>
</div>
<?php 
}