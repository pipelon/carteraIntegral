<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "procesos_x_colaboradores".
 *
 * @property int $id
 * @property int $proceso_id
 * @property int $user_id
 *
 * @property Procesos $proceso
 * @property Users $user
 */
class ProcesosXColaboradores extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'procesos_x_colaboradores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['proceso_id', 'user_id'], 'required'],
            [['proceso_id', 'user_id'], 'integer'],
            [['proceso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Procesos::className(), 'targetAttribute' => ['proceso_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'proceso_id' => 'Proceso ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Proceso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProceso() {
        return $this->hasOne(Procesos::className(), ['id' => 'proceso_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

}
