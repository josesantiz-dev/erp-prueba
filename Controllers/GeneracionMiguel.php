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
        
        echo(json_encode($response,JSON_UNESCAPED_UNICODE));

    }
    }
?>