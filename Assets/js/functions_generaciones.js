let btnNuevaGeneracion = document.getElementById("btnNuevaGeneracion")
let tableGeneraciones = "";
let formEditGeneracion = document.getElementById("formNuevaGeneracionEdit");

document.addEventListener('DOMContentLoaded', function(){
    tableGeneraciones = $('#tableGeneraciones').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/GeneracionJose/getListaGeneraciones",
            "dataSrc":""
        },
        "columns":[
            {"data":"numeracion"},
            {"data":"nombre_generacion"},
            {"data":"fecha_inicio_gen"},
            {"data":"fecha_fin_gen"},
            {"data":"status"},
            {"data":"acciones"}
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

let formNuevaGeneracion = document.querySelector('#formNuevaGeneracion');
formNuevaGeneracion.onsubmit = function(e){
    e.preventDefault();  
    
    let nombreGeneracion = document.getElementById("txtNombreGeneracion").value;
    let dateFechaInicio = document.getElementById("dateFechaInicio").value;
    let dateFechaFin = document.getElementById("dateFechaFin").value;
    
    if(nombreGeneracion == '' || dateFechaInicio == '' || dateFechaFin == ''){
        Swal.fire({
            icon: 'error',
            title: 'Error...',
            text: 'Todos los campos son obligatorios'
          })
        return false;
    }

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/GeneracionJose/setNuevaGeneracion';
    let formData = new FormData(formNuevaGeneracion);
    request.open("POST", ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function() {
        if ( request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if(objData.estatus){
                Swal.fire({
                    icon: 'success',
                    title: 'Exito!',
                    text: objData.msg,
                  })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: objData.msg,
                  })
            }
            formNuevaGeneracion.reset();
            tableGeneraciones.api().ajax.reload();
            $(".close").click();
                    
        }
        return false;
    }
}

//Funcion eliminar Registro
function fnEliminar(value)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
         if (result.isConfirmed) {
            let url = base_url + "/GeneracionJose/setEstatusGeneracion/"+value;
            fetch(url).then(res => res.json()).then(response => {
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
                  'error'
                )
              }
              tableGeneraciones.api().ajax.reload();
            }).catch(err => {throw err});
        }
      })
      
}

function fnActualizar(id){
  let url = base_url + "/GeneracionJose/getGeneracion/"+id;
  fetch(url).then(res => res.json()).then(response => {
    document.getElementById("txtNombreGeneracionEdit").value = response.nombre_generacion;
    document.getElementById("dateFechaInicioEdit").value = response.fecha_inicio_gen;
    document.getElementById("dateFechaFinEdit").value = response.fecha_fin_gen;
    document.getElementById("txtIdGeneracion").value = response.id;
  })
}


formEditGeneracion.onsubmit = function(e){
  e.preventDefault();

  let nombreGeneracionEdit = document.getElementById("txtNombreGeneracionEdit").value;
    let dateFechaInicioEdit = document.getElementById("dateFechaInicioEdit").value;
    let dateFechaFinEdit = document.getElementById("dateFechaFinEdit").value;
    
    if(nombreGeneracionEdit == '' || dateFechaInicioEdit == '' || dateFechaFinEdit == ''){
        Swal.fire({
            icon: 'error',
            title: 'Error...',
            text: 'Todos los campos son obligatorios'
          })
        return false;
    }

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/GeneracionJose/setEditGeneracion';
    let formData = new FormData(formEditGeneracion);
    request.open("POST", ajaxUrl,true);
    request.send(formData);
    request.onreadystatechange = function() {
        if ( request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if(objData.estatus){
                Swal.fire({
                    icon: 'success',
                    title: 'Exito!',
                    text: objData.msg,
                  })
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: objData.msg,
                  })
            }
            formEditGeneracion.reset();
            tableGeneraciones.api().ajax.reload();
            $(".close").click();
                    
        }
        return false;
    }

}

