
var ObjectMethod=function(){
     this.init = function(){
        this.completaDatos();
        this.filtroBusqueda();
        this.mostrarTodos();
     }
     //metodo para realizar una peticion y optener los datos de las opcion de los select(Ciudad y Tipo)
     this.completaDatos=function(){
        $.ajax({
            url : "./php/controllerFilter.php",
            type : "POST",
            data : {
                "option":"datosSelect"
            },
            datatype:"json",
            success : function(data){
               var ciudades = JSON.parse(data)["ciudad"];
               var tipos    = JSON.parse(data)["tipos"];
               ciudades.forEach(element => {
                $("#selectCiudad").append("<option value='"+element+"' >"+element+"</option>")
               });

               tipos.forEach(element => {
                $("#selectTipo").append("<option value='"+element+"' >"+element+"</option>")
               });
                
               $('select').material_select();
            }
        })
    }
    //metodo para realizar una peticion y obtener todos los datos 
    this.mostrarTodos=function(){
        $("#mostrarTodos").click(function(e){
            e.preventDefault();
           
            $(".search").remove();
            $.ajax({
                url:"./php/controllerFilter.php",
                type:"POST",
                data:{
                    "option":"mostrarTodos"
                },
                datatype:"json",
                success:function(data){
                
                data = JSON.parse(data)
                console.log(data.data.length)
                for(var i = 0; i < data.data.length; i++){
                    $(".colContenido").append('<div class="tituloContenido  card search">'+
                      '<div class="itemMostrado">'+
                        '<img src="img/home.jpg">'+
                        '<p>'+
                        '<b>Dirección:</b> '+data.data[i].Direccion+' <br>'+
                        '<b>Ciudad:</b> '+data.data[i].Ciudad+'<br>'+
                        '<b>Teléfono:</b> '+data.data[i].Telefono+'<br>'+
                        '<b>Código Postal:</b> '+data.data[i].Codigo_Postal+'<br>'+
                        '<b>Tipo:</b> '+data.data[i].Tipo+'<br>'+
                        '<b>Precio:</b> <span class="precioTexto">'+data.data[i].Precio+'</span><br>'+
                        '</p>'+
                      '</div>'+
                    '</div>')
                  }

                }
            })
        })
    }
    //metodo para realizar una peticion y obtener datos filtrados dependiendo del ciudad,tipo o precio
    this.filtroBusqueda= function(){
        $("#formulario").submit(function(e){
           e.preventDefault();
           var valciudad  = $("select[name=ciudad]").val();
           var valtipo    = $("select[name=tipo]").val()
           var valprecio  = $("input[name=precio]").val()
           $(".search").remove();
           $.ajax({
            url : "./php/controllerFilter.php",
            type : "POST",
            data : {
                    "option" : "filtroPersonalizado",
                    "ciudad" : valciudad,
                    "tipo"   : valtipo,
                    "precio" : valprecio
            },
            datatype:"json",
            success : function(res){
                var data=JSON.parse(res)
                console.log(data)
                for(var i = 0; i < data.datosTotal.length; i++){
                    $(".colContenido").append('<div class="tituloContenido  card search">'+
                      '<div class="itemMostrado">'+
                        '<img src="img/home.jpg">'+
                        '<p>'+
                        '<b>Dirección:</b> '+data.datosTotal[i].Direccion+' <br>'+
                        '<b>Ciudad:</b> '+data.datosTotal[i].Ciudad+'<br>'+
                        '<b>Teléfono:</b> '+data.datosTotal[i].Telefono+'<br>'+
                        '<b>Código Postal:</b> '+data.datosTotal[i].Codigo_Postal+'<br>'+
                        '<b>Tipo:</b> '+data.datosTotal[i].Tipo+'<br>'+
                        '<b>Precio:</b> <span class="precioTexto">'+data.datosTotal[i].Precio+'</span><br>'+
                        '</p>'+
                      '</div>'+
                    '</div>')
                  }
            }
           })
        })
       

    }
}

$(document).ready(function(){
    var ObjectNew = new ObjectMethod
    ObjectNew.init()
})