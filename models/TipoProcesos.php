<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_procesos".
 *
 * @property int $id ID
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
 * @property EtapasProcesales[] $etapasProcesales
 * @property Procesos[] $procesos
 */
class TipoProcesos extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tipo_procesos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nombre'], 'required'],
            [['activo', 'delete'], 'integer'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['nombre', 'created_by', 'modified_by', 'deleted_by'], 'string', 'max' => 45],
            ['nombre', 'filter', 'filter' => 'strtoupper']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
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
     * Gets query for [[EtapasProcesales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEtapasProcesales() {
        return $this->hasMany(EtapasProcesales::className(), ['tipo_proceso_id' => 'id']);
    }

    /**
     * Gets query for [[Procesos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcesos() {
        return $this->hasMany(Procesos::className(), ['jur_tipo_proceso_id' => 'id']);
    }

}
