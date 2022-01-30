<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "alertas".
 *
 * @property int $id Id alerta
 * @property int $proceso_id
 * @property int $usuario_id
 * @property int $tipo_alerta_id Tipo Alerta ID
 * @property string $descripcion_alerta Descripción de la alerta
 * @property string $pospuesta La alerta esta pospuesta no
 * @property string|null $fecha_pospuesta Fecha en que fue pausada
 * @property int $dias_pospuesta Número de días que fue pospuesta
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property Procesos $proceso
 * @property Users $usuario
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
            [['proceso_id', 'usuario_id', 'tipo_alerta_id','descripcion_alerta'], 'required'],
            [['proceso_id', 'usuario_id', 'tipo_alerta_id','dias_pospuesta'], 'integer'],
            [['fecha_pospuesta', 'created', 'modified'], 'safe'],
            [['descripcion_alerta'], 'string', 'max' => 250],
            [['pospuesta'], 'string', 'max' => 1],
            [['created_by', 'modified_by'], 'string', 'max' => 45],
            [['proceso_id'], 'exist', 'skipOnError' => true, 'targetClass' => Procesos::className(), 'targetAttribute' => ['proceso_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['usuario_id' => 'id']],
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
            'tipo_alerta_id' => 'Tipo Alerta ID',
            'descripcion_alerta' => 'Descripción de la alerta',
            'pospuesta' => 'La alerta esta pospuesta no',
            'fecha_pospuesta' => 'Fecha en que fue pospuesta',
            'dias_pospuesta' => 'Número de días que fue pospuesta',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }

    /**
     * Gets query for [[Proceso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProceso()
    {
        return $this->hasOne(Procesos::className(), ['id' => 'proceso_id']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Users::className(), ['id' => 'usuario_id']);
    }
}
