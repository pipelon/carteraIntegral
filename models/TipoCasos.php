<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_casos".
 *
 * @property int $id ID
 * @property string $nombre
 * @property int $activo Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 *
 * @property Procesos[] $procesos
 */
class TipoCasos extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'tipo_casos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nombre', 'activo'], 'required'],
            [['activo'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['nombre', 'created_by', 'modified_by'], 'string', 'max' => 45],
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
        return $this->hasMany(Procesos::className(), ['prejur_tipo_caso' => 'id']);
    }

}
