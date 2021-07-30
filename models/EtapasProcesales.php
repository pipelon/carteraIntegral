<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "etapas_procesales".
 *
 * @property int $id ID
 * @property int $tipo_proceso_id Tipo de proceso
 * @property string $nombre Nombre
 * @property int $activo Activo
 * @property int|null $delete Borrado
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 * @property string|null $deleted Borrado
 * @property string|null $deleted_by Borrado por
 *
 * @property TipoProcesos $tipoProceso
 * @property Procesos[] $procesos
 */
class EtapasProcesales extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'etapas_procesales';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['tipo_proceso_id', 'nombre', 'activo'], 'required'],
            [['tipo_proceso_id', 'activo', 'delete'], 'integer'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
            [['created_by', 'modified_by', 'deleted_by'], 'string', 'max' => 45],
            ['nombre', 'filter', 'filter' => 'strtoupper'],
            [['tipo_proceso_id'], 'exist', 'skipOnError' => true, 'targetClass' => TipoProcesos::className(), 'targetAttribute' => ['tipo_proceso_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'tipo_proceso_id' => 'Tipo de proceso',
            'nombre' => 'Nombre',
            'activo' => 'Activo',
            'delete' => 'Borrado',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
            'deleted' => 'Borrado',
            'deleted_by' => 'Borrado por',
        ];
    }

    /**
     * Gets query for [[TipoProceso]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipoProceso() {
        return $this->hasOne(TipoProcesos::className(), ['id' => 'tipo_proceso_id']);
    }

    /**
     * Gets query for [[Procesos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcesos() {
        return $this->hasMany(Procesos::className(), ['jur_etapas_procesal_id' => 'id']);
    }

}
