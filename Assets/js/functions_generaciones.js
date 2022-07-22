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
