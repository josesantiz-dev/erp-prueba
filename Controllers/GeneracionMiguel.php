<?php
    class GeneracionMiguel extends Controllers{

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
            $this->idUser = $_SESSION['idUser'];*/
        }

        public function getGeneraciones()
    {
        //$data = "";
        $data['page_functions_js'] = "functions_generaciones.js";

        $this->views->getView($this,"generacion",$data);
       // $arrGeneraciones = $this->model->selectGeneraciones();
        //var_dump($arrGeneraciones);
        //echo(json_encode($arrGeneraciones,JSON_UNESCAPED_UNICODE));
        //echo dep($data);
    } 
    //echo dep($data)
    public function getListaGeneraciones()
    {
        $arrGeneraciones = $this->model->selectGeneraciones();
        for($i = 0; $i < count($arrGeneraciones); $i++){
            $arrGeneraciones[$i]["numeracion"] = $i +1;

            $arrGeneraciones[$i]["status"] = ($arrGeneraciones[$i]['estatus'] == 1 )?
            '<span class="badge badge-success">Activo</span>':'<span class="badge badge-warning">Inactivo</span>';
            
            $arrGeneraciones[$i]['acciones'] = '<button type="button" class="btn btn-primary btn-sm">Actualizar</button> <button type="button" class="btn btn-danger btn-sm" 
            onclick="fnEliminar('.$arrGeneraciones[$i]['id'].')" >Eliminar</button>';
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
        $idUsuario =5;


        $response = $this->model->insertNuevaGeneracion($nombreGeneracion,$fechaInicio,$fechaFin,$estatus,$idUsuario);
        if($response){
            $arrResponse = array ('estatus' => true, 'msg' => 'Se inserto correctamente la nueva generacion');
       
        }else{
            $arrResponse = array ('estatus' => false, 'msg' => 'No se inserto el resgistro');

        }
        
        echo(json_encode($arrResponse,JSON_UNESCAPED_UNICODE));

    }

    public function setEstatusGeneracion($valor)
    {
        $arrResponse = $this->model->updateEstatusGeneracion($valor); 
        if($arrResponse){
            $response = array ('estatus' => true, 'msg' => 'Se elimino correctamente');
       
        }else{
            $response = array ('estatus' => false, 'msg' => 'No se pudo eliminar');

        }
        echo(json_encode($response,JSON_UNESCAPED_UNICODE));
    }
    }
?>