<?php
 //obteniendo clases de filtros
 require 'filtroPersonalizado.php';
 require 'mostrarTotal.php';
 require 'datosSelect.php';


 $option=$_POST["option"];
//analizar las peticiones ajax por optiones
switch($option){
    //caso para optener las opciones para  Ciudad y Tipo(select)
    case "datosSelect":
        $datosSelect=new getDatosSelect();
        $datosCiudadTipos=$datosSelect->getDatos();
        echo $datosCiudadTipos;
        break;
    //caso para realizar un filtro personalizado
    case "filtroPersonalizado":
        $FiltroObj = new FiltroPersonalizado($_POST["ciudad"],$_POST["tipo"], explode(";", $_POST["precio"]));
        $datosFiltro= $FiltroObj->procesarFiltro();
        echo $datosFiltro;
        break;
    //caso para mostrar todos los datos sin filtrar 
    case "mostrarTodos":
        $datosT = new datosTotal();
        $datosT = $datosT->getDatos();
        echo json_encode(array("data"=>$datosT));
        break;
}
 


?>