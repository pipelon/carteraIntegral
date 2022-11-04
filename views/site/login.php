<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Acceso';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>

<div class="row">
    <div class="col-md-6 bg-login">
        <div>
            <h1>BIENVENIDO</h1>
            <p>Contamos con una plataforma en la cual puedes <br /> consultar el estado de tu proceso en tiempo real.</p>
        </div>

    </div>
    <div class="col-md-6 login-section">
        <div class="login-box">
            <div class="login-logo">
                <?= \yii\helpers\Html::img('@web/images/ciles.png', ['alt' => 'User Image', 'style' => 'width: 250px']); ?>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">Ingrese sus claves de acceso</p>

                <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

                <?=
                        $form
                        ->field($model, 'username', $fieldOptions1)
                        ->label(false)
                        ->textInput(['placeholder' => $model->getAttributeLabel('username')])
                ?>

                <?=
                        $form
                        ->field($model, 'password', $fieldOptions2)
                        ->label(false)
                        ->passwordInput(['placeholder' => $model->getAttributeLabel('password')])
                ?>

                <div class="row">
                    <div class="col-xs-12">
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <?= Html::submitButton('Acceder', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button','style' => 'background: #26365C; border-color: #26365C;']) ?>
                    </div>
                    <!-- /.col -->
                </div>

                <?php ActiveForm::end(); ?>

            </div>
            <!-- /.login-box-body -->
        </div><!-- /.login-box -->
    </div>
</div>
