<?php

	class GeneracionJesusKModel extends Mysql
	{

		public function __construct()
		{
            parent::__construct();
        }
        
        public function selectGeneraciones()
        {
            $sql = "select *from t_generaciones WHERE estatus = 1";
            $request = $this -> select_all ($sql);
            return $request; 
        }
        public function insertNuevaGeneracion(string $nombreGeneracion, string $fechaInicio, string $fechaFin, int $estatus, int $idUsuario)
        {
            $sql = "insert into practica.t_generaciones 
            (nombre_generacion, fecha_inicio_gen, fecha_fin_gen, estatus, fecha_creacion , id_usuario_creacion)
            Values (?, ?, ?, ?, NOW(), ?)";
            $request = $this ->  insert ($sql,array($nombreGeneracion, $fechaInicio, $fechaFin, $estatus, $idUsuario));
            return $request;
        }
        public function updateEstatusGeneracion(int $id)
        {
            $sql = "UPDATE t_generaciones SET estatus = ? WHERE id = $id";
            $request = $this -> update($sql, array(2));
            return $request;
        }
	}
?>