<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "docactivacion_x_proceso".
 *
 * @property int $id ID
 * @property int $proceso_id
 * @property int $documento_activacion_id
 *
 * @property DocumentosActivacion $documentoActivacion
 * @property Procesos $proceso
 */
class DocactivacionXProceso extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'docactivacion_x_proceso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['proceso_id', 'documento_activacion_id'], 'required'],
            [['proceso_id', 'documento_activacion_id'], 'integer'],
            [['documento_activacion_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentosActivacion::className(), 'targetAttribute' => ['documento_activacion_id' => 'id']],
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
            'documento_activacion_id' => 'Documento Activacion ID',
        ];
    }

    /**
     * Gets query for [[DocumentoActivacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentoActivacion() {
        return $this->hasOne(DocumentosActivacion::className(), ['id' => 'documento_activacion_id']);
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
