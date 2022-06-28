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
        putenv('GOOGLE_APPLICATION_CREDENTIALS=../ciles-202107-0dd67255ec48.json');
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
    public function leerArchivosCarpetaOLD($folderId) {
        $resultado = $this->service->files->listFiles(array("q" => "'{$folderId}' in parents"));
        $this->out .= "<div class='drive_files'>";
        foreach ($resultado as $elemento) {
            if ($elemento->mimeType == "application/vnd.google-apps.folder") {
                $this->out .= "<div class='carpeta'>";
                $this->out .= '<div class="name">' . \yii\helpers\Html::img("@web/images/folder_icon.png") . '<a href="https://drive.google.com/open?id=' . $elemento->id . '" target="_blank">' . $elemento->name . '</a></div>';
                $this->out .= "</div>";
                $this->leerArchivosCarpeta($elemento->id);
            } else {

                $ext = explode(".", $elemento->name);
                $ext = end($ext);
                switch ($ext) {
                    case "pdf":
                        $icon = "pdf_icon.png";
                        break;
                    case "xlsx":
                    case "xlsm":
                    case "xlsb":
                    case "xls":
                        $icon = "excel_icon.png";
                        break;
                    case "docx":
                    case "doc":
                        $icon = "word_icon.png";
                        break;
                    default:
                        $icon = "plain_icon.png";
                        break;
                }
                $this->out .= "<div class='archivo'>";
                $this->out .= '<div class="name">' . \yii\helpers\Html::img("@web/images/$icon") . '<a href="https://drive.google.com/open?id=' . $elemento->id . '" target="_blank">' . $elemento->name . '</a></div>';
                $this->out .= "</div>";
            }
        }
        $this->out .= "</div>";
        return $this->out;
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
        
        try {
            $resultado = $this->service->files->listFiles(array("q" => "'{$folderId}' in parents"));
            if ($resultado->files){
                $this->out .= "<div class='drive_files'>";
                foreach ($resultado as $elemento) {
                    if ($elemento->mimeType == "application/vnd.google-apps.folder") {
                        $this->out .= "<div class='carpeta'>";
                        $this->out .= '<div class="name">' . \yii\helpers\Html::img("@web/images/folder_icon.png") . '<a href="https://drive.google.com/open?id=' . $elemento->id . '" target="_blank">' . $elemento->name . '</a></div>';
                        $this->out .= "</div>";
                        $this->leerArchivosCarpeta($elemento->id);
                    } else {

                        $ext = explode(".", $elemento->name);
                        $ext = end($ext);
                        switch ($ext) {
                            case "pdf":
                                $icon = "pdf_icon.png";
                                break;
                            case "xlsx":
                            case "xlsm":
                            case "xlsb":
                            case "xls":
                                $icon = "excel_icon.png";
                                break;
                            case "docx":
                            case "doc":
                                $icon = "word_icon.png";
                                break;
                            default:
                                $icon = "plain_icon.png";
                                break;
                        }
                        $this->out .= "<div class='archivo'>";
                        $this->out .= '<div class="name">' . \yii\helpers\Html::img("@web/images/$icon") . '<a href="https://drive.google.com/open?id=' . $elemento->id . '" target="_blank">' . $elemento->name . '</a></div>';
                        $this->out .= "</div>";
                    }
                }
                $this->out .= "</div>";
            }else{
                $this->out .=  "<span class='not-set'>No se pudo cargar los archivos del drive. Revise el ID de la carpeta.</span>";
            }
        } catch (Exception $e) {
            $this->out .=  "<span class='not-set'>No se pudo cargar los archivos del drive: ".  $e->getMessage(). "</span>";
        }
        

        return $this->out;
    }
}
