<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "valores_activacion_juridico".
 *
 * @property int $id ID
 * @property float $valor Valor
 * @property string $fecha Fecha
 * @property int $proceso_id Proceso id
 *
 * @property Procesos $proceso
 */
class ValoresActivacionJuridico extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'valores_activacion_juridico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['valor', 'fecha', 'proceso_id'], 'required'],
            [['valor'], 'number'],
            [['fecha'], 'safe'],
            [['proceso_id'], 'integer'],
            [['proceso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Procesos::className(), 'targetAttribute' => ['proceso_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'valor' => 'Valor',
            'fecha' => 'Fecha',
            'proceso_id' => 'Proceso id',
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
