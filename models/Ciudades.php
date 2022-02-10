<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ciudades".
 *
 * @property int $id ID
 * @property int $departamento_id Departamento
 * @property string $nombre Nombre
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property Departamentos $departamento
 * @property JurisdiccionesCompetentes[] $jurisdiccionesCompetentes
 * @property Procesos[] $procesos
 */
class Ciudades extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'ciudades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['departamento_id', 'nombre'], 'required'],
            [['departamento_id'], 'integer'],
            [['created', 'modified', 'codigo_ciudad'], 'safe'],
            ['nombre', 'filter', 'filter' => 'strtoupper'],
            [['nombre', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['departamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['departamento_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'departamento_id' => 'Departamento',
            'nombre' => 'Nombre',
            'codigo_ciudad' => 'Código de la ciudad',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }

    /**
     * Gets query for [[Departamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento() {
        return $this->hasOne(Departamentos::className(), ['id' => 'departamento_id']);
    }

    /**
     * Gets query for [[JurisdiccionesCompetentes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJurisdiccionesCompetentes() {
        return $this->hasMany(JurisdiccionesCompetentes::className(), ['ciudad_id' => 'id']);
    }

    /**
     * Gets query for [[Procesos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcesos() {
        return $this->hasMany(Procesos::className(), ['jur_ciudad_id' => 'id']);
    }

}
