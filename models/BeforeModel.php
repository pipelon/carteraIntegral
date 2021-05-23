<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * BeforeModel.php
 *
 * // Función encargada de validar el Tenant ID y todos sus métodos Before
 * Adicionalmente guarda las columnas de control 
 *
 * @category  category
 * @package   package
 * @author    Felipe Echeverri <felipe.echeverri@ingeneo.com.co>
 * @copyright 2015 INGENEO S.A.S.
 * @license   http://www.opensource.org/licenses/bsd-license.php BSD License
 * @version   Release: $Id$
 * @link      http://www.ingeneo.com.co
 * 
 */
class BeforeModel extends \yii\db\ActiveRecord {

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'modified',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'modified_by',
                'value' => isset(Yii::$app->user->identity->username) ?
                Yii::$app->user->identity->username :
                '',
            ],
        ];
    }

}
