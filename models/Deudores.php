<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "deudores".
 *
 * @property int $id ID
 * @property string $nombre Nombres
 * @property string $marca Marca
 * @property string $direccion Dirección física
 * @property string $nombre_representante_legal vNombres
 * @property string $telefono_representante_legalTeléfonos
 * @property string $email_representante_legal Correo electrónico
 * @property string $nombre_persona_contacto_1 Nombres
 * @property string $telefono_persona_contacto_1 Teléfonos
 * @property string $email_persona_contacto_1 Correo electrónico
 * @property string $cargo_persona_contacto_1 Cargo
 * @property string|null $nombre_persona_contacto_2 Nombre
 * @property string|null $telefono_persona_contacto_2 Teléfonos
 * @property string|null $email_persona_contacto_2 Correo electrónico
 * @property string|null $cargo_persona_contacto_2 Cargo
 * @property string|null $nombre_persona_contacto_3 Nombres
 * @property string|null $telefono_persona_contacto_3 Teléfonos
 * @property string|null $email_persona_contacto_3 Correo electrónico
 * @property string|null $cargo_persona_contacto_3 Cargo
 * @property string $nombre_codeudor_1 Nombres
 * @property string $documento_codeudor_1 Documento
 * @property string $direccion_codeudor_1 Dirección física
 * @property string $email_codeudor_1 Correo electrónico
 * @property string $telefono_codeudor_1 Teléfonos
 * @property string|null $nombre_codeudor_2 Nombres
 * @property string|null $documento_codeudor_2 Documento
 * @property string|null $direccion_codeudor_2 Dirección física
 * @property string|null $email_codeudor_2 Correo electrónico
 * @property string|null $telefonol_codeudor_2 Teléfonos
 * @property string|null $comentarios Comentarios
 * @property string $created Creado
 * @property string $created_by Creado por
 * @property string $modified Modificado
 * @property string $modified_by Modificado por
 */
class Deudores extends BeforeModel {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'deudores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['tipo_documento', 'documento','nombre', 'marca', 'direccion', 'nombre_representante_legal',
            'telefono_representante_legal', 'email_representante_legal',
            'nombre_persona_contacto_1', 'telefono_persona_contacto_1',
            'email_persona_contacto_1', 'cargo_persona_contacto_1'], 'required'],
            [['email_representante_legal', 'email_persona_contacto_1', 'email_persona_contacto_2',
            'email_persona_contacto_3', 'email_codeudor_1', 'email_codeudor_2'], 'email'],
            [['comentarios'], 'string'],
            [['created', 'modified'], 'safe'],
            [['tipo_documento'], 'string', 'max' => 30],
            [['ciudad'], 'string', 'max' => 30],
            [['documento'], 'string', 'max' => 20],
            [['marca', 'nombre_representante_legal',
            'telefono_representante_legal', 'email_representante_legal',
            'nombre_persona_contacto_1', 'telefono_persona_contacto_1',
            'email_persona_contacto_1', 'cargo_persona_contacto_1',
            'nombre_persona_contacto_2', 'telefono_persona_contacto_2',
            'email_persona_contacto_2', 'cargo_persona_contacto_2',
            'nombre_persona_contacto_3', 'telefono_persona_contacto_3',
            'email_persona_contacto_3', 'cargo_persona_contacto_3',
            'nombre_codeudor_1', 'documento_codeudor_1', 'direccion_codeudor_1',
            'email_codeudor_1', 'telefono_codeudor_1',
            'nombre_codeudor_2', 'documento_codeudor_2',
            'direccion_codeudor_2', 'email_codeudor_2',
            'telefonol_codeudor_2', 'created_by', 'modified_by'], 'string', 'max' => 45],
            [['nombre'], 'string', 'max' => 100],
            [['tipo_documento','documento','nombre', 'marca', 'direccion', 'nombre_representante_legal',
            'telefono_representante_legal', 'email_representante_legal', 'nombre_persona_contacto_1',
            'telefono_persona_contacto_1', 'email_persona_contacto_1',
            'cargo_persona_contacto_1', 'nombre_persona_contacto_2',
            'telefono_persona_contacto_2', 'email_persona_contacto_2',
            'cargo_persona_contacto_2', 'nombre_persona_contacto_3',
            'telefono_persona_contacto_3', 'email_persona_contacto_3',
            'cargo_persona_contacto_3', 'nombre_codeudor_1',
            'documento_codeudor_1', 'direccion_codeudor_1',
            'email_codeudor_1', 'telefono_codeudor_1',
            'nombre_codeudor_2', 'documento_codeudor_2',
            'direccion_codeudor_2', 'email_codeudor_2',
            'telefonol_codeudor_2', 'comentarios', 'ciudad'], 'filter', 'filter' => 'strtoupper'],
            [['direccion', 'carpeta'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'tipo_documento' => 'Tipo de documento',
            'documento' => 'Documento',
            'nombre' => 'Nombres',
            'marca' => 'Marca',
            'direccion' => 'Dirección física',
            'ciudad' => 'Ciudad',
            'nombre_representante_legal' => 'Nombres',
            'telefono_representante_legal' => 'Teléfonos',
            'email_representante_legal' => 'Correo electrónico',
            'nombre_persona_contacto_1' => 'Nombres',
            'telefono_persona_contacto_1' => 'Teléfonos',
            'email_persona_contacto_1' => 'Correo electrónico',
            'cargo_persona_contacto_1' => 'Cargo',
            'nombre_persona_contacto_2' => 'Nombre',
            'telefono_persona_contacto_2' => 'Teléfonos',
            'email_persona_contacto_2' => 'Correo electrónico',
            'cargo_persona_contacto_2' => 'Cargo',
            'nombre_persona_contacto_3' => 'Nombres',
            'telefono_persona_contacto_3' => 'Teléfonos',
            'email_persona_contacto_3' => 'Correo electrónico',
            'cargo_persona_contacto_3' => 'Cargo',
            'nombre_codeudor_1' => 'Nombres',
            'documento_codeudor_1' => 'Documento',
            'direccion_codeudor_1' => 'Dirección física',
            'email_codeudor_1' => 'Correo electrónico',
            'telefono_codeudor_1' => 'Teléfonos',
            'nombre_codeudor_2' => 'Nombres',
            'documento_codeudor_2' => 'Documento',
            'direccion_codeudor_2' => 'Dirección física',
            'email_codeudor_2' => 'Correo electrónico',
            'telefonol_codeudor_2' => 'Teléfonos',
            'comentarios' => 'Comentarios',
            'carpeta' => 'Carpeta Google Drive',
            'created' => 'Creado',
            'created_by' => 'Creado por',
            'modified' => 'Modificado',
            'modified_by' => 'Modificado por',
        ];
    }

}
