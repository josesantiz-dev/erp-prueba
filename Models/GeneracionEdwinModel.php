<?php

	class GeneracionEdwinModel extends Mysql
	{

		public function __construct()
		{
			parent::__construct();
		}

        public function selectGeneraciones()
        {
            $sql = "select * from t_generaciones WERE estatus = 1";
            $request = $this->select_all($sql);
            return $request;
        }

		public function insertNuevaGeneracion(string $nombreGeneradcion,string $fechaInicio,string $fechaFin,int $Status,int $idUsuario)
			{
				$sql = "insert into t_generaciones (nombre_generacion,fecha_inicio_gen, fecha_fin_gen,estatus,fecha_creacion,id_usuario_creacion)
				values(?,?,?,?,NOW(),?)";
				$request = $this->insert($sql,array($nombreGeneradcion, $fechaInicio, $fechaFin, $Status,$idUsuario));
				return $request;
			}

			public function updateEstatusGeneracion(int $id)
			{
				$sql = "UPDATE t_Generaciones SET estatus = ? WHERE id = $id";
				$request = $this->update($sql,array(2));
				return $request;
			}
		
	}
?>