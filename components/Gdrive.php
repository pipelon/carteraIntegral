<?php

namespace app\components;

use yii\base\Component;
use Google_Client;

/**
 * Description of Gdrive
 *
 * @author Diego Castaño
 */
class Gdrive extends Component {

    public $service;
    public $out = "";

    public function __construct() {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=../ciles-202107-c88b43086408.json');
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->SetScopes("https://www.googleapis.com/auth/drive");
        $this->service = new \Google_Service_Drive($client);
        parent::__construct();
    }

    /**
     * Funcion para leer archivos de una carpeta en google drive
     * 
     * @author Diego Castaño <dcastanom@gmail.com>
     * @copyright 2019 ONICSOFT S.A.S.
     * @link 
     * @param string $folderId
     * @return list of files and directories
     */
    public function leerArchivosCarpeta($folderId) {
        $resultado = $this->service->files->listFiles(array("q" => "'{$folderId}' in parents"));
        $this->out .= "<div style='padding-left:20px;'>";
        foreach ($resultado as $elemento) {
            if ($elemento->mimeType == "application/vnd.google-apps.folder") {
                $this->out .= "<div class='carpeta'>";
                $this->out .= '<div class="name"><input type="checkbox" id="' . $elemento->id . '" name="' . $elemento->id . '" value="' . $elemento->name . '"><a href="https://drive.google.com/open?id=' . $elemento->id . '" target="_blank">' . $elemento->name . '</a></div>';
                $this->out .= "</div>";
                $this->leerArchivosCarpeta($elemento->id);
            } else {
                $this->out .= "<div class='archivo'>";
                $this->out .= '<div class="name"><a href="https://drive.google.com/open?id=' . $elemento->id . '" target="_blank">' . $elemento->name . '</a></div>';
                $this->out .= "</div>";
            }
        }
        $this->out .= "</div>";
        return $this->out;
    }

    /**
     * Funcion para cargar archivos a una carpeta en google drive
     * 
     * @author Diego Castaño <dcastanom@gmail.com>
     * @copyright 2019 ONICSOFT S.A.S.
     * @link 
     * @param string $folderId
     * @return list of files and directories
     */
    public function cargarArchivosCarpeta($folderId) {
        putenv('GOOGLE_APPLICATION_CREDENTIALS=../ciles-202107-c88b43086408.json');
        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->SetScopes("https://www.googleapis.com/auth/drive.file");

        try {
            $service = new Google_Service_Drive($client);
            $file_path = "modelo.jpg";
            //$file_path = "1mIhzkdatSOIN4nMGnOfWNY8atEGdUaxk";

            $file = new Google_Service_Drive_DriveFile();
            $file->setName($file_path);

            $file->setParents(array(
                "{$folderId}"
            ));
            $file->setDescription("Archivo de prueba de carga");
            $file->setMimeType("image/jpg");

            $resultado = $service->files->create(
                    $file,
                    array(
                        'data' => file_get_contents($file_path),
                        'mimeType' => 'image/jpg',
                        'uploadType' => 'media'
                    )
            );

            //$resultado = $service->files->delete($file_path);
            //var_dump($resultado);

            echo '<a href="https://drive.google.com/open?id=' . $resultado->id . '" target="_blank">' . $resultado->name . '</a>';
        } catch (Google_Service_Exception $gs) {
            $mensaje = json_decode($gs->getMessage());
            //var_dump($mensaje);
            echo $mensaje->error->message();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}
