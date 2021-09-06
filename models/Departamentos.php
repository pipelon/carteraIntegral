<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamentos".
 *
 * @property int $id ID
 * @property string $nombre Nombre
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property Ciudades[] $ciudades
 * @property Procesos[] $procesos
 */
class Departamentos extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'departamentos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nombre'], 'required'],
            [['created', 'modified'], 'safe'],
            ['nombre', 'filter', 'filter' => 'strtoupper'],
            [['nombre', 'created_by', 'modified_by'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }

    /**
     * Gets query for [[Ciudades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCiudades() {
        return $this->hasMany(Ciudades::className(), ['departamento_id' => 'id']);
    }

    /**
     * Gets query for [[Procesos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcesos() {
        return $this->hasMany(Procesos::className(), ['jur_departamento_id' => 'id']);
    }

}
