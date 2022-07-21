<?php

	class GeneracionJoseModel extends Mysql
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
	}
?>