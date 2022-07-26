<?php
    class GeneracionJesusK extends Controllers{

        private $idUser;
        public function __construct()
        {
            parent::__construct();
           /* session_start();
            if(empty($_SESSION['login']))
            {
                header('Location: '.base_url().'/login');
                die();
            }
            $this->idUser = $_SESSION['idUser'];
            */
        }
        public function getGeneraciones()
        {
            //$data = "";
            $data ['page_functions_js'] = "functions_generaciones.js";
         $this->views->getView($this, "generacion", $data);

         //$arrGeneraciones = $this -> model -> selectGeneraciones();
         //var_dump ($arrGeneraciones); 
         //echo (json_encode($arrGeneraciones, JSON_UNESCAPED_UNICODE));

        }

        public function getListaGeneraciones()
        {
        $arrGeneraciones = $this -> model -> selectGeneraciones();
        for($i = 0; $i < count($arrGeneraciones); $i++)
        {
          $arrGeneraciones[$i]["numeracion"] = $i +1; 
          $arrGeneraciones[$i]["status"] = ($arrGeneraciones[$i]["estatus"] == 1)?
          '<span class="badge badge-success">Activo</span>': '<span class="badge badge-danger">Inactivo</span>
          ';
          $arrGeneraciones[$i]['acciones'] = '<button type="button" class="btn btn-danger btn-sm">Actualizar</button> <button type="button" class="btn btn-dark btn-sm" onclick ="fnEliminar('.$arrGeneraciones[$i]['id'].')">Eliminar</button>';
        }
        echo (json_encode($arrGeneraciones, JSON_UNESCAPED_UNICODE));
        }

        public function setNuevaGeneracion() 
        {
$arrDatos = $_POST;
$nombreGeneracion = $arrDatos ['txtNombreGeneracion'];
$fechaInicio = $arrDatos ['dateFechaInicio'];
$fechaFin = $arrDatos ['dateFechaFin'];
$estatus = 1;
$idUser = 5;

$response = $this -> model -> insertNuevaGeneracion ($nombreGeneracion, $fechaInicio, $fechaFin, $estatus, $idUser);
if ($response){
    $arrResponse = array('estatus' => true, 'msg' => 'SE INSERTO CORRECTAMENTE LA NUEVA GENERACION'); 

}else{
    $arrResponse = array('estatus' => false, 'msg' => 'NO SE INSERTO EL NUEVO REGISTRO'); 

}
echo (json_encode($arrResponse, JSON_UNESCAPED_UNICODE));

        }
public function setEstatusGeneracion($valor)
{
    $arrResponse = $this -> model -> updateEstatusGeneracion($valor);
    if ($arrResponse){
        $response = array('estatus' => true, 'msg' => 'SE ELIMINO CORRECTAMENTE'); 
    
    }else{
        $response = array('estatus' => false, 'msg' => 'NO SE PUDO ELIMINAR'); 
    
    }
    echo (json_encode($response, JSON_UNESCAPED_UNICODE));
}
    
    }

?>