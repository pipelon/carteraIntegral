<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CalendarAsset extends AssetBundle {

    public $sourcePath = '@vendor/almasaeed2010/adminlte/bower_components';
    public $css = [
        'fullcalendar/dist/fullcalendar.min.css',
        'Ionicons/css/ionicons.min.css'
    ];
    public $js = [
        'moment/moment.js',
        'fullcalendar/dist/fullcalendar.min.js',
        'fullcalendar/dist/locale/es.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
