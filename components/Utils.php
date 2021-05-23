<?php

namespace app\components;

use yii\base\Component;

/**
 * Description of Utils
 *
 * @author fecheverri
 */
class Utils extends Component {

    /**
     * Funcion para pintar el badge de registro activo
     * 
     * @author Felipe Echeverri <felipe.echeverri@ingeneo.com.co>
     * @copyright 2019 INGENEO S.A.S.
     * @link http://www.ingeneo.com.co 
     * @param int $condition
     * @return string
     */
    public function getConditional($condition) {
        return $condition == 1 || strtolower($condition) == 'si' ?
                "<span class='badge bg-green'>SI</span>" :
                "<span class='badge bg-red'>NO</span>";
    }
    
    /**
     * Funcion para pintar el badge de registro activo
     * 
     * @author Felipe Echeverri <felipe.echeverri@ingeneo.com.co>
     * @copyright 2019 INGENEO S.A.S.
     * @link http://www.ingeneo.com.co 
     * @param int $condition
     * @return string
     */
    public function getStategate($condition) {
        return $condition == 1 ?
                "<span class='badge bg-green'>ABRIR</span>" :
                "<span class='badge bg-red'>CERRAR</span>";
    }
    
    /**
     * Funcion para pintar el badge de registro activo
     * 
     * @author Felipe Echeverri <felipe.echeverri@ingeneo.com.co>
     * @copyright 2019 INGENEO S.A.S.
     * @link http://www.ingeneo.com.co 
     * @param int $condition
     * @return string
     */
    public function getStateCard($condition) {
        return $condition == 1 ?
                "<span class='badge bg-green'>OK</span>" :
                "<span class='badge bg-red'>ERROR</span>";
    }

    /**
     * Funcion que retorna el filtro de activo
     * 
     * @author Felipe Echeverri <felipe.echeverri@ingeneo.com.co>
     * @copyright 2019 INGENEO S.A.S.
     * @link http://www.ingeneo.com.co 
     * @return array
     */
    public function getFilterConditional() {
        return [
            '1' => 'SI',
            '0' => 'NO',
        ];
    }
    
    /**
     * Funcion que retorna el filtro de activo
     * 
     * @author Felipe Echeverri <felipe.echeverri@ingeneo.com.co>
     * @copyright 2019 INGENEO S.A.S.
     * @link http://www.ingeneo.com.co 
     * @return array
     */
    public function getFilterStategate() {
        return [
            '1' => 'ABRIR',
            '2' => 'CERRAR',
        ];
    }
    
    /**
     * Funcion que retorna el filtro de activo
     * 
     * @author Felipe Echeverri <felipe.echeverri@ingeneo.com.co>
     * @copyright 2019 INGENEO S.A.S.
     * @link http://www.ingeneo.com.co 
     * @return array
     */
    public function getFilterStateCard() {
        return [
            '1' => 'OK',
            '2' => 'ERROR',
        ];
    }
    
    /**
     * Funcion que retorna todos los residentes de un apartamento
     * 
     * @author Felipe Echeverri <felipe.echeverri@ingeneo.com.co>
     * @copyright 2019 INGENEO S.A.S.
     * @link http://www.ingeneo.com.co 
     * @return array
     */
    public function getResidentesByApto($residents){
        if(!isset($residents) || count($residents) <= 0){
            return;
        }
        
        $output = "<ul>";
        foreach ($residents as $resident) {
            $output .= "<li style='list-style: none; margin-bottom: 10px;'>";
            $output .= \yii\bootstrap\Html::img("@web/" . $resident->photo, ['style' => 'width: 30px; height: 30px']);
            $output .= " <i class='fa fa-user'></i> ". $resident->name;
            $output .= " <i class='fa fa-phone'></i> ". $resident->phone;
            
            $output .= "</li>";
        }
        $output .= "</ul>";
        
        return $output;
        
    }
    
    /**
     * Funcion que retorna todos las mascotas de un apartamento
     * 
     * @author Felipe Echeverri <felipe.echeverri@ingeneo.com.co>
     * @copyright 2019 INGENEO S.A.S.
     * @link http://www.ingeneo.com.co 
     * @return array
     */
    public function getPetsByApto($pets){
        if(!isset($pets) || count($pets) <= 0){
            return;
        }
        
        $output = "<ul>";
        foreach ($pets as $pet) {
            $output .= "<li style='list-style: none; margin-bottom: 10px;'>";
            $output .= \yii\bootstrap\Html::img("@web/" . $pet->photo, ['style' => 'width: 30px; height: 30px']);
            $output .= " <i class='fa fa- fa-paw'></i> ". $pet->name;
            $output .= " (". \Yii::$app->params['pet_type'][$pet->type] . ")";            
            $output .= "</li>";
        }
        $output .= "</ul>";
        
        return $output;
    }
    
    /**
     * Funcion que retorna todos los vehiculos de un apartamento
     * 
     * @author Felipe Echeverri <felipe.echeverri@ingeneo.com.co>
     * @copyright 2019 INGENEO S.A.S.
     * @link http://www.ingeneo.com.co 
     * @return array
     */
    public function getVehiclesByApto($vehicles){
        if(!isset($vehicles) || count($vehicles) <= 0){
            return;
        }
        
        $output = "<ul>";
        foreach ($vehicles as $vehicle) {
            $output .= "<li style='list-style: none; margin-bottom: 10px;'>";
            $output .= \yii\bootstrap\Html::img("@web/" . $vehicle->photo, ['style' => 'width: 30px; height: 30px']);
            $output .= " <i class='fa fa-car'></i> ". $vehicle->license_plate;
            $output .= " (". \Yii::$app->params['vehicle_type'][$vehicle->type] . ")";            
            $output .= "</li>";
        }
        $output .= "</ul>";
        
        return $output;
        
    }

}
