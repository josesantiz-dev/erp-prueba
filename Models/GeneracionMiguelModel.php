<?php

	class GeneracionMiguelModel extends Mysql
	{

		public function __construct()
		{
			parent::__construct();
		}

        public function selectGeneraciones()
        {
            $sql = "select * from t_generaciones";
            $request = $this->select_all($sql);
            return $request;
        }

		public function insertNuevaGeneracion(string $nombreGeneracion,string $fechaInicio,string $fechaFin,int $estatus,int $idUsuario)
		{
			$sql = "insert into t_generaciones(
				nombre_generacion,fecha_inicio_gen, fecha_fin_gen, estatus, fecha_creacion, id_usuario_creacion) 
				values(?, ?, ?,?, NOW(), ?)";

				$request = $this->insert($sql,array($nombreGeneracion,$fechaInicio,$fechaFin,$estatus,$idUsuario));
				return $request;
		}
	}
?>