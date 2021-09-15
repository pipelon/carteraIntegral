<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

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
            . '</span>', Yii::$app->homeUrl, ['class' => 'logo'])
    ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Tienes 10 notificaciones</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 procesos ingresaron hoy
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-warning text-yellow"></i> Algunos procesos están atrasados
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-user text-red"></i> Juan Carlos actualizó el proceso XXXX
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">Ver todo...</a></li>
                    </ul>
                </li>
                

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
