<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "personas".
 *
 * @property int $id ID
 * @property int $nit Nit de la persona natural o jurídica
 * @property int $digverifica Digito de verificación
 * @property string $tipodeudor Tipo del deudor
 * @property string $firstname Nombres de la persona natural o jurídica
 * @property string $lastname Apellidos de la persona natural o jurídica
 * @property string $razonsocial Razón social
 * @property string $direccion Dirección de la persona natural o jurídica
 * @property string $telefonofijo Teléfono fijo
 * @property string $celular Número celular
 * @property string $email Correo electrónico
 * @property string $ciudad Ciudad
 * @property string $marcas Marcas asociadas
 * @property int $representantelegal Nit del representante legal
 * @property string $created Fecha de creación del registro
 * @property string $created_by Quien creó el registro
 * @property string $modified Fecha de modificación del registro
 * @property string $modified_by Quien modificó el registro
 */
class Personas extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'personas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nit', 'digverifica', 'tipodeudor', 'firstname', 'lastname',
            'razonsocial', 'direccion', 'telefonofijo', 'celular',
            'email', 'ciudad', 'marcas', 'representantelegal'], 'required'],
            [['nit', 'digverifica', 'representantelegal'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['tipodeudor', 'created_by', 'modified_by'], 'string', 'max' => 50],
            [['firstname', 'lastname', 'email', 'ciudad'], 'string', 'max' => 120],
            [['razonsocial', 'direccion', 'marcas'], 'string', 'max' => 300],
            [['telefonofijo'], 'string', 'max' => 15],
            [['celular'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nit' => 'Nit de la persona natural o jurídica',
            'digverifica' => 'Digito de verificación',
            'tipodeudor' => 'Tipo del deudor',
            'firstname' => 'Nombres de la persona natural o jurídica',
            'lastname' => 'Apellidos de la persona natural o jurídica',
            'razonsocial' => 'Razón social',
            'direccion' => 'Dirección de la persona natural o jurídica',
            'telefonofijo' => 'Teléfono fijo',
            'celular' => 'Número celular',
            'email' => 'Correo electrónico',
            'ciudad' => 'Ciudad',
            'marcas' => 'Marcas asociadas',
            'representantelegal' => 'Nit del representante legal',
            'created' => 'Fecha de creación del registro',
            'created_by' => 'Quien creó el registro',
            'modified' => 'Fecha de modificación del registro',
            'modified_by' => 'Quien modificó el registro',
        ];
    }

}
