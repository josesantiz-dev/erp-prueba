<?php

	class GeneracionJoseModel extends Mysql
	{

		public function __construct()
		{
			parent::__construct();
		}

        public function selectGeneraciones()
        {
            $sql = "select *from t_generaciones WHERE estatus = 1";
            $request = $this->select_all($sql);
            return $request;
        }

		public function insertNuevaGeneracion(string $nombreGeneracion,string $fechaInicio,string $fechaFin,int $estatus,int $idUsuario)
		{
			$sql = "INSERT INTO t_generaciones
			(nombre_generacion, fecha_inicio_gen, fecha_fin_gen, 
			estatus, fecha_creacion, id_usuario_creacion)
			VALUES(?, ?, ?, ?, NOW(), ?)";
			$request = $this->insert($sql,array($nombreGeneracion,$fechaInicio,$fechaFin,$estatus,$idUsuario));
			return $request;
		}
		
		public function updateEstatusGeneracion(int $id)
		{
			$sql = "UPDATE t_generaciones SET estatus = ? WHERE id = $id";
			$request = $this->update($sql,array(2));
			return $request;
		}

		public function selectGeneracion(int $id){
			$sql = "SELECT *from t_generaciones WHERE id = $id";
			$request = $this->select($sql);
			return $request;
		}

		public function updateGeneracion(string $nombreGeneracion,string $fechaInicio,string $fechaFin,int $idGeneracion,int $idUser)
		{	
			$sql = "UPDATE t_generaciones SET nombre_generacion = ?,fecha_inicio_gen = ?,fecha_fin_gen = ?,fecha_actualizacion = NOW(),id_usuario_actualizacion = ? WHERE id = $idGeneracion";
			$request = $this->update($sql,array($nombreGeneracion,$fechaInicio,$fechaFin,$idUser));
			return $request;
		}
	}
?>