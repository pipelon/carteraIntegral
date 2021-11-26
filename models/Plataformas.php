<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plataformas".
 *
 * @property int $id ID
 * @property string $nombre Nombre
 * @property int $activo Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property Procesos[] $procesos
 */
class Plataformas extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'plataformas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nombre'], 'required'],
            [['activo'], 'integer'],
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
            'activo' => 'Activo',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }

    /**
     * Gets query for [[Procesos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcesos() {
        return $this->hasMany(Procesos::className(), ['plataforma_id' => 'id']);
    }

}
