<!DOCTYPE html>
<html>
<head>
    <style>
    * {font-size:12px;}
    .folder {clear:both;font-weight:bold;padding-top:10px;}
    .file   {clear:both;}
    .name {float:left;}
    .size {float:right; width:90px;text-align:right;}
    .perms {float:right; width:40px;text-align:center;}
    .mime {float:right;}
    </style>
</head>
 
<body>
<?php
/**
 * Función recursiva que va mostrando los archivos y carpetas
 * Tiene que recibir:
 *  $path => directorio donde buscar los archivos. Tiene que terminar con la
 *  barra de dividir... /directory/
 */
function showFiles($path)
{
    // asignamos a $directorio el objeto dir creado con la ruta
    $directorio = dir($path);
 
    // recorremos todos los archivos y carpetas
    echo "<div style='padding-left:20px;'>";
    while ($archivo = $directorio -> read())
    {
        if($archivo!="." && $archivo!="..")
        {
			//echo $path.$archivo;
            if(is_dir($path.$archivo))
            {
                # Mostramos el nombre de la carpeta y los archivo contenidos
                # en la misma
                echo "<div class='folder'>";
                    echo get_infoFile($path,$archivo);
                echo "</div>";
 
                # llamamos nuevamente a la función con la nueva carpeta
                showFiles($path."\\".$archivo."\\");
            }else{
                // Mostramos el archivo
                echo "<div class='file'>";
                    echo get_infoFile($path,$archivo);
                echo "</div>";
            }
        }
    }
    echo "</div>";
    $directorio -> close();
}
 
/**
 * funcion que devuelve información en fotmato html sobre un archivo dado
 * Tiene que recibir el $path y $archivo
 */
function get_infoFile($path,$archivo)
{
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
 
    $cadena="<div class='name'>".$archivo."</div>";
    $cadena.="<div class='size'>".number_format(filesize($path."\\".$archivo)/1024,2,",",".")." Kb</div>";
    $cadena.="<div class='perms'>".substr(sprintf('%o', fileperms($path."\\".$archivo)),-4)."</div>";
    $cadena.="<div class='mime'>".finfo_file($finfo,$path."\\".$archivo)."</div>";
    return $cadena;
}
 
# iniciamos la función recursiva
showFiles("C:\\wamp64\\www\\carteraIntegral\\");
?>
</body>
</html>