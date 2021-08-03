<?php
include '../vendor/google/apiclient/vendor/autoload.php';
putenv('GOOGLE_APPLICATION_CREDENTIALS=../ciles-202107-c88b43086408.json');

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
// $client_id = '1042211949114-cqrkbpooult0lnp29nnecm5lk9rdrai1.apps.googleusercontent.com';
// $client_secret = 'd-pugrNRCwPRZhGxRpUXtNw7';
// $redirect_uri = 'http://localhost/carteraIntegral/gdrive/';
$client->SetScopes("https://www.googleapis.com/auth/drive.file");

// $client->setClientId($client_id);
// $client->setClientSecret($client_secret);
// $client->setRedirectUri($redirect_uri);

try {
	$service = new Google_Service_Drive($client);
	$file_path = "modelo.jpg";
	$file_path = "1mIhzkdatSOIN4nMGnOfWNY8atEGdUaxk";
	
	$file = new Google_Service_Drive_DriveFile();
	$file->setName($file_path);
	
	$file->setParents(array(
		"1Hy1RlD-AVVW-SejqU5BbEmOVYJuuDu-g"
	));
	$file->setDescription("Archivo de prueba de carga");
	$file->setMimeType("image/jpg");
	
	// $resultado = $service->files->create(
		// $file,
		// array(
			// 'data' => file_get_contents($file_path),
			// 'mimeType' => 'image/jpg',
			// 'uploadType' => 'media'			
		// )
	// );
	
	$resultado = $service->files->delete($file_path);
	
	var_dump($resultado);
	
	echo '<a href="https://drive.google.com/open?id='. $resultado->id .'" target="_blank">'.$resultado->name.'</a>';
	
} catch (Google_Service_Exception $gs){
	$mensaje =  json_decode($gs->getMessage());
	var_dump($mensaje);
	//echo $mensaje->error->message();	
} catch (Exception $e){	
	echo $e->getMessage();
}