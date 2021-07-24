<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bienes_x_proceso".
 *
 * @property int $id ID
 * @property int $proceso_id Proceso ID
 * @property int $bien_id Bien ID
 * @property string|null $comentario
 *
 * @property Bienes $bien
 * @property Procesos $proceso
 */
class BienesXProceso extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'bienes_x_proceso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['proceso_id', 'bien_id'], 'required'],
            [['proceso_id', 'bien_id'], 'integer'],
            [['comentario'], 'string'],
            [['bien_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bienes::className(), 'targetAttribute' => ['bien_id' => 'id']],
            [['proceso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Procesos::className(), 'targetAttribute' => ['proceso_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'proceso_id' => 'Proceso ID',
            'bien_id' => 'Bien ID',
            'comentario' => 'Comentario',
        ];
    }

    /**
     * Gets query for [[Bien]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBien() {
        return $this->hasOne(Bienes::className(), ['id' => 'bien_id']);
    }

    /**
     * Gets query for [[Proceso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProceso() {
        return $this->hasOne(Procesos::className(), ['id' => 'proceso_id']);
    }

}
