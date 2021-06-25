<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_procesos".
 *
 * @property int $id ID
 * @property string $nombre Nombre
 * @property int $activo Activo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
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
            [['activo'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['nombre'], 'string', 'max' => 15],
            [['created_by', 'modified_by'], 'string', 'max' => 45],
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

}
