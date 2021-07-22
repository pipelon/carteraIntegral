<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property int $id ID
 * @property string $tipo_documento Tipo de documento
 * @property string $documento Documento
 * @property string $direccion Dirección física
 * @property string $nombre_representante_legal Nombres
 * @property string $telefono_representante_legal Teléfonos
 * @property string $email_representante_legal Correo electrónico
 * @property string $nombre_persona_contacto_1 Nombres
 * @property string $telefono_persona_contacto_1 Teléfonos
 * @property string $email_persona_contacto_1 Correo electrónico
 * @property string $cargo_persona_contacto_1 Cargo
 * @property string|null $nombre_persona_contacto_2 Nombres
 * @property string|null $telefono_persona_contacto_2 Teléfonos
 * @property string|null $email_persona_contacto_2 Correo electrónico
 * @property string|null $cargo_persona_contacto_2 Cargo
 * @property string|null $nombre_persona_contacto_3 Nombres
 * @property string|null $telefono_persona_contacto_3 Teléfonos
 * @property string|null $email_persona_contacto_3 Correo electrónico
 * @property string|null $cargo_persona_contacto_3 Cargo
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 */
class Clientes extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'clientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['tipo_documento', 'nombre', 'documento', 'direccion',
            'nombre_representante_legal', 'telefono_representante_legal',
            'email_representante_legal', 'nombre_persona_contacto_1',
            'telefono_persona_contacto_1', 'email_persona_contacto_1',
            'cargo_persona_contacto_1'], 'required'],
            [['email_representante_legal', 'email_persona_contacto_1',
            'email_persona_contacto_2', 'email_persona_contacto_3'], 'email'],
            [['created', 'modified'], 'safe'],
            [['tipo_documento'], 'string', 'max' => 5],
            [['documento'], 'string', 'max' => 20],
            [['direccion'], 'string', 'max' => 100],
            [['nombre', 'nombre_representante_legal', 'telefono_representante_legal',
            'email_representante_legal','nombre_persona_contacto_1', 'telefono_persona_contacto_1',
            'email_persona_contacto_1', 'cargo_persona_contacto_1',
            'nombre_persona_contacto_2', 'telefono_persona_contacto_2',
            'email_persona_contacto_2', 'cargo_persona_contacto_2',
            'nombre_persona_contacto_3', 'telefono_persona_contacto_3',
            'email_persona_contacto_3', 'cargo_persona_contacto_3',
            'created_by', 'modified_by'], 'string', 'max' => 45],
            [['tipo_documento', 'nombre', 'documento', 'direccion',
            'nombre_representante_legal', 'telefono_representante_legal',
            'email_representante_legal', 'nombre_persona_contacto_1',
            'telefono_persona_contacto_1', 'email_persona_contacto_1',
            'cargo_persona_contacto_1', 'cargo_persona_contacto_1',
            'nombre_persona_contacto_2', 'telefono_persona_contacto_2', 'email_persona_contacto_2',
            'cargo_persona_contacto_2', 'nombre_persona_contacto_3',
            'telefono_persona_contacto_3', 'email_persona_contacto_3',
            'cargo_persona_contacto_3'], 'filter', 'filter' => 'strtoupper'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'tipo_documento' => 'Tipo de documento',
            'documento' => 'Documento',
            'direccion' => 'Dirección física',
            'nombre_representante_legal' => 'Nombres',
            'telefono_representante_legal' => 'Teléfonos',
            'email_representante_legal' => 'Correo electrónico',
            'nombre_persona_contacto_1' => 'Nombres',
            'telefono_persona_contacto_1' => 'Teléfonos',
            'email_persona_contacto_1' => 'Correo electrónico',
            'cargo_persona_contacto_1' => 'Cargo',
            'nombre_persona_contacto_2' => 'Nombres',
            'telefono_persona_contacto_2' => 'Teléfonos',
            'email_persona_contacto_2' => 'Correo electrónico',
            'cargo_persona_contacto_2' => 'Cargo',
            'nombre_persona_contacto_3' => 'Nombres',
            'telefono_persona_contacto_3' => 'Teléfonos',
            'email_persona_contacto_3' => 'Correo electrónico',
            'cargo_persona_contacto_3' => 'Cargo',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }

}
