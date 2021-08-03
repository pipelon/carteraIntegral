<?php

namespace app\components;

use yii\base\Component;

/**
 * Description of Gdrive
 *
 * @author Diego Castaño
 */
class Gdrive extends Component {

    /**
     * Funcion para leer archivos de una carpeta en google drive
     * 
     * @author Diego Castaño <dcastanom@gmail.com>
     * @copyright 2019 ONICSOFT S.A.S.
     * @link 
     * @param string $folderId
     * @return list of files and directories
     */
	public function leerArchivosCarpeta($folderId){
	
		$client = new Google_Client();
		$client->useApplicationDefaultCredentials();
		$client->SetScopes("https://www.googleapis.com/auth/drive");

		$service = new Google_Service_Drive($client);

		$resultado = $service->files->listFiles(array("q" => "'{$folderId}' in parents"));
	
		echo "<div style='padding-left:20px;'>";
		foreach ($resultado as $elemento){
			
			if ($elemento->mimeType == "application/vnd.google-apps.folder"){
				echo "<div class='carpeta'>";
				echo '<div class="name"><input type="checkbox" id="'.$elemento->id.'" name="'.$elemento->id.'" value="'.$elemento->name.'"><a href="https://drive.google.com/open?id='. $elemento->id .'" target="_blank">'.$elemento->name.'</a></div>';
				echo "</div>";
				leerArchivosCarpeta($elemento->id);
			}else{
				echo "<div class='archivo'>";
				echo '<div class="name"><a href="https://drive.google.com/open?id='. $elemento->id .'" target="_blank">'.$elemento->name.'</a></div>';
				echo "</div>";  
			}
		}
		echo "</div>";
	}

   

}
