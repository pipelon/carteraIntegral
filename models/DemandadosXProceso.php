<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "demandados_x_proceso".
 *
 * @property int $id ID
 * @property int $proceso_id Proceso ID
 * @property string $demandado_id Demandado
 * @property string $nombre Nombre
 *
 * @property Procesos $proceso
 */
class DemandadosXProceso extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'demandados_x_proceso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['proceso_id', 'demandado_id', 'nombre'], 'required'],
            [['proceso_id'], 'integer'],
            [['demandado_id'], 'string', 'max' => 100],
            [['nombre'], 'string', 'max' => 255],
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
            'demandado_id' => 'Demandado',
            'nombre' => 'Nombre',
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

}
