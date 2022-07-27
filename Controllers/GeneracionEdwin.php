<?php
    class GeneracionEdwin extends Controllers{

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
            $this->idUser = $_SESSION['idUser'];*/
        }

        public function getGeneraciones()
        
        {
            $data{'page_functions_js'} = "functions_generaciones.js";

        $this->views->getView($this,"generacion",$data);
       
        }
        public function getlisGeneraciones()
        {
            $arrGeneraciones = $this->model->selectGeneraciones();
            for($i = 0; $i < count($arrGeneraciones); $i++){
                $arrGeneraciones[$i]["numeracion"] = $i+1;
                $arrGeneraciones[$i]["status"] = ($arrGeneraciones[$i]["estatus"] == 1)?
                '<span class="badge badge-success">Activo</span>': '<span class="badge badge-danger">Inactivo</span>'; 
                $arrGeneraciones[$i]['acciones'] = '<button type="button" class="btn btn-primary btn-sm" onclick = "fnActualizar('.$arrGeneraciones[$i]['id'].')" data-toggle="modal" data-target="#modalEditGeneracion">Actualizar</button> <button type="button" onclick = "fnEliminar('.$arrGeneraciones[$i]['id'].')" class="btn btn-danger btn-sm">Eliminar</button>';

        }
            echo(json_encode($arrGeneraciones,JSON_UNESCAPED_UNICODE));

        }

        public function setNuevaGneracion()
        {
          $arrDatos = $_POST;
$nombreGeneracion = $arrDatos['txtNombreGeneracion'];
$fechaInicio = $arrDatos['dateFechaInicio'];
$fechaFin = $arrDatos['dateFechaFin'];
$status = 1;
$idUser = 5;
        $response = $this->model->insertNuevaGeneracion($nombreGeneracion,$fechaInicio,$fechaFin,$status,$idUser);
         if($response){
            $arrResponse = array ('status'=> true, 'msg'=> 'se inserto correctamente la nueva generacion');
           

        }else{ 
            $arrResponse = array ('status'=> false, 'msg'=> 'no se inserto el registro');
            
         }


          echo(json_encode($arrResponse,JSON_UNESCAPED_UNICODE));

        }
        public function setEstatusGeneracion($valor)
            {
                $arrresponse = $this->model->updateEstatusGeneracion($valor);
                if($arrresponse){
                    $response = array ('estatus'=> true, 'msg'=> 'se elimino correctamente');
                   
        
                }else{ 
                    $response = array ('estatus'=> false, 'msg'=> 'no se pudo eliminar');
                    
                 }
                echo(json_encode($response,JSON_UNESCAPED_UNICODE));
            }  

            public function getGeneracion(int $id)
            {
                $arrDatos = $this->model->selectGeneracion($id);
                echo(json_encode($arrDatos,JSON_UNESCAPED_UNICODE));
            }
            public function setEditGeneracion()
    {
        $arrDatos = $_POST;
        $idUser = 10;
        $nombreGeneracion = $arrDatos['txtNombreGeneracionEdit'];
        $fechaInicio = $arrDatos['dateFechaInicioEdit'];
        $fechaFin = $arrDatos['dateFechaFinEdit'];
        $idGeneracion  = $arrDatos['IdGeneracion'];
        $arrResponse = $this->model->updateGeneracion($nombreGeneracion,$fechaInicio,$fechaFin,$idGeneracion,$idUser);
     if($arrResponse){
        $response = array ('status'=> true, 'msg'=> 'se actualizo correctamente');
       

    }else{ 
        $response = array ('status'=> false, 'msg'=> 'no se actualizo el registro');
        
     }
      echo(json_encode($response,JSON_UNESCAPED_UNICODE));
    }
        
    }

    

   

    
?>