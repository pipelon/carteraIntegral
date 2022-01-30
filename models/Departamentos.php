<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "departamentos".
 *
 * @property int $id ID
 * @property string $nombre Nombre
 * @property string $codigo_departamento Código departamento
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 * @property int|null $delete Borrado
 * @property string|null $deleted Borrado
 * @property string|null $deleted_by Borrado por
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
            [['nombre', 'codigo_departamento'], 'required'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['delete'], 'integer'],
            ['nombre', 'filter', 'filter' => 'strtoupper'],
            [['nombre', 'created_by', 'modified_by', 'deleted_by'], 'string', 'max' => 45],
            [['codigo_departamento'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'codigo_departamento' => 'Código departamento',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
            'delete' => 'Borrado',
            'deleted' => 'Borrado',
            'deleted_by' => 'Borrado por',
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
