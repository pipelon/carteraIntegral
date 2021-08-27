<?php
/* @var $this yii\web\View */

$this->title = 'CILES';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            
            <!-- PROCESOS EN GESTION -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="flaticon-list-3"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="white-space: normal">Procesos en gestión</span>
                        <span class="info-box-number">80<small>%</small></span>
                    </div>
                </div>
            </div>
            <!-- PROCESOS TERMINADOS -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="flaticon-interface"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="white-space: normal">Procesos terminados</span>
                        <span class="info-box-number">15<small>%</small></span>
                    </div>
                </div>
            </div>
            <!-- PROCESOS CATIGADOS -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="flaticon-danger"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="white-space: normal">Procesos castigados</span>
                        <span class="info-box-number">5<small>%</small></span>
                    </div>
                </div>
            </div>
            <!-- PROCESOS DEVUELTOS -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-orange"><i class="flaticon-close"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text" style="white-space: normal">Procesos devueltos</span>
                        <span class="info-box-number">0<small>%</small></span>
                    </div>
                </div>
            </div>

            <!-- SI ERES COLABORADO -->
            <?php if (Yii::$app->user->identity->isColaborador()): ?>
                <?= $this->render('dashboard/colaborador.php'); ?>                
            <?php endif; ?>

            <!-- SI ERES JEFE -->
            <?php if (Yii::$app->user->identity->isJefe()): ?>
                <?= $this->render('dashboard/jefe.php'); ?>
            <?php endif; ?>

            <!-- SI ERES SUPER ADMINISTRADOR -->
            <?php if (Yii::$app->user->identity->isSuperAdmin()): ?>
                <?= $this->render('dashboard/administrador.php'); ?>
            <?php endif; ?>  
            
            <!-- SI ERES CLIENTE -->
            <?php if (Yii::$app->user->identity->isCliente()): ?>
                <?= $this->render('dashboard/cliente.php'); ?>
            <?php endif; ?>  

        </div>

    </div>
</div>
