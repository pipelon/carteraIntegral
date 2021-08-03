<!DOCTYPE html>
<html>
<head>
    <style>
    * {font-size:14px;}
    .carpeta {clear:both;font-weight:bold;padding-top:10px;}
    .archivo   {clear:both;}
    .name {float:left;}
    .size {float:right; width:90px;text-align:right;}
    .perms {float:right; width:40px;text-align:center;}
    .mime {float:right;}
    </style>
</head>
 
<body>
<?php
// var_dump(openssl_get_cert_locations());
// exit;
include '../vendor/google/apiclient/vendor/autoload.php';
putenv('GOOGLE_APPLICATION_CREDENTIALS=../ciles-202107-c88b43086408.json');

$folderId = '1U8cLqz3-uf61VWsBnl6xq0QaS8CU8mtX';

leerArchivosCarpeta($folderId);

// $optParams = array(
        // 'pageSize' => 10,
        // 'fields' => "nextPageToken, 
		// files(contentHints/thumbnail,fileExtension,iconLink,id,name,size,thumbnailLink,webContentLink,webViewLink,mimeType,parents)",
        // 'q' => "'".$folderId."' in parents"
        // );

function leerArchivosCarpeta($folderId){
	
	
	$client = new Google_Client();
	$client->useApplicationDefaultCredentials();
	// $client_id = '1042211949114-cqrkbpooult0lnp29nnecm5lk9rdrai1.apps.googleusercontent.com';
	// $client_secret = 'd-pugrNRCwPRZhGxRpUXtNw7';
	// $redirect_uri = 'http://localhost/carteraIntegral/gdrive/';
	$client->SetScopes("https://www.googleapis.com/auth/drive");

	// $client->setClientId($client_id);
	// $client->setClientSecret($client_secret);
	// $client->setRedirectUri($redirect_uri);

	$service = new Google_Service_Drive($client);

	$resultado = $service->files->listFiles(array("q" => "'{$folderId}' in parents"));
								  
	//$resultado = $service->files->listFiles($optParams);
	
	echo "<div style='padding-left:20px;'>";
	foreach ($resultado as $elemento){
		//echo $elemento->id.' '.$elemento->name.'<br>';
		// echo "<pre>"	;
			// var_dump($elemento);
		// echo "</pre>"	;
		
		if ($elemento->mimeType == "application/vnd.google-apps.folder"){
			//echo strtoupper($elemento->name).'<br>';
			//echo '<a href="https://drive.google.com/open?id='. $elemento->id .'" target="_blank">'.$elemento->name.'</a><br>';
			//echo "<div class='carpeta'>";
			// $children = $service->files->listFiles(array("q" => "'{$elemento->id}' in parents") );
			// If ($children->files){
				// foreach ($children as $child) {

				// if ($child->mimeType == "application/vnd.google-apps.folder"){
					 echo "<div class='carpeta'>";
					 echo '<div class="name"><input type="checkbox" id="'.$elemento->id.'" name="'.$elemento->id.'" value="'.$elemento->name.'"><a href="https://drive.google.com/open?id='. $elemento->id .'" target="_blank">'.$elemento->name.'</a></div>';
					 echo "</div>";
					 leerArchivosCarpeta($elemento->id);
				// }
				 // else{
					// echo "<div class='archivo'>";
					// echo '<a href="https://drive.google.com/open?id='. $elemento->id .'" target="_blank">'.$elemento->name.'</a>';
					// echo "</div>";  
				// }
			 // }
			//}
			//echo "</div>";  
		}else{
			echo "<div class='archivo'>";
			echo '<div class="name"><a href="https://drive.google.com/open?id='. $elemento->id .'" target="_blank">'.$elemento->name.'</a></div>';
			echo "</div>";  
		}
		//echo '<a href="https://drive.google.com/open?id='. $elemento->id .'" target="_blank">'.$elemento->name.'</a><br>';
		//echo $elemento->id.' '.$elemento->name.' '.$elemento->mimeType.'<br>';	
	}
	echo "</div>";
}
?>
</body>
</html>