let btnNuevaGeneracion = document.getElementById("btnNuevaGeneracion")
let formEditGeneracion = document.getElementById("formNuevaGeneracionEdit");

document.addEventListener('DOMContentLoaded', function(){

    tableGeneraciones = $('#tablegeneraciones').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/GeneracionJesusK/getListaGeneraciones",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_generacion"},
            {"data":"fecha_inicio_gen"},
            {"data":"fecha_fin_gen"},
            {"data":"status"},
            {"data":"acciones"},
            
        ],
        "responsive": true,
	    "paging": true,
	    "lengthChange": true,
	    "searching": true,
	    "ordering": true,
	    "info": true,
	    "autoWidth": false,
	    "scrollY": '44vh',
	    "scrollCollapse": true,
	    "bDestroy": true,
	    "order": [[ 0, "asc" ]],
	    "iDisplayLength": 25
    }); 

    $('#tablegeneraciones').DataTable();
})

console.log(btnNuevaGeneracion)
let formNuevaGeneracion = document.querySelector('#formNuevaGeneracion');
formNuevaGeneracion.onsubmit = function(e){
    e.preventDefault();
let nombreGeneracion = document.getElementById("txtNombreGeneracion").value;
let nombreFechaInicio = document.getElementById("dateFechaInicio").value;
let nombreFechaFin = document.getElementById("dateFechaFin").value;
console.log(nombreGeneracion, nombreFechaInicio, nombreFechaFin);
if(nombreGeneracion ==""|| nombreFechaInicio == "" || nombreFechaFin == "") {
    Swal.fire({
        icon: 'error',
        title: 'Campo vacio',
        text: 'FAVOR DE REVISAR!',
      })
      return false;
}
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/GeneracionJesusK/setNuevaGeneracion';
            let formData = new FormData(formNuevaGeneracion);
            request.open("POST", ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function() {

                if ( request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus == true){
                        Swal.fire({
                            icon: 'success',
                            title: 'Exito...!',
                            text: objData.msg
                          })

                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error...!',
                            text: objData.msg
                            
                          })
                    }
                    formNuevaGeneracion.reset();
                    tableGeneraciones.api().ajax.reload();
                    $(".close").click();

                
                  
                }
                return false;
            }
            
        }

        //FUNCION ELIMINAR REGISTRO
        function fnEliminar(value)
        {
            Swal.fire({
                title: '¿Desea eliminar?',
                text: "Esta accion no se podra desacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, estoy seguro!'
              }).then((result) => {
                if (result.isConfirmed) {
                    let url = base_url + " /GeneracionJesusK/setEstatusGeneracion/ " + value;
                    fetch (url). then(res => res.json()).then (response => {
                        if(response.estatus)
                        {
                            Swal.fire(
                                'Eliminado!',
                                response.msg,
                                'success'
                              )

                        }else{
                            Swal.fire(
                                'Error!',
                                response.msg,
                                'Error!'
                              )


                        }
                        tableGeneraciones.api().ajax.reload();

                    }).catch (err => {throw err});
                }
              })
        }
        function fnActualizar(id){
            let url = base_url + "/GeneracionJesusK/getGeneracion/" +id;

            fetch(url).then (res => res.json()).then(response => {
                document.getElementById("txtNombreGeneracionEdit").value = response.nombre_generacion;
                document.getElementById("dateFechaInicioEdit").value = response.fecha_inicio_gen;
                document.getElementById("dateFechaFinEdit").value = response.fecha_fin_gen;
                document.getElementById("txtIdGeneracion").value = response.id;
            })

        }

        formEditGeneracion.onsubmit = function(e){
            e.preventDefault();
            let nombreGeneracionEdit = document.getElementById("txtNombreGeneracionEdit").value;
let nombreFechaInicioEdit = document.getElementById("dateFechaInicioEdit").value;
let nombreFechaFinEdit = document.getElementById("dateFechaFinEdit").value;
if(nombreGeneracionEdit ==""|| nombreFechaInicioEdit == "" || nombreFechaFinEdit == "") {
    Swal.fire({
        icon: 'error',
        title: 'Campo vacio',
        text: 'FAVOR DE REVISAR!',
      })
      return false;
}
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/GeneracionJesusK/setEditGeneracion';
            let formData = new FormData(formEditGeneracion);
            request.open("POST", ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function() {

                if ( request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if(objData.estatus == true){
                        Swal.fire({
                            icon: 'success',
                            title: 'Exito...!',
                            text: objData.msg
                          })

                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error...!',
                            text: objData.msg
                            
                          })
                    }
                    formEditGeneracion.reset();
                    tableGeneraciones.api().ajax.reload();
                    $(".close").click();

                
                  
                }
                return false;
        }
        }
