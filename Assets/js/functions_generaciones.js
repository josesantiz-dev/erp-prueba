let btnNuevaGeneracion = document.getElementById("btnNuevaGeneracion")

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
            {"data":"id"},
            {"data":"nombre_generacion"},
            {"data":"fecha_inicio_gen"},
            {"data":"fecha_fin_gen"},
            {"data":"estatus"},
            {"data":"id"},
            
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
                    console.log(objData)
                  
                }
                return false;
            }
            
        }