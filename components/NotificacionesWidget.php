<?php

namespace app\components;
use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use Dompdf\Dompdf;
use Dompdf\Options;

class NotificacionesWidget extends Widget {

    public $tipo;
    public $carta;
    public $codcarta;
    public $pdfNotificacionName;
    public $pathNotificacionPdf;
    public $juzgado;
    public $demandante;
    public $demandado;
    public $radicado;
    private $meses = [
        "01" => "enero",
        "02" => "febrero",
        "03" => "marzo",
        "04" => "abril",
        "05" => "mayo",
        "06" => "junio",
        "07" => "julio",
        "08" => "agosto",
        "09" => "septiembre",
        "10" => "octubre",
        "11" => "noviembre",
        "12" => "diciembre"
    ];

    public function init() {
        parent::init();
        
        $this->pathNotificacionPdf = Yii::$app->basePath.'/web/pdfs/';
        //elegir el tipo de carta a generar
        switch ($this->codcarta) {
            case 'NotificacionAutorizacion':
                $this->carta = $this->shapeNotificacionAutorizacion();
                break;
            case 'NotificacionRelacionTitulosJudiciales':
                $this->carta = $this->shapeNotificacionRelacionTitulosJudiciales();
                break;
        }        
    }

    public function run() {

         switch ($this->tipo) {
            case 'vista':
                return $this->carta;
                break;
            case 'generar':
                return $this->generarPdf('generar');
                break;
            case 'enviar':
                //$this->enviarNotificacion($this->codcarta);
                $this->generarPdf('enviar');
                break;
            case 'descargar':
                return $this->generarPdf('descargar');
                break;
        }        
        
    }

    private function generarPdf($destination) {
        
        $options = new Options();
        //Y debes activar esta opción "TRUE"
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($this->carta);
        // Render the HTML as PDF
        $dompdf->render();
        if ($destination == 'generar'){
            // Output the generated PDF to Browser
            $dompdf->stream($this->pdfNotificacionName);
        } elseif($destination == 'enviar'){
            $contenido = $dompdf->output();
            //$nombreDelDocumento = $this->pathNotificacionPdf.$this->pdfNotificacionName;
            //var_dump($this->pathNotificacionPdf.$this->pdfNotificacionName);
            $bytes = file_put_contents($this->pathNotificacionPdf.$this->pdfNotificacionName, $contenido);
            $this->enviarNotificacion($this->codcarta);
        }

        exit;
       
    }

    private function enviarNotificacion($codCarta){
 
        //enviar correo
        try {
            Yii::$app->mailer->compose()
            ->setFrom(\Yii::$app->params['notificacionesJudicialesEmail'])
            ->setTo(\Yii::$app->params['adminEmail'])
            ->setSubject(\Yii::$app->params['TiposCartas'][$codCarta]." proceso ".$this->demandado)
            ->attach($this->pathNotificacionPdf.$this->pdfNotificacionName)
            ->send();
            //echo "El correo se envió";
        } catch (Exception $ex) {
            var_dump($ex);
            echo "El correo no se pudo enviar";
        }        
    }  

    private function shapeNotificacionAutorizacion(){
        //asignar nombre del pdf
        $this->pdfNotificacionName = $this->codcarta.$this->demandado.date("d-m-Y").'.pdf';      

        // ENCABEZADO
        $textoCarta = sprintf(\Yii::$app->params["cartaNotificacionDeudaAutorizacion"]["encabezado"],
        \yii\bootstrap\Html::img("https://carteraintegral.com.co/ciles/web/images/logo-cartera-integral-grande.jpg", ["width" => "100px"]),
        date("d"),
        $this->meses[date("m")],
        date("Y"),
        $this->juzgado,
        $this->demandante,
        $this->demandado,
        $this->radicado);

        // CUERPO
        $textoCarta .= sprintf(\Yii::$app->params["cartaNotificacionDeudaAutorizacion"]["cuerpo"]);

        //PIE DE PAGINA
        $textoCarta .= sprintf(\Yii::$app->params["cartaNotificacionDeudaAutorizacion"]["pie"],
            \yii\bootstrap\Html::img("https://carteraintegral.com.co/ciles/web/images/firma-jhon-jairo.jpg", ["width" => "100px"]));

        return $textoCarta;
    }

    private function shapeNotificacionRelacionTitulosJudiciales(){
        //asignar nombre del pdf
        $this->pdfNotificacionName = $this->codcarta.$this->demandado.date("d-m-Y").'.pdf';
        // ENCABEZADO
        $textoCarta = sprintf(\Yii::$app->params["cartaNotificacionRelacionTitulosJudiciales"]["encabezado"],
        \yii\bootstrap\Html::img("https://carteraintegral.com.co/ciles/web/images/logo-cartera-integral-grande.jpg", ["width" => "100px"]),
        date("d"),
        $this->meses[date("m")],
        date("Y"),
        $this->juzgado,
        $this->demandante,
        $this->demandado,
        $this->radicado);

        // CUERPO
        $textoCarta .= sprintf(\Yii::$app->params["cartaNotificacionRelacionTitulosJudiciales"]["cuerpo"]);

        //PIE DE PAGINA
        $textoCarta .= sprintf(\Yii::$app->params["cartaNotificacionRelacionTitulosJudiciales"]["pie"],
            \yii\bootstrap\Html::img("https://carteraintegral.com.co/ciles/web/images/firma-jhon-jairo.jpg", ["width" => "100px"]));

        return $textoCarta;
    }

}