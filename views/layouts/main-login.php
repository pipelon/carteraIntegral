<?php

use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style type="text/css">
            .login-page{
                background: #FFFFFF
            }
            .bg-login{
                background: #26365C; 
                height: 100vh; 
                background-image: url('../../web/images/bg-login.jpg');
                display: flex;
                align-items: center;
                justify-content: center;
                background-size: cover;
                background-repeat: no-repeat;
            }
            .bg-login h1, .bg-login p {
                color: #FFFFFF;
                width: 100%;
                text-align: center;
            }
            .login-section{
                height: 100vh;
            }
            .login-section input#loginform-username,
            .login-section input#loginform-password {
                border-left: 5px solid #26365C;
                background: #F9FAFC;
            }
            .login-box-msg{
                color: #26365C;
                font-weight: bold;
                font-size: 18px;
            }
            @media(max-width:767px) {
                .bg-login{
                    display: none;
                }
            }
        </style>
    </head>
    <body class="login-page">

        <?php $this->beginBody() ?>

        <?= $content ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
