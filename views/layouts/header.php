<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

$url = \yii\helpers\Url::to(['alertas/marcaralertas']);
$baseUrl = \Yii::$app->request->BaseUrl;
$script = <<< JS
    $("document").ready(function () {
        
        $("#marcarAlertas").click(function (e) {
            e.preventDefault();
            let idUsuario = $(this).data("usuario");
            let idProceso = $(this).data("proceso");
            $.ajax({
                url: '$url',
                type: 'post',
                async: false,
                data: {
                    idProceso: idProceso,
                    idUsuario: idUsuario
                },
                success: function (data) {
                    location.href = '$baseUrl/procesos/view?id='+idProceso;
                }
            });            
        });        
        
    });
JS;
$this->registerJs($script);
?>
<script>
//    $("document").ready(function () {
//        $("#marcarAlertas").click(function (e) {
//            
//        });
//    });
//    function marcarAlertas(idProceso, idUsuario) {

//    }
</script>

<header class="main-header">

    <?=
    Html::a('<span class="logo-mini">' . \yii\helpers\Html::img('@web/images/logo-cartera-integral-peque.png',
                    [
                        'alt' => 'User Image',
            ]) . '</span><span class="logo-lg">' .
            \yii\helpers\Html::img('@web/images/ciles.png',
                    [
                        'alt' => 'User Image',
                        'style' => 'width: 96px; padding: 0; margin-top: -15px; max-height: none;'
            ])
            . '</span>', \yii\helpers\Url::to(['procesos/index']), ['class' => 'logo'])
    ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                
                <?php if (!Yii::$app->user->identity->isCliente()): ?>

                <li class="dropdown notifications-menu">
                    <!-- CONTAR LAS TAREAS PENDIENTES DEL USUARIO -->
                    <?php
                    $tareas = \app\models\Tareas::find()
                            ->where(['user_id' => Yii::$app->user->identity->id, 'estado' => '0'])
                            ->limit(10)
                            ->all();
                    ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="flaticon-calendar-1"></i>
                        <?php if (count($tareas) >= 1): ?>
                            <span class="label label-warning"><?= count($tareas); ?></span>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">

                            <?php if (count($tareas) >= 1): ?>
                                <?php $plural = count($tareas) > 1 ? "s" : ""; ?>
                                <?= "Tienes " . count($tareas) . " tarea{$plural} pendiente{$plural}"; ?>
                            <?php else: ?>
                                <?= "No tienes tareas pendientes"; ?>
                            <?php endif; ?>
                        </li>
                        <?php if (count($tareas) >= 1): ?>
                            <li>
                                <!-- inner menu: contains the actual data -->

                                <ul class="menu">
                                    <?php foreach ($tareas as $tarea) : ?>
                                        <li>
                                            <?php
                                            $htmlTarea = "<span class='tarea_desc'>{$tarea->descripcion}</span>";
                                            $htmlTarea .= "<span class='label label-warning' style='float: right'>";
                                            $htmlTarea .= "<i class='flaticon-calendar-1'></i> {$tarea->fecha_esperada}";
                                            $htmlTarea .= "</span>";
                                            echo \yii\bootstrap\Html::a($htmlTarea,
                                                    ['/procesos/view', 'id' => $tarea['proceso_id']]);
                                            ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <li class="dropdown notifications-menu">

                    <?php
                    $alertas = \app\models\Alertas::find()
                            ->where(['usuario_id' => Yii::$app->user->identity->id, 'visto' => 0])
                            ->orderBy(['created' => SORT_DESC])
                            ->limit(10)
                            ->all();
                    ?>

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="flaticon-bell"></i>
                        <?php if (count($alertas) >= 1): ?>
                            <span class="label label-warning"><?= count($alertas); ?></span>
                        <?php endif; ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">

                            <?php if (count($alertas) >= 1): ?>
                                <?php $plural = count($alertas) > 1 ? "s" : ""; ?>
                                <?= "Tienes " . count($alertas) . " alerta{$plural} pendiente{$plural}"; ?>
                            <?php else: ?>
                                <?= "No tienes alertas pendientes"; ?>
                            <?php endif; ?>
                        </li>
                        <?php if (count($alertas) >= 1): ?>
                            <li>

                                <ul class="menu">
                                    <?php foreach ($alertas as $alerta) : ?>
                                        <li>
                                            <?php
                                            $htmlTarea = "<i class='fa fa-warning text-yellow'></i> {$alerta->descripcion_alerta}";
                                            echo \yii\bootstrap\Html::a($htmlTarea,
                                                    [
                                                        '/procesos/view', 'id' => $alerta->proceso_id],
                                                    [
                                                        //'onclick' => "marcarAlertas({$alerta->proceso_id},{$alerta->usuario_id});"
                                                        'data-proceso' => $alerta->proceso_id,
                                                        'data-usuario' => $alerta->usuario_id,
                                                        'id' => 'marcarAlertas'
                                                    ]
                                            );
                                            ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <!--<li class="footer"><a href="#">Ver todo...</a></li>-->
                        <?php endif; ?>
                    </ul>
                </li>

                <?php endif; ?>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php
                        $profileImage = Yii::$app->user->identity->profileImage && file_exists("perfiles/" . Yii::$app->user->identity->profileImage) ?
                                Yii::$app->user->identity->profileImage : "default-user.png";
                        ?>
                        <?=
                        Html::img("@web/perfiles/{$profileImage}",
                                [
                                    'alt' => 'User Image',
                                    'class' => 'user-image'
                        ])
                        ?>                        
                        <span class="hidden-xs"><?= Yii::$app->user->identity->fullName; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?=
                            Html::img("@web/perfiles/{$profileImage}",
                                    [
                                        'alt' => 'User Image',
                                        'class' => 'img-circle'
                            ])
                            ?>
                            <p>
                                <?php
                                $date = new DateTime(Yii::$app->user->identity->created);
                                ?>
                                <small>
                                    Rol: 
                                    <b>
                                        <?php
                                        if (!Yii::$app->user->isGuest) {
                                            $roles = implode(", ", array_keys(Yii::$app->user->identity->getRoles()));
                                            echo trim(strtolower(preg_replace("/[A-Z]/", ' $0', $roles)));
                                        }
                                        ?>
                                    </b>
                                </small>
                                <small>Creado el <?= $date->format('d \d\e\l m \d\e Y'); ?></small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?=
                                Html::a(
                                        '<i class="flaticon-users"></i> Perfil',
                                        ['/users/view', 'id' => Yii::$app->user->identity->id],
                                        ['class' => 'btn btn-default']
                                )
                                ?>
                            </div>
                            <div class="pull-right">
                                <?=
                                Html::a(
                                        '<i class="flaticon-logout"></i> Salir',
                                        ['/site/logout'],
                                        ['data-method' => 'post', 'class' => 'btn btn-default']
                                )
                                ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
