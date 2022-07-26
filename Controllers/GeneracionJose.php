<?php
    class GeneracionJose extends Controllers{

        private $idUser;
        public function __construct()
        {
            parent::__construct();
            /*session_start();
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
            $data['page_functions_js'] = "functions_generaciones.js";
            $this->views->getView($this,"generacion",$data);
            //$arrData = $this->model->selectPeriodo($intIdPeriodos);
            //$arrGeneraciones = $this->model->selectGeneraciones();
            //var_dump($arrGeneraciones);
            //echo(json_encode($arrGeneraciones,JSON_UNESCAPED_UNICODE));

        } 
        public function getListaGeneraciones()
        {
            $arrGeneraciones = $this->model->selectGeneraciones();
            for($i = 0; $i < count($arrGeneraciones); $i++){
                $arrGeneraciones[$i]["numeracion"] = $i+1;
                $arrGeneraciones[$i]["status"] = ($arrGeneraciones[$i]['estatus'] == 1)?'<span class="badge badge-success">Acctivo</span>':'<span class="badge badge-warning">Innactivo</span>
                ';
                $arrGeneraciones[$i]['acciones'] = '<div class="row">
                <button type="button" class="btn btn-primary btn-sm" onclick="fnActualizar('.$arrGeneraciones[$i]['id'].')" data-toggle="modal" data-target="#modalEditGeneracion">Actualizar</button>
                
                <button type="button" class="btn btn-danger btn-sm ml-2" onclick="fnEliminar('.$arrGeneraciones[$i]['id'].')">Eliminar</button>
                </div>';
            }
            echo(json_encode($arrGeneraciones,JSON_UNESCAPED_UNICODE));

        }

        public function setNuevaGeneracion()
        {
            $arrDatos = $_POST;

            $nombreGeneracion = $arrDatos['txtNombreGeneracion'];
            $fechaInicio = $arrDatos['dateFechaInicio'];
            $fechaFin = $arrDatos['dateFechaFin'];
            $estatus = 1;
            $idUser = 5;
            $response = $this->model->insertNuevaGeneracion($nombreGeneracion,$fechaInicio,$fechaFin,$estatus,$idUser);
            if($response){
                $arrResponse = array('estatus' => true,'msg' => 'Se insertó correctamente la nueva generación');
            }else{
                $arrResponse = array('estatus' => false,'msg' => 'No se insertó el registro');
            }


            echo(json_encode($arrResponse,JSON_UNESCAPED_UNICODE));
        }

        public function setEstatusGeneracion($valor)
        {
            $arrResponse = $this->model->updateEstatusGeneracion($valor); 
            if($arrResponse){
                $response = array('estatus' => true,'msg' => 'Se  elimino correctamente');
            }else{
                $response = array('estatus' => false,'msg' => 'No se pudo eliminar');
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
            $idGeneracion = $arrDatos['txtIdGeneracion'];
            $arrResponse = $this->model->updateGeneracion($nombreGeneracion,$fechaInicio,$fechaFin,$idGeneracion,$idUser);
            if($arrResponse){
                $response = array('estatus' => true,'msg' => 'Se  actualizó correctamente');
            }else{
                $response = array('estatus' => false,'msg' => 'No se pudo actualizar');
            }
            echo(json_encode($response,JSON_UNESCAPED_UNICODE));
        }
    }
?>