
let btnNuevaGeneracion = document.getElementById("btn-NuevaGeneracion")
document.addEventListener('DOMContentLoaded', function(){

    tableGeneraciones = $('#tableGeneraciones').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/GeneracionMiguel/getListaGeneraciones",
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
    $('#tableGeneraciones').DataTable();
})



console.log(btnNuevaGeneracion);

let formNuevaGeneracion = document.querySelector('#formNuevaGeneracion');
formNuevaGeneracion.onsubmit = function(e){
    e.preventDefault();
    
    let nombreGeneracion = document.getElementById('txtNombreGeneracion').value;
    let FechaInicio = document.getElementById('dateFechaInicio').value;
    let FechaFin = document.getElementById('dateFechaFin').value;
    console.log(nombreGeneracion)
    console.log(FechaInicio)
    console.log(FechaFin)

    if(nombreGeneracion == '' || FechaInicio == '' || FechaFin == '' ) {
        Swal.fire({
            icon: 'error',
            title: 'ERROR',
            text: 'Completa los campos obligatorios... !',
          })
          return false;
    }


   let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/GeneracionMiguel/setNuevaGeneracion';
    let formData = new FormData(formNuevaGeneracion);
    request.open("POST", ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function() {

        if ( request.readyState == 4 && request.status == 200) 
        {
            let objData = JSON.parse(request.responseText);
            if(objData.estatus == true){
                Swal.fire({
                    icon: 'succes',
                    title: 'Exito!',
                    text: objData.msg,
                    
                  })

            }else{
                Swal.fire({
                    icon: 'Error',
                    title: 'Error!',
                    text: objData.msg,

            })



            
            
        }
        formNuevaGeneracion.reset();
        tableGeneraciones.api().ajax.reload();
        
        $(".close").click();
        
        return false;
    }
    }
}

//Funcion eliminar Registro

function fnEliminar(value)
{
    Swal.fire({
        title: 'Desea eliminar?',
        text: "Confirme si desea hacer esta accion!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI'
      }).then((result) => {
        
        if (result.isConfirmed) {
            let url = base_url + "/GeneracionMiguel/setEstatusGeneracion/"+value;
            fetch(url).then (res => res.json()).then(response => {
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
                        'Error'
                    )
               }

               tableGeneraciones.api().ajax.reload();
            
            }).catch(err => {throw err});
            /*Swal.fire(
            'Eliminado!',
            'El registro actual se ha eliminado.',
            'success'
          )*/
        }
      })
}