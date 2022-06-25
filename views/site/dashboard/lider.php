<!-- TODOS LOS COLABORADORES Y SUS PROCESOS -->
<?php
$tareas = app\models\Tareas::find()
        ->where([
            'jefe_id' => \Yii::$app->user->getId(),
            'estado' => 0
        ])
        ->asArray()
        ->orderBy("proceso_id, user_id, tareas.fecha_esperada ASC")
        ->all();
if(!empty($tareas)) {
$procesos2 = [];
$rowEscrito2 = false;
?>
<div class="row">
    <?php foreach ($tareas as $tarea) : ?>
    
    
    
        <?php if (!in_array($tarea['proceso_id'], $procesos2)) : ?>
            <?php if ($rowEscrito2): ?>
                </div></div></div>
            <?php endif; ?>
            <?php $rowEscrito2 = true; ?>
            <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-body box-tareas-admin">
                    <?php array_push($procesos2, $tarea['proceso_id']); ?>
                    <p>&nbsp;</p>
                    <p>
                        <?= \yii\bootstrap\Html::a("<i class='fa fa- flaticon-list-2'></i> Proceso #{$tarea['proceso_id']}", ['/procesos/view', 'id' => $tarea['proceso_id']]); ?>                                                    
                    </p> 
        <?php endif; ?>
        <!-- SEMAFORO TAREA -->    
        <?php
        $currentDate = new DateTime(date("Y-m-d"));
        $fechaEsperada = new DateTime($tarea['fecha_esperada']);
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
                <span class="info-box-text"><?= $tarea['descripcion']; ?></span>
                <span class="info-box-number"></span>
                <div class="progress">
                    <div class="progress-bar" style="width: 0%"></div>
                </div>
                <span class="progress-description">
                    <?php
                    $colaborador = \app\models\Users::findIdentity($tarea['user_id']);
                    ?>
                    <i class="fa fa-user"></i> <?= $colaborador->name; ?> <i class="fa fa-calendar"></i> <?= $tarea['fecha_esperada']; ?>
                </span>
            </div>
        </div>            
    
        
    <?php endforeach; ?>
        </div></div></div>
</div>
<?php
}