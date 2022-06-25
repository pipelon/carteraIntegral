<?php
/* @var $this yii\web\View */

$this->title = 'CILES';
?>
<div class="site-index">

    <div class="body-content">

        <!-- SI ERES SUPER ADMINISTRADOR -->
        <?php if (Yii::$app->user->identity->isSuperAdmin()): ?>
            <?= $this->render('dashboard/administrador.php'); ?>
        <?php endif; ?>

        <!-- SI ERES JEFE -->
        <?php if (Yii::$app->user->identity->isLider()): ?>
            <?= $this->render('dashboard/lider.php'); ?>
        <?php endif; ?>

        <!-- SI ERES COLABORADO -->
        <?php if (Yii::$app->user->identity->isColaborador()): ?>
            <?= $this->render('dashboard/colaborador.php'); ?>                
        <?php endif; ?>

        <!-- SI ERES CLIENTE -->
        <?php if (Yii::$app->user->identity->isCliente()): ?>
            <?= $this->render('dashboard/cliente.php'); ?>
        <?php endif; ?>  

    </div>
</div>
