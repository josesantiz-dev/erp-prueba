let btnNuevaGeneracion = document.getElementById("BtnNuevaGeneracion")
let formEditGeneracion = document.querySelector('#formEditGeneracion');
document.addEventListener('DOMContentLoaded', function(){

    tableGeneraciones = $('#tableGenraciones').dataTable( {
		"aProcessing":true,
		"aServerSide":true,
        "language": {
        	"url": " "+base_url+"/Assets/plugins/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/GeneracionEdwin/getlisGeneraciones",
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

$('#tableGenraciones').DataTable();
})



    let formNuevaGeneracion = document.querySelector('#formNuevaGeneracion');
    formNuevaGeneracion.onsubmit = function(e){
      e.preventDefault();
      
      let nombreGeneracion = document.getElementById("txtNombreGeneracion").value;
      let nombreFechaInicio = document.getElementById("dateFechaInicio").value;
      let nombreFechaFin = document.getElementById("dateFechaFin").value;

      if(nombreGeneracion == ""|| nombreFechaInicio == ""|| nombreFechaFin == ""){
        Swal.fire({
            icon: 'campos requerrido',
            title: 'Error...',
            text: 'todos los campos son obligatorios'
          })
          return false;
      }
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
     let ajaxUrl = base_url+'/GeneracionEdwin/setNuevaGneracion';
     let formData = new FormData(formNuevaGeneracion);
     request.open("POST", ajaxUrl,true);
    request.send(formData);
     request.onreadystatechange = function() {

            if ( request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);
              if(objData.status == true){
                Swal.fire({
                  icon: 'success',
                  title: '¡¡exito!!',
                  text: objData.msg,
                })
                

              }else{
                Swal.fire({
                  icon: 'error',
                  title: '¡¡error!!',
                  text: objData.msg,

              })
              
            }
            formNuevaGeneracion.reset();
            tableGeneraciones.api().ajax.reload();
            $(".close").click()
        }
        return false;
    }
  }
  // funcion eliminar registro
  function fnEliminar(value)
    {
      Swal.fire({
        title: 'Seguro que quieres eliminar?',
        text: "esto no se podra recuperar!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'si, eliminar!'
      }).then((result) => {
        if (result.isConfirmed) {
          let url = base_url + "/GeneracionEdwin/setEstatusGeneracion/"+value;
          fetch(url).then(res => res.json()).then(response =>{
            if(response.estatus)
            {
               Swal.fire(
            'Eliminado!',
            response.msg,
            'success'            
          )
        }else{
                Swal.fire(
                  'error!',
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
      let url = base_url + "/GeneracionEdwin/getGeneracion/"+id;

      fetch(url).then(res => res.json()).then(response => {
        document.getElementById("txtNombreGeneracionEdit").value = response.nombre_generacion;
        document.getElementById("dateFechaInicioEdit").value = response.fecha_inicio_gen;
        document.getElementById("dateFechaFinEdit").value = response.fecha_fin_gen;
        document.getElementById("IdGeneracion").value = response.id;

      }).catch(err =>{throw err})

    }





    formEditGeneracion.onsubmit = function(e){
      e.preventDefault();
      
      let nombreGeneracionEdit = document.getElementById("txtNombreGeneracionEdit").value;
      let nombreFechaInicioEdit = document.getElementById("dateFechaInicioEdit").value;
      let nombreFechaFinEdit = document.getElementById("dateFechaFinEdit").value;

      if(nombreGeneracionEdit == ""|| nombreFechaInicioEdit == ""|| nombreFechaFinEdit == ""){
        Swal.fire({
            icon: 'campos requerrido',
            title: 'Error...',
            text: 'todos los campos son obligatorios'
          })
          return false;
      }
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
     let ajaxUrl = base_url+'/GeneracionEdwin/setEditGeneracion';
     let formData = new FormData(formEditGeneracion);
     request.open("POST", ajaxUrl,true);
    request.send(formData);
     request.onreadystatechange = function() {
            if ( request.readyState == 4 && request.status == 200) {
                let objData = JSON.parse(request.responseText);
              if(objData.status == true){
                Swal.fire({
                  icon: 'success',
                  title: '¡¡exito!!',
                  text: objData.msg,
                })
                

              }else{
                Swal.fire({
                  icon: 'error',
                  title: '¡¡error!!',
                  text: objData.msg,

              })
              
            }
            formEditGeneracion.reset();
            tableGeneraciones.api().ajax.reload();
            $(".close").click()
        }
        return false;
      }

    }
