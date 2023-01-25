<?php
class getDatosSelect{
     public $ciudad = array();
    public $tipos = array();


    function getDatos()
    {
        $datosS = file_get_contents("../data-1.json");
        $datosS = json_decode($datosS,true);
        foreach ($datosS as $data) {
            
            if (!empty($data["Ciudad"])) {
                
                if (count($this->ciudad) > 0) {
                    
                    if (!in_array($data["Ciudad"], $this->ciudad)) {
                        
                        array_push($this->ciudad, $data["Ciudad"]);
                    }
                } else {
                    
                    array_push($this->ciudad, $data["Ciudad"]);
                }
            }

            if(!empty($data["Tipo"])){
				
				if(count($this->tipos)>0){
				
					if(!in_array($data["Tipo"], $this->tipos)){
						array_push($this->tipos, $data["Tipo"]);
					}
				}else{
					array_push($this->tipos, $data["Tipo"]);
				}
			}
        }
        return json_encode(array("ciudad" => $this->ciudad, "tipos" => $this->tipos));
    }
    
}
?>