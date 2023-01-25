<?php
//Clase que realiza un filtro de datos dependiendo de las opciones de filtro elejidas por el usuario: ciudad,tipo,precio
//procesarFiltro: metodo que filtra los datos y los agrega a un array almacenDatos
class FiltroPersonalizado{
   
    public $ciudad;
    public $tipo;
    public $precio;
    public $almacenDatos 	= array();
    
    //metodo contructor de la clase, recibe los parametro ciudad, tipo y precio que son enviados en la peticion 
    function __construct($ciudad , $tipo , $precio){
        $this->ciudad = $ciudad;
        $this->tipo   = $tipo;
        $this->precio = $precio;
    }
    function procesarFiltro(){
          $dataRead 	= file_get_contents("../data-1.json");
          $datosJson 	= json_decode($dataRead, true);
          //recorrido de los datos de data-1.json
          foreach($datosJson as $data){
            //variables que almacena false si no se realizara un filtro con respecto a ese tipo de filtro de datos; caso contrario almacena true
            $filtroCiudad = false;
            $filtroTipo = false;
            $filtroPrecio = false;
         //verificamos si se filtraran los datos respecto a la ciudad, tipo o precio
            if(!empty($this->ciudad)){
                if($data["Ciudad"]==$this->ciudad){
                    $filtroCiudad = true;
                }
            }else{
                $filtroCiudad = true;
            }
    
           
            if(!empty($this->tipo)){
                if($data["Tipo"]==$this->tipo){
                    $filtroTipo = true;
                }
            }else{
                $filtroTipo = true;
            }
    
            $formatPrecio = str_replace(array("$",","), array("",""), $data["Precio"]);
            if($formatPrecio>=$this->precio[0] && $formatPrecio<=$this->precio[1]){
                $filtroPrecio = true;
            }
           //agregamos los datos que se enviaran como respuesta en el array almacenDatos
            if($filtroCiudad && $filtroTipo && $filtroPrecio){
                array_push($this->almacenDatos, $data);
            }
    
         //variable que almacena los datos que se enviaran como respuesta en formato json
            $response = json_encode(array("datosTotal" => $this->almacenDatos));
        }	
    
        return $response;
    
    

    }
    
   
  

}

?>