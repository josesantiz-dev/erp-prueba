<?php

	class GeneracionEdwinModel extends Mysql
	{

		public function __construct()
		{
			parent::__construct();
		}

        public function selectGeneraciones()
        {
            $sql = "select * from t_generaciones WHERE estatus = 1";
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

			public function selectGeneracion(int $id){
				$sql = " SELECT * from t_generaciones WHERE id = $id";
				$requets = $this->select($sql);
				return $requets;
			}
			public function updateGeneracion( $nombreGeneracion, $fechaInicio, $fechaFin,int $idGeneracion,int $idUser)
			{
            $sql = "UPDATE t_generaciones SET nombre_generacion = ?,fecha_inicio_gen = ?,fecha_fin_gen = ?,fecha_actualizacion=NOW(),id_usuario_actualizacion = ? WHERE id = $idGeneracion";
			$request = $this->update($sql, array($nombreGeneracion,$fechaInicio,$fechaFin,$idUser));
			return $request;
			}
	}
?>