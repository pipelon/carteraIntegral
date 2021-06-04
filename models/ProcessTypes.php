<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "process_types".
 *
 * @property int $id ID
 * @property string $name Nombre
 * @property int $active Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 */
class ProcessTypes extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'process_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['name'], 'required'],
            [['active'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['name'], 'string', 'max' => 15],
            [['created_by', 'modified_by'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Nombre',
            'active' => 'Activo',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }

}
