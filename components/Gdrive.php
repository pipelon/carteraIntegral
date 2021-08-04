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
		
		var_dump($folderId);
		// $client = new Google_Client();
		// $client->useApplicationDefaultCredentials();
		// $client->SetScopes("https://www.googleapis.com/auth/drive");

		// $service = new Google_Service_Drive($client);

		// $resultado = $service->files->listFiles(array("q" => "'{$folderId}' in parents"));
	
		// echo "<div style='padding-left:20px;'>";
		// foreach ($resultado as $elemento){
			
			// if ($elemento->mimeType == "application/vnd.google-apps.folder"){
				// echo "<div class='carpeta'>";
				// echo '<div class="name"><input type="checkbox" id="'.$elemento->id.'" name="'.$elemento->id.'" value="'.$elemento->name.'"><a href="https://drive.google.com/open?id='. $elemento->id .'" target="_blank">'.$elemento->name.'</a></div>';
				// echo "</div>";
				// leerArchivosCarpeta($elemento->id);
			// }else{
				// echo "<div class='archivo'>";
				// echo '<div class="name"><a href="https://drive.google.com/open?id='. $elemento->id .'" target="_blank">'.$elemento->name.'</a></div>';
				// echo "</div>";  
			// }
		// }
		// echo "</div>";
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
   public function cargarArchivosCarpeta($folderId){
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
			
			echo '<a href="https://drive.google.com/open?id='. $resultado->id .'" target="_blank">'.$resultado->name.'</a>';
			
		} catch (Google_Service_Exception $gs){
			$mensaje =  json_decode($gs->getMessage());
			//var_dump($mensaje);
			echo $mensaje->error->message();	
		} catch (Exception $e){	
			echo $e->getMessage();
		}
   }

}
