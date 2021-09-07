<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alertas".
 *
 * @property int $id Id alerta
 * @property int $proceso_id
 * @property int $usuario_id
 * @property string $descripcion_alerta Descripción de la alerta
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 */
class Alertas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'alertas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['proceso_id', 'usuario_id', 'descripcion_alerta', 'created', 'created_by', 'modified', 'modified_by'], 'required'],
            [['proceso_id', 'usuario_id'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['descripcion_alerta'], 'string', 'max' => 250],
            [['created_by', 'modified_by'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Id alerta',
            'proceso_id' => 'Proceso ID',
            'usuario_id' => 'Usuario ID',
            'descripcion_alerta' => 'Descripción de la alerta',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }
}
