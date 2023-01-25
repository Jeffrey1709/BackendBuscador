<?php
//clase para mostrar todos los datos
class datosTotal{
    function getDatos(){
        $dataRead 	= file_get_contents("../data-1.json");
        $datosJson 	= json_decode($dataRead, true);
        return $datosJson;
    }
    
}
?>