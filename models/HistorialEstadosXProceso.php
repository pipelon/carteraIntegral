<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "historial_estados_x_proceso".
 *
 * @property int $id Identificador del estado por proceso
 * @property int $proceso_id Identificador del proceso
 * @property int $etapa_procesal_id Identificador de la etapa procesal en la que se encuentra el proceso
 * @property int $tipo_proceso_id Identificador del tipo de proceso
 * @property string $created Fecha en la que se crea el registro
 * @property string $created_by Usuario que crea el registro
 */
class HistorialEstadosXProceso extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'historial_estados_x_proceso';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['proceso_id', 'etapa_procesal_id', 'tipo_proceso_id', 'created', 'created_by'], 'required'],
            [['proceso_id', 'etapa_procesal_id', 'tipo_proceso_id'], 'integer'],
            [['created'], 'safe'],
            [['created_by'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'Identificador del estado por proceso',
            'proceso_id' => 'Identificador del proceso',
            'etapa_procesal_id' => 'Identificador de la etapa procesal en la que se encuentra el proceso',
            'tipo_proceso_id' => 'Identificador del tipo de proceso',
            'created' => 'Fecha en la que se crea el registro',
            'created_by' => 'Usuario que crea el registro',
        ];
    }
}
